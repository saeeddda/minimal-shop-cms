@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش اعلان ایمیلی')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش اعلان ایمیلی'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.notify.email.update', $email->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش اعلان ایمیلی</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>عنوان ایمیل</label>
                                            <input type="text" class="form-control" name="subject" value="{{ old('subject', $email->subject) }}">
                                            @error('subject')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>تاریخ انتشار</label>
                                            <input type="text" id="published_view" class="form-control" value="{{ $email->subject }}">
                                            <input type="hidden" id="published_at" name="published_at" class="form-control" value="{{ $email->subject }}">
                                            @error('published_at')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>وضعیت</label>
                                            <select class="form-control" name="status">
                                                <option value="0" @if(old('status', $email->status) == 0) selected @endif>غیرفعال</option>
                                                <option value="1" @if(old('status', $email->status) == 1) selected @endif>فعال</option>
                                            </select>
                                            @error('status')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>متن ایمیل</label>
                                            <textarea name="body" id="email_content" rows="15" class="form-control">{{ old('body', $email->body) }}</textarea>
                                            @error('body')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.notify.email.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('admin-styles')
    <link rel="stylesheet" href="{{ asset('admin-assets/css/persian-datepicker.css') }}">
@endsection

@section('admin-scripts')
    <script src="{{ asset('admin-assets/js/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('email_content',{
            language: 'fa',
            rtl: true,
        });
        jQuery(document).ready(function($){
            $('#published_view').persianDatepicker({
                altField: '#published_at',
                format: 'YYYY/MM/DD HH:MM:ss',
                timePicker: {
                    enabled: true
                }
            });
        });
    </script>
@endsection
