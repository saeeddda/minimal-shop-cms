@extends('admin.layouts.master')
@section('title', 'ادمین - افزودن رنگ محصول')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'افزودن رنگ محصول'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.market.product.color.store', $product->id) }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">افزودن رنگ محصول : {{ $product->name }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>عنوان رنگ محصول</label>
                                            <input type="text" class="form-control" name="color_name" value="{{ old('color_name') }}">
                                            @error('color_name')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>رنگ محصول</label>
                                            <input type="color" class="form-control" name="color_code" value="{{ old('color_code') }}">
                                            @error('color_code')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>میزان افزایش قیمت</label>
                                            <input type="text" class="form-control" name="price_increase" value="{{ old('price_increase') }}">
                                            @error('price_increase')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.market.product.color.index', $product->id) }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
