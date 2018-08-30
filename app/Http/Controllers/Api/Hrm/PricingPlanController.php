<?php

namespace App\Http\Controllers\Api\Hrm;

use Illuminate\Http\Request;
use App\Http\Models\Hrm\PricingPlan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PricingPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PricingPlan::all();
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
            'client_id' => 'required',
            'item_name' => 'required',
            'gsm' => 'required',
            'default_price' => 'required',
            'actual_price' => 'required',
            'actual_price' => 'required',
            'unit' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ]);

        $pricingPlan = new PricingPlan();

        $pricingPlan->fill($request->except('id')); // <=Error resolved on postgre:  Not null violation: 7 ERROR: null value in column "id" violates not-null constraint 
        $pricingPlan->save();
        return $pricingPlan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PricingPlan $pricingPlan)
    {

        $pricingPlan->fill($request->all());
        $pricingPlan->save();
        return $pricingPlan;
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
