<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Support\Facades\Mail as SendMail;
use App\Http\Models\Sys\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\TestEmail;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sys.mail.index', ['values' => Mail::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys.mail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validation = [
            'group' => 'required|max:255',
            'template_name'=> 'required|max:255',
            'code'=> 'required|max:255|unique:mails',
            'subject' => 'required|max:255',
            'to' => 'required|max:255',
            'cc' => 'max:255',
            'bcc' => 'max:255'
        ];

        $request->validate($validation);
        $mail = new Mail();
        $mail->fill($request->except(['id']));
        $mail->save();
        return redirect()->back()->withInput()->with('message', 'Mail created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Sys\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function show(Mail $mail)
    {
        //
        return view('sys.mail.show', ['mail' => $mail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Sys\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function edit(Mail $mail)
    {
        return view('sys.mail.edit', ['mail' => $mail]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Sys\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mail $mail)
    {
        $validation = [
            'group' => 'required|max:255',
            'template_name'=> 'required|max:255',
            'code'=> 'required|max:255',
            'subject' => 'required|max:255',
            'to' => 'required|max:255',
            'cc' => 'max:255',
            'bcc' => 'max:255'
        ];

        $request->validate($validation);
        $mail->fill($request->except(['id']));
        $mail->save();

        return redirect('sys/mail/'.$mail->id)->with('message', 'Mail Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Sys\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mail $mail)
    {
        //
    }

    public function simulate(Request $request) {
        $mail = Mail::find($request->mailId);
        $params = $request->param;
        $params = json_decode($params, true);
            SendMail::to($request->email)
                ->send(new TestEmail($mail->verbose, $mail->subject, $params));
        return (new TestEmail($mail->verbose, $mail->subject, $params))->render();
    }
}
