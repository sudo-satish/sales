<?php

namespace App\Http\Controllers\Api\Stock;

use App\Http\Models\Stock\Item;
use App\Http\Models\Stock\PriceMapping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PriceMappingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PriceMapping::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // $request->validate([
        //     'item_id' => 'required|max:255',
        //     'bf' => 'required',
        //     'gsm' => 'required',
        //     'price' => 'required',
        // ]);

        if(!is_array($request->all())) {
            throw new Error('Not array');
        }

        $priceMappings = $request->all();
        $savedItem = [];

        forEach($priceMappings as $priceMapping) {
            $item = new PriceMapping();
            $item->fill($priceMapping); // <= Error resolved on postgre:  Not null violation: 7 ERROR: null value in column "id" violates not-null constraint 
            $item->user_id = Auth::id();
            $item->save();
            array_push($savedItem, $item);
        }

        return $savedItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GlobalValue  $globalValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceMapping $priceMapping)
    {
        $priceMapping->fill($request->all());
        $priceMapping->save();
        return $priceMapping;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GlobalValue  $globalValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceMapping $priceMapping)
    {
        //
        $priceMapping->delete();
        return response()->json(['response' => 'Deleted Successfully']);
    }

    /**
     * Get List of values for form
     */
    public function getLOV() {
        return PriceMapping::getLOV();
    }
}
