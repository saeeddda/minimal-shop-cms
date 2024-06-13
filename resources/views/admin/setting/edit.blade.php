@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش تنظیمات')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش تنظیمات'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش تنظیمات</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>عنوان سایت</label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title', $setting->title) }}">
                                    @error('title')
                                        <div class="text-danger pt-2">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>توضیحات سایت</label>
                                    <textarea class="form-control" name="description" rows="4">{{ old('title', $setting->description) }}</textarea>
                                    @error('description')
                                        <div class="text-danger pt-2">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>کلمات کلیدی</label>
                                    <input type="text" class="form-control" name="keywords" value="{{ old('keywords', $setting->keywords) }}">
                                    @error('keywords')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>لوگو</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="logo" name="logo">
                                        <label class="custom-file-label" for="logo">انتخاب تصویر</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>آیکون</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="icon" name="icon">
                                        <label class="custom-file-label" for="icon">انتخاب تصویر</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.setting.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
