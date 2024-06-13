@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش منو سایت')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش منو سایت'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.content.menu.update', $menu->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش منو سایت</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>عنوان</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $menu->name) }}">
                                            @error('name')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>آدرس url</label>
                                            <input type="text" class="form-control" name="url" value="{{ old('url', $menu->url) }}">
                                            @error('url')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>دسته والد</label>
                                            <select class="form-control" name="parent_id">
                                                <option value="">منو اصلی</option>
                                                @foreach($parents as $parent)
                                                    <option value="{{ $parent->id }}" @if($menu->parent_id != null) @if(old('parent_id', $menu->parent_id) === $parent->id) selected @endif @endif>{{ $parent->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>وضعیت</label>
                                            <select class="form-control" name="status">
                                                <option value="0" @if(old('status', $menu->status) == 0) selected @endif>غیرفعال</option>
                                                <option value="1" @if(old('status', $menu->status) == 1) selected @endif>فعال</option>
                                            </select>
                                            @error('status')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.content.menu.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
