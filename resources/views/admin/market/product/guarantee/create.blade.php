@extends('admin.layouts.master')
@section('title', 'ادمین - ایجاد گارانتی محصول')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ایجاد گارانتی محصول'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.market.product.guarantee.store', $product->id) }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ایجاد گارانتی محصول : {{ $product->name }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>نام گارانتی</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                    @error('name')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>مقدار افزایش قیمت</label>
                                    <input type="text" name="price_increase" value="{{ old('price_increase') }}" class="form-control">
                                    @error('price_increase')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.market.product.guarantee.index', $product->id) }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
