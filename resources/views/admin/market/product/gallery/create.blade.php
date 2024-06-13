@extends('admin.layouts.master')
@section('title', 'ادمین - افزودن تصویر گالری محصول')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'آپلود تصویر گالری محصول'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.market.product.gallery.store', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">آپلود تصویر گالری محصول : {{ $product->name }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>تصویر گالری</label>
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
                            <div class="card-footer">
                                <a href="{{ route('admin.market.product.gallery.index', $product->id) }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
