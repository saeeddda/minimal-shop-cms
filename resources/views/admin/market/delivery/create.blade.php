@extends('admin.layouts.master')
@section('title', 'ادمین - افزودن روش ارسال')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'روش ارسال محصول'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.market.delivery.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">روش ارسال جدید</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>عنوان</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                            @error('name')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>مبلغ</label>
                                            <input type="text" class="form-control" name="amount" value="{{ old('amount') }}">
                                            @error('amount')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>زمان</label>
                                            <input type="text" class="form-control" name="delivery_time" value="{{ old('delivery_time') }}">
                                            @error('delivery_time')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>واحد زمان</label>
                                            <input type="text" class="form-control" name="delivery_time_unit" value="{{ old('delivery_time_unit') }}">
                                            @error('delivery_time_unit')
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
                                                <option value="0">غیرفعال</option>
                                                <option value="1">فعال</option>
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
                                <a href="{{ route('admin.market.delivery.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
