<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailFileRequest;
use App\Http\Services\File\FileService;
use App\Models\Notify\Email;
use App\Models\Notify\EmailFile;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

class EmailFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Email $email)
    {
        return view('admin.notify.email-file.index', compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Email $email)
    {
        return view('admin.notify.email-file.create', compact('email'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailFileRequest $request, Email $email, FileService $fileService)
    {
        $inputs = $request->all();

        if($request->hasFile('file')) {
            $inputs['public_mail_id'] = $email->id;
            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
            $fileService->setFileSize($request->file('file'));
            $result = $fileService->moveToPublic($request->file('file'));

            if ($result == false) {
                return redirect()->route('admin.notify.email-file.index', $email->id)
                    ->with('alert-warning', 'آپلود فایل با خطا مواجه شد!');
            }

            $inputs['file_path'] = $result;
            $inputs['file_size'] = $fileService->getFileSize();
            $inputs['file_type'] = $fileService->getFileFormat();
        }

        EmailFile::create($inputs);

        return redirect()->route('admin.notify.email-file.index', $email->id)
            ->with('alert-success', 'فایل ضمیمه جدید اضافه شد.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailFile $emailFile)
    {
        return view('admin.notify.email-file.edit', compact('emailFile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailFileRequest $request, EmailFile $emailFile, FileService $fileService)
    {
        $inputs = $request->all();

        if($request->hasFile('file')) {
            if(!empty($emailFile->file_path)){
                $fileService->deleteFile($emailFile->file_path);
            }

            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
            $fileService->setFileSize($request->file('file'));
            $result = $fileService->moveToPublic($request->file('file'));

            if ($result == false) {
                return redirect()->route('admin.notify.email-file.index', $emailFile->email->id)
                    ->with('alert-warning', 'آپلود فایل با خطا مواجه شد!');
            }

            $inputs['file_path'] = $result;
            $inputs['file_size'] = $fileService->getFileSize();
            $inputs['file_type'] = $fileService->getFileFormat();
        }

        $emailFile->update($inputs);

        return redirect()->route('admin.notify.email-file.index', $emailFile->email->id)
            ->with('alert-success', 'فایل ضمیمه ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailFile $emailFile)
    {
        $emailId = $emailFile->email->id;
        $emailFile->delete();
        return redirect()->route('admin.notify.email-file.index', $emailId)
            ->with('alert-success', 'ضمیمه ایمیل حذف شد');
    }

    public function status(EmailFile $emailFile){
        $emailFile->status = $emailFile->status == 1 ? 0 : 1;
        $result = $emailFile->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $emailFile->status == 1 ? true : false
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
