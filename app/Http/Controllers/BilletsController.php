<?php

namespace App\Http\Controllers;

use App\Http\Requests\BilletRequest;
use App\Http\SandBoxClient;
use App\Models\Address;
use App\Models\Billet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BilletsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $billets = Billet::withTrashed()->orderBy('created_at', 'DESC')->paginate(10);

            return view('billet.index', compact('billets'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('billet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BilletRequest $request)
    {
        DB::beginTransaction();

        try {
            $address = Address::create([
                'cep' => $request->cep,
                'city' => $request->city,
                'public_place' => $request->public_place,
                'number' => $request->number,
                'complement' => $request->complement,
                'uf' => $request->uf,
            ]);

            if ($address) {

                $request->price = $this->formatPrice($request->price);
                $request->fees = $request->fees ? $this->formatFees($request->fees) : '';

                if ($request->price == null) {
                    throw new Exception("O valor do boleto deve ser maior que R$5,00");
                }

                if ($request->fees == null) {
                    throw new Exception("O juros deve ser entre 0% e 1%!");
                }

                tap(Billet::create([
                    'name' => $request->name,
                    'cpf_cnpj' => $request->cpf_cnpj,
                    'expiration' => $request->expiration,
                    'price' => $request->price,
                    'fees' => $request->fees,
                    'instructions' => $request->instructions,
                    'address_id' => $address->id,
                    'status' => 'Aguardando Pagamento'
                ]), function (Billet $billet) {

                    $retorno = $this->createBillet($billet);
                    if (isset($retorno['erro'])) {
                        throw new Exception($retorno['errors'][0]);
                    }
                });

                DB::commit();
                return redirect('/')->with('message', "Boleto gerado!");
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Billet  $billet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billet $billet)
    {
        try {
            if ($this->cancelBillet($billet)) {
                $billet->delete();
                $billet->update(['status' => 'Cancelado']);

                return back()->with('message', 'Boleto cancelado!');
            }
        } catch (\Throwable $th) {
            return back()->withErrors($th->getMessage());
        }
    }

    public function cancelBillet(Billet $billet)
    {
        $url = "invoices/$billet->code/cancel";

        if (!$billet->deleted_at) {
            $clientSandBox = new SandBoxClient();

            $response = $clientSandBox->request($url, [], 'POST');
            if ($response['payment']['status'] == 5) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function createBillet(Billet $billet)
    {
        try {

            $url = "invoices";
            $data = [
                'dueDate' => $billet->expiration,
                'reference' => (string) $billet->id,
                'items' => [
                    [
                        'description' => 'Boleto Bancario',
                        'quantity' => 1,
                        'price' => (int) $billet->price * 100,
                    ]
                ],
                'customer' => [
                    'name' => $billet->name,
                    'email' => 'alyssonbarbosa10@gmail.com',
                    'phoneNumber' => '5585989736412',
                    'docNumber' => $billet->cpf_cnpj,
                    'address' => [
                        'cep' => $billet->address->cep,
                        'uf' => $billet->address->uf,
                        'city' => $billet->address->city,
                        'area' => 'Bairro',
                        'addressLine1' => $billet->address->public_place,
                        'addressLine2' => $billet->address->complement,
                        'streetNumber' => $billet->address->number,
                    ]
                ],
            ];

            if ($billet->fees != null) {
                $data['interest'] = ['percentage' => $billet->fees];
            }

            $billet->instructions ? $data['instructionsMsg'] = $billet->instructions : '';

            $clientSandBox = new SandBoxClient();

            $response = $clientSandBox->request($url, $data, 'POST');

            if (isset($response['id'])) {
                $billet->update(['code' => $response['id']]);

                return 'boleto gerado';
            } else {

                $errors = [];
                foreach ($response['errors'] as $key => $err) {
                    $errors[] = $err['msg'];
                }

                return [
                    'erro' => true,
                    'errors' => $errors
                ];
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function formatPrice($price)
    {
        $price = number_format(str_replace(",", ".", str_replace(".", "", $price)), 2, '.', '');
        $price = (float) $price;
        return $price >= 5 ?  $price : null;
    }

    public function formatFees($fees)
    {
        $fees = number_format(str_replace(",", ".", $fees), 1, '.', '');
        $fees = (float) $fees;
        return $fees >= 0 && $fees <= 1 ?  $fees : null;
    }
}
