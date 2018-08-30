<?php

namespace App\Http\Controllers\Api\Hrm;

use Illuminate\Http\Request;
use App\Http\Models\Hrm\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Client::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'client_name' => 'required',
            'head_office_address' => 'required',
            'pan' => 'required',
            'gst' => 'required',
            'credit_limit' => 'required',
            'balance' => 'required',
        ]);

        $client = new Client();

        $client->fill($request->except('id')); // <=Error resolved on postgre:  Not null violation: 7 ERROR: null value in column "id" violates not-null constraint 
        $client->save();
        return $client;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {

        $client->fill($request->all());
        $client->save();
        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GlobalValue  $globalValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(AureoleLookup $aureoleLookup)
    {
        //
        $aureoleLookup->delete();
        // return Response::
        return response()->json(['response' => 'Deleted Successfully']);
    }
}
