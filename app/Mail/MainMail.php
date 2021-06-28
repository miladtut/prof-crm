<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MainMail extends Mailable
{
    use Queueable, SerializesModels;
    public $title;
    public $content;


    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function build()
    {
        $data['title']= $this->title;
        $data['content']= $this->content;
        return $this->from(config('mail.from.address'),config('mail.from.name') )->subject($this->title)->view('mail.main',$data);

    }
}
