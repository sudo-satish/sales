<?php

namespace App\Http\Controllers\Sys;

use App\Http\Models\Sys\SendMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SendMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sys.send-mail.index', ['values' => SendMail::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys.send-mail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Sys\SendMail  $sendMail
     * @return \Illuminate\Http\Response
     */
    public function show(SendMail $sendMail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Sys\SendMail  $sendMail
     * @return \Illuminate\Http\Response
     */
    public function edit(SendMail $sendMail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Sys\SendMail  $sendMail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SendMail $sendMail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Sys\SendMail  $sendMail
     * @return \Illuminate\Http\Response
     */
    public function destroy(SendMail $sendMail)
    {
        //
    }
}
