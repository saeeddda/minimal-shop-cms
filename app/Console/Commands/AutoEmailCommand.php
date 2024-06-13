<?php

namespace App\Console\Commands;

use App\Jobs\SendUsersEmailJob;
use App\Models\Notify\Email;
use Illuminate\Console\Command;

class AutoEmailCommand extends Command
{
    protected $signature = 'shop:auto_email';

    protected $description = 'Automate send email notify to users';

    public function handle(): void
    {
        $emails = Email::where('published_at', '=', now())->get();

        foreach ($emails as $email){
            SendUsersEmailJob::dispatch($email);
        }
    }
}
