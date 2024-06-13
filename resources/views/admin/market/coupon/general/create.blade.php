@extends('admin.layouts.master')
@section('title', 'ادمین - افزودن تخفیف عمومی')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'افزودن تخفیف عمومی'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.market.coupon.general.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">افزودن تخفیف عمومی</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>عنوان تخفیف</label>
                                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                            @error('title')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>درصد تخفیف</label>
                                            <input type="text" class="form-control" name="percentage" value="{{ old('percentage') }}">
                                            @error('percentage')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>حداکثر تخفیف</label>
                                            <input type="text" class="form-control" name="discount_selling" value="{{ old('discount_selling') }}">
                                            @error('discount_selling')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>حداقل مبلغ خرید</label>
                                            <input type="text" class="form-control" name="minimum_order_amount" value="{{ old('minimum_order_amount') }}">
                                            @error('minimum_order_amount')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>تاریخ شروع</label>
                                            <input type="text" class="form-control" id="start_date_view" value="{{ old('start_date') }}">
                                            <input type="hidden" class="form-control" id="start_date_code" name="start_date" value="{{ old('start_date') }}">
                                            @error('start_date')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>تاریخ پایان</label>
                                            <input type="text" class="form-control" id="end_date_view" value="{{ old('end_date') }}">
                                            <input type="hidden" class="form-control" id="end_date_code" name="end_date" value="{{ old('end_date') }}">
                                            @error('end_date')
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
                                                <option value="0" @if(old('status') == 0) selected @endif>غیرفعال</option>
                                                <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
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
                                <a href="{{ route('admin.market.coupon.general.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('admin-styles')
    <link rel="stylesheet" href="{{ asset('admin-assets/css/persian-datepicker.css') }}">
@endsection

@section('admin-scripts')
    <script src="{{ asset('admin-assets/js/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/persian-datepicker.min.js') }}"></script>
    <script>
        jQuery(document).ready(function($){
            $('#start_date_view').persianDatepicker({
                altField: '#start_date_code',
                format: 'YYYY/MM/DD HH:MM:ss',
                timePicker: {
                    enabled: true
                }
            });
            $('#end_date_view').persianDatepicker({
                altField: '#end_date_code',
                format: 'YYYY/MM/DD HH:MM:ss',
                timePicker: {
                    enabled: true
                }
            });
        });
    </script>
@endsection
