@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش ضمیمه ایمیل')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش ضمیمه ایمیل'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.notify.email-file.update', $emailFile->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ضمیمه ایمیل {{ Str::limit($emailFile->email->subject, 20) }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>وضعیت</label>
                                    <select class="form-control" name="status">
                                        <option value="0" @if(old('status', $emailFile->status) == 0) selected @endif>غیرفعال</option>
                                        <option value="1" @if(old('status', $emailFile->status) == 1) selected @endif>فعال</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger pt-2">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>فایل</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file" name="file">
                                        <label class="custom-file-label" for="file">انتخاب فایل</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.notify.email-file.index', $emailFile->email->id) }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره فایل</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
