@extends('admin.layouts.master')
@section('title', 'ادمین - پرداخت')

@section('content')
    @include('admin.layouts.breadcrumb', ['title' => 'پرداخت'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">پرداخت</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="user">کاربر</label>
                                            <input class="form-control" type="text" id="user" value="{{ $payment->user->fullName }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="amount">مبلغ</label>
                                            <input class="form-control" type="text" id="amount" value="{{ $payment->paymentable->amount }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="gateway">درگاه پرداخت</label>
                                            <input class="form-control" type="text" id="gateway" value="{{ $payment->paymentable->gateway ?? '-' }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="transaction_id">کد تراکنش</label>
                                            <input class="form-control" type="text" id="transaction_id" value="{{ $payment->paymentable->transaction_id ?? '-' }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="pay_date">تاریخ پرداخت</label>
                                            <input class="form-control" type="text" id="pay_date" value="{{ jalaliDate($payment->paymentable->pay_date) }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="status">وضعیت پرداخت</label>
                                            <select class="form-control" id="status" disabled>
                                                <option value="0" @if($payment->paymentable->status = 0) selected @endif>پرداخت نشده</option>
                                                <option value="1" @if($payment->paymentable->status = 1) selected @endif>پرداخت شده</option>
                                                <option value="2" @if($payment->paymentable->status = 2) selected @endif>لغو شده</option>
                                                <option value="3" @if($payment->paymentable->status = 3) selected @endif>مسترد شده</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="cash_receiver">دریافت کننده</label>
                                            <input class="form-control" type="text" id="cash_receiver" value="{{ $payment->paymentable->cash_receiver ?? '-' }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.market.comment.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
{{--                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
