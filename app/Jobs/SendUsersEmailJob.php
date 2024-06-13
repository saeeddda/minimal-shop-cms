<?php

namespace App\Jobs;

use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Models\Notify\Email;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendUsersEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly Email $email)
    {
    }

    public function handle(): void
    {
        $users = User::whereNotNull('email')->get();

        foreach ($users as $user) {
            $all_files = [];

            foreach ($this->email->files()->where('status', 1)->get() as $file)
                $all_files[] = $file->file_path;

            $email_service = new EmailService();
            $email_service->setDetails([
                'title' => $this->email->subject,
                'body' => $this->email->body
            ]);
            $email_service->setTo($user->email);
            $email_service->setSubject($this->email->subject);
            $email_service->setAttachmentFiles($all_files);
            $email_service->setFrom('admin@localhost.com', 'Localhost');

            $message = new MessageService($email_service);
            $message->send();
        }
    }
}
