<?php

namespace App\Console\Commands;

use App\Jobs\SendUsersSMSJob;
use App\Models\Notify\SMS;
use Illuminate\Console\Command;

class AutoSMSCommand extends Command
{
    protected $signature = 'shop:auto_sms';

    protected $description = 'Automate send sms notify to users';

    public function handle(): void
    {
        $sms = SMS::where('published_at', '=', now())->get();

        foreach ($sms as $sms_single){
            SendUsersSMSJob::dispatch($sms_single);
        }
    }
}
