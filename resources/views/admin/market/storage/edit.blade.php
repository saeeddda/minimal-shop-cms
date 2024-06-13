@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش موجودی')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش موجودی'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.market.storage.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش موجودی : {{ $product->name }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>قابل فروش</label>
                                            <input type="text" class="form-control" name="marketable_number" value="{{ old('marketable_number', $product->marketable_number) }}">
                                            @error('marketable_number')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>رزرو شده</label>
                                            <input type="text" class="form-control" name="frozen_number" value="{{ old('frozen_number', $product->frozen_number) }}">
                                            @error('frozen_number')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>فروخته شده</label>
                                            <input type="text" class="form-control" name="sold_number" value="{{ old('sold_number', $product->sold_number) }}">
                                            @error('sold_number')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.market.storage.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
