<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailRequest;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Jobs\SendUsersEmailJob;
use App\Models\Notify\Email;
use App\Models\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.notify.email.index', compact('emails'));
    }

    public function create()
    {
        return view('admin.notify.email.create');
    }

    public function store(EmailRequest $request)
    {
        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        $sms_result = Email::create($inputs);

        return redirect()->route('admin.notify.email.index')
            ->with('alert-success','ایمیل اضافه شد.');

    }

    public function edit(Email $email)
    {
        return view('admin.notify.email.edit', compact('email'));
    }

    public function update(EmailRequest $request, Email $email)
    {
        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        $email->update($inputs);

        return redirect()->route('admin.notify.email.index')
            ->with('alert-success','ایمیل ویرایش شد.');
    }

    public function destroy(Email $email)
    {
        $email->delete();
        return redirect()->route('admin.notify.email.index')
            ->with('alert-success', 'ایمیل حذف شد');
    }

    public function status(Email $email){
        $email->status = $email->status == 1 ? 0 : 1;
        $result = $email->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $email->status == 1 ? true : false
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function sendMail(Email $email){
        SendUsersEmailJob::dispatch($email);

        return redirect()->route('admin.notify.email.index')->with('alert-success','ایمیل با موفقیت ارسال شد.');
    }
}
