@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش مدیر')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش مدیر'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.user.admin.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش مدیر</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>نام</label>
                                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $user->first_name) }}">
                                            @error('first_name')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>نام خانوادگی</label>
                                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                                            @error('last_name')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>تصویر</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="avatar" name="profile_photo_path">
                                                <label class="custom-file-label" for="avatar">انتخاب تصویر</label>
                                                @error('profile_photo_path')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        @if(!empty($user->profile_photo_path))
                                            <div class="form-group">
                                                <img src="{{ asset($user->profile_photo_path) }}" width="80" height="80" alt="{{ $user->fullName }}">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>وضعیت کاربر</label>
                                            <select class="form-control" name="activation">
                                                <option value="0" @if(old('activation', $user->activation) == 0) selected @endif>غیرفعال</option>
                                                <option value="1" @if(old('activation', $user->activation) == 1) selected @endif>فعال</option>
                                            </select>
                                            @error('activation')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.user.admin.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
