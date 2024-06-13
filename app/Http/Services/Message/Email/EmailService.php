<?php

namespace App\Http\Services\Message\Email;

use App\Http\Services\Message\Interfaces\MessageInterface;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;

class EmailService implements MessageInterface
{
    private $details;
    private $from = [
        ['address' => null, 'name' => null],
    ];
    private $to;
    private $subject;
    private $files = [];

    public function fire()
    {
        Mail::to($this->to)->send(new MailViewProvider(
            $this->details,
            $this->subject,
            $this->from,
            $this->files
        ));
        return true;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function setDetails($details)
    {
        $this->details = $details;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($address, $name)
    {
        $this->from = [
            [
                'address' => $address,
                'name' => $name
            ]
        ];
    }

    public function setAttachmentFiles($files){
        $this->files = $files;
    }

    public function getAttachmentFiles(){
        return $this->files;
    }
}
