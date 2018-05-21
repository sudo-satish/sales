<?php

namespace App\Http\Controllers\Sys;

use App\GlobalValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GlobalValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('sys.global-value.index')->with('globalValues', GlobalValue::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sys.global-value.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // echo 'sadf '; exit;
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|unique:global_values|max:50',
            'value' => 'required',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        // dd($request->all());
        $globalValue = new GlobalValue();
        $globalValue->fill($request->all());
        $globalValue->save();
        return back()->with('message', 'Global Value saved Sucessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GlobalValue  $globalValue
     * @return \Illuminate\Http\Response
     */
    public function show(GlobalValue $globalValue)
    {
        //
        return view('sys.global-value.show', ['globalValue' => $globalValue]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GlobalValue  $globalValue
     * @return \Illuminate\Http\Response
     */
    public function edit(GlobalValue $globalValue)
    {
        //
        // dd($globalValue->getAttributes());
        // print_r($globalValue->attributes);

        return view('sys.global-value.edit', ['globalValue' => $globalValue]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GlobalValue  $globalValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GlobalValue $globalValue)
    {
        //
        // print_r($request->all());
        // print_r($globalValue->getAttributes());
        $globalValue->fill($request->all());
        $globalValue->save();
        // dd($globalValue->getAttributes());
        // Session::flash('message', 'Successfully updated Global Value');
        return redirect('sys/global-value')->with('message', 'Successfully updated Global Value');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GlobalValue  $globalValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(GlobalValue $globalValue)
    {
        //
    }
}
