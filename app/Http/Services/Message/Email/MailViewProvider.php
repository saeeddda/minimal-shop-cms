<?php

namespace App\Http\Services\Message\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailViewProvider extends Mailable
{
    use Queueable, SerializesModels;

    public array $details;
    public mixed $files;

    public function __construct($details, $subject, $from, $files = null)
    {
        $this->details = $details;
        $this->subject = $subject;
        $this->from = $from;
        $this->files = $files;
    }

    public function build()
    {
        return $this->subject($this->subject)->view('emails.send-otp');
    }

    public function attachments(): array
    {
        $all_files = [];

        if($this->files)
            foreach ($this->files as $file)
                $all_files[] = public_path($file);

        return $all_files;
    }
}
