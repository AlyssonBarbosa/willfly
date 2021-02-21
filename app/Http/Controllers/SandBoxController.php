<?php

namespace App\Http\Controllers;

use App\Http\Requests\Requests\BilletRequest;
use App\Http\SandBoxClient;
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

            return Billet::paginate();
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BilletRequest $request)
    {
        return tap(Billet::create($request->all()), function(Billet $billet){                
            $this->createBillet($billet);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Billet  $billet
     * @return \Illuminate\Http\Response
     */
    public function show(Billet $billet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Billet  $billet
     * @return \Illuminate\Http\Response
     */
    public function edit(Billet $billet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Billet  $billet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Billet $billet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Billet  $billet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billet $billet)
    {
        //
    }

    private function createBillet(Billet $billet)
    {
        try {
            $url = "/invoices";

            $data = [];

            $clientSandBox = new SandBoxClient();

            $response = $clientSandBox->request($url, $data, 'POST');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
