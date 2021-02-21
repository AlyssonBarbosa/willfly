<?php

namespace App\Http\Controllers;

use App\Http\Requests\Requests\BilletRequest;
use App\Http\SandBoxClient;
use App\Models\Address;
use App\Models\Billet;
use Illuminate\Http\Request;

class SandBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $billets = Billet::withTrashed()->paginate(1);

            return view('billet.list', compact('billets'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('billet.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BilletRequest $request)
    {
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
                    $this->createBillet($billet);
                    
                });

                return redirect('/')->with('message',"Boleto gerado!");
            }
        } catch (\Throwable $th) {
            dd($th);
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
            if($this->cancelBillet($billet)){
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

        if(!$billet->deleted_at){
            $clientSandBox = new SandBoxClient();

            $response = $clientSandBox->request($url, [], 'POST');            
            if($response['payment']['status'] == 5){
                return true;
            }else{
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
                        'price' => $billet->price * 100,
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
                'instructionsMsg' =>  $billet->instruction ? $billet->intruction : '',
            ];

            if ($billet->fees != null) {
                $data['interest'] = ['percentage' => $billet->fees / 100];
            }

            $clientSandBox = new SandBoxClient();

            $response = $clientSandBox->request($url, $data, 'POST');
            
            if ($response['id']) {
                $billet->update(['code' => $response['id']]);
                
                 return 'boleto gerado';
            } else {
                return 'Erro ao gerar boleto!';
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
