@extends('admin.layouts.master')
@section('title', 'ادمین - پرداخت ها')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'پرداخت ها'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">پرداخت ها</h3>

                            <div class="card-tools">
                                <form action="">
                                    <div class="input-group input-group-sm">
                                        <input type="search" name="search" class="form-control" placeholder="جستجو...">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-sm">#</th>
                                            <th class="text-sm">کد تراکنش</th>
                                            <th class="text-sm">درگاه</th>
                                            <th class="text-sm">پرداخت کننده</th>
                                            <th class="text-sm">وضعیت پرداخت</th>
                                            <th class="text-sm">نوع پرداخت</th>
                                            <th class="text-sm">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->id }}</td>
                                                <td>{{ $payment->paymentable->transaction_id ?? '-' }}</td>
                                                <td>{{ $payment->paymentable->gateway ?? '-' }}</td>
                                                <td>{{ $payment->user->fullName }}</td>
                                                <td>
                                                    @if($payment->status == 0)
                                                        پرداخت نشده
                                                    @elseif($payment->status == 1)
                                                        پرداخت شده
                                                    @elseif($payment->status == 2)
                                                        لغو شده
                                                    @else
                                                        مسترد شده
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($payment->type == 0)
                                                        آنلاین
                                                    @elseif($payment->type == 1)
                                                        آفلاین
                                                    @else
                                                        درمحل
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.market.payment.show', $payment->id) }}" class="btn btn-success btn-sm"><i class="fa fa-eye mr-1"></i>نمایش</a>
                                                    <a href="{{ route('admin.market.payment.cancel', $payment->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-times mr-1"></i>لغو</a>
                                                    <a href="{{ route('admin.market.payment.returned', $payment->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-reply mr-1"></i>استرداد</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="card-tools">
                                <ul class="pagination pagination-sm float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
