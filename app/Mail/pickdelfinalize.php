<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;


class pickdelfinalize extends Mailable
{
    use Queueable, SerializesModels;

 public $data; //aytos tha einai o pinakas poy gemizv me keys kai meta emfanizetai sto mail, ton pairno kata th dimiourgia ths klashs new MailOut
 public $type;  //typos gia na xerei ti tha xrisimopoihsei
 
 
 /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datafromcontroller)
    {
        $this->data=$datafromcontroller;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        $subject=$this->data['subject'];
        // $subject = $this->data->subject;
        return $this
       //->attachFromStorage("51/0/N6zKzmSRvXvNxUGJ0tc2CuFwi6RM3mgk5JNQDeTW.png")
       ->with(['maildata' => $this->data])
        ->subject($subject)
        ->view('layouts.emails.finalize');

                    
        
    }
}
