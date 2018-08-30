<?php

namespace App\Http\Controllers\Api\Hrm;

use App\Http\Models\Hrm\ClientAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ClientAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClientAddress::all();
    }

     
    public function getCLientAddress(Request $request, $clientId) {
        return ClientAddress::where('client_id', $clientId)->get();
    }

    /**
     * Get LOV for address Form
     */
    public function getLov() {
        return ClientAddress::getLOV();
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
            'address_line_one' => 'required|max:255',
            'address_line_two' => 'required|max:255',
            'client_id' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'pincode' => 'required',
            'type' => 'required',
        ]);

        $address = new ClientAddress();

        $address->fill($request->except('id')); // <=Error resolved on postgre:  Not null violation: 7 ERROR: null value in column "id" violates not-null constraint 
        // $address->user_id = Auth::id();
        $address->save();
        return $address;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientAddress $clientAddress)
    {

        $clientAddress->fill($request->all());
        $clientAddress->save();
        return $clientAddress;
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
