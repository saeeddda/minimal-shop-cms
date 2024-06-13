@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش مقدار فرم کالا')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش مقدار فرم کالا'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.market.property.value.update', ['categoryAttribute' => $categoryAttribute->id, 'categoryValue' => $categoryValue->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش مقدار فرم کالا</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>محصول</label>
                                    <select class="form-control" name="product_id">
                                        @foreach($categoryAttribute->category->products as $product)
                                            <option value="{{ $product->id }}" @if(old('product_id', $categoryValue->product_id) == $product->id) selected @endif>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>مقدار</label>
                                    <input type="text" class="form-control" name="value" value="{{ old('value', json_decode($categoryValue->value)->value) }}">
                                    @error('value')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>میزان افزایش قیمت</label>
                                    <input type="text" class="form-control" name="price_increase" value="{{ old('price_increase', json_decode($categoryValue->value)->price_increase) }}">
                                    @error('price_increase')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>نوع</label>
                                    <select class="form-control" name="type">
                                        <option value="0" @if(old('type', $categoryValue->type) == 0) selected @endif>ساده</option>
                                        <option value="1" @if(old('type', $categoryValue->type) == 1) selected @endif>انتخابی</option>
                                    </select>
                                    @error('type')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.market.property.value.index', $categoryAttribute->id) }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
