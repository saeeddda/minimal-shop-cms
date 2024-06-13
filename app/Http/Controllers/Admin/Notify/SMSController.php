<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\SMSRequest;
use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\SmsService;
use App\Jobs\SendUsersSMSJob;
use App\Models\Notify\SMS;
use App\Models\User;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function index()
    {
        $sms = SMS::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.notify.sms.index', compact('sms'));
    }

    public function create()
    {
        return view('admin.notify.sms.create');
    }

    public function store(SMSRequest $request)
    {
        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        $sms_result = SMS::create($inputs);

        return redirect()->route('admin.notify.sms.index')
            ->with('alert-success','پیامک اضافه شد.');
    }

    public function edit(SMS $sms)
    {
        return view('admin.notify.sms.edit',compact('sms'));
    }

    public function update(SMSRequest $request, SMS $sms)
    {
        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        $sms->update($inputs);

        return redirect()->route('admin.notify.sms.index')
            ->with('alert-success','پیامک ویرایش شد.');
    }

    public function destroy(SMS $sms)
    {
        $sms->delete();
        return redirect()->route('admin.notify.sms.index')
            ->with('alert-success', 'پیامک حذف شد');
    }

    public function status(SMS $sms){
        $sms->status = $sms->status == 1 ? 0 : 1;
        $result = $sms->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $sms->status == 1 ? true : false
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function sendSMS(SMS $sms){
        SendUsersSMSJob::dispatch($sms);
        return redirect()->route('admin.notify.sms.index')->with('alert-success','پیامک با موفقیت ارسال شد.');
    }
}
