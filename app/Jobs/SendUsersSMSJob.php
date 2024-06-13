<?php

namespace App\Jobs;

use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\SmsService;
use App\Models\Notify\SMS;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendUsersSMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly SMS $sms)
    {
    }

    public function handle(): void
    {
        $users = User::whereNotNull('mobile')->get();

        foreach ($users as $user) {
            $smsService = new SmsService();
            $smsService->setFrom(config('sms.from'));
            $smsService->setTo('0' . $user->mobile);
            $smsService->setText($this->sms->body);

            $message = new MessageService($smsService);
            $message->send();
        }
    }
}
