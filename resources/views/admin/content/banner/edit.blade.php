@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش بنر')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش بنر'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.content.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش بنر</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>عنوان</label>
                                            <input type="text" class="form-control" name="title" value="{{ old('title', $banner->title) }}">
                                            @error('title')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>آدرس</label>
                                            <input type="text" class="form-control" name="url" value="{{ old('url', $banner->url) }}">
                                            @error('url')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>موقعیت</label>
                                            <select class="form-control" name="position">
                                                <option value="0" @if(old('position', $banner->position) == 0) selected @endif>اسلایدر اصلی</option>
                                                <option value="1" @if(old('position', $banner->position) == 1) selected @endif>بنر کنار اسلایدر اصلی</option>
                                                <option value="2" @if(old('position', $banner->position) == 2) selected @endif>بنر وسط صفحه اصلی</option>
                                                <option value="3" @if(old('position', $banner->position) == 3) selected @endif>بنر پایین صفحه اصلی</option>
                                            </select>
                                            @error('position')
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
                                                <option value="0" @if(old('status', $banner->status) == 0) selected @endif>غیرفعال</option>
                                                <option value="1" @if(old('status', $banner->status) == 1) selected @endif>فعال</option>
                                            </select>
                                            @error('status')
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
                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                <label class="custom-file-label" for="image">انتخاب تصویر</label>
                                            </div>
                                            @error('image')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.content.banner.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

