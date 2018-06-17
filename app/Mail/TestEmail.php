<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verbose, $subject, $params)
    {
        $this->verbose = $verbose;
        $this->subject = $subject;
        $this->params = $params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $params = $this->params;
        
        $replacedVerbose = $this->verbose;
        foreach( $params as $index => $value) {
            $replacedVerbose = str_replace('{'.$index.'}', $value, $replacedVerbose);
        }

        return $this->view('mails.test')
                    ->subject($this->subject)
                    ->with([ 'verbose' => $replacedVerbose ]);
    }
}
