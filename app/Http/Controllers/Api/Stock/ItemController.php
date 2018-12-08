<?php

namespace App\Http\Controllers\Api\Stock;

use App\Http\Models\Stock\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::all();
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
            'item_name' => 'required|max:255',
            'item_code' => 'required|unique:ut_stock_item_m',
            'bf' => 'required',
            'gst' => 'required',
        ]);

        if(!Item::isUnique($request->except('id'))) {
            return response(["message"=> "Duplicate item name, bf, gsm combination."], 422);
        }

        $item = new Item();

        $item->fill($request->except('id')); // <= Error resolved on postgre:  Not null violation: 7 ERROR: null value in column "id" violates not-null constraint 
        $item->user_id = Auth::id();
        $item->save();
        return $item;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GlobalValue  $globalValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AureoleLookup $aureoleLookup)
    {
        $aureoleLookup->fill($request->all());
        $aureoleLookup->save();
        return $aureoleLookup;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GlobalValue  $globalValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
        $aureoleLookup->delete();
        // return Response::
        return response()->json(['response' => 'Deleted Successfully']);
    }

    /**
     * Get List of values for form
     */
    public function getLOV() {
        return Item::getLOV();
    }
    
    public function getItemCode(Request $request) {
        
        $request->validate([
            'item_name' => 'required',
        ]);
        
        $itemName = $request->item_name;
        $itemName = trim($itemName);

        $names = explode(' ', $itemName);
        $codePrefix = '';
        forEach($names as $name) {
           $codePrefix .= ucfirst($name)[0];
        }

        return Item::getItemCode($codePrefix);
    }
}
