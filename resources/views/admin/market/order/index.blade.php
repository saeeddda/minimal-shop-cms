@extends('admin.layouts.master')
@section('title', 'ادمین - سفارشات')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'سفارشات'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">سفارشات</h3>
                            <a href="#" class="btn btn-success btn-sm"><i class="fa fa-plus mr-1"></i>ایجاد سفارش</a>

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
                            <div class="">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-sm">کد سفارش</th>
                                            <th class="text-sm">مبلغ سفارش</th>
                                            <th class="text-sm">تخفیف</th>
                                            <th class="text-sm">تخفیف محصولات</th>
                                            <th class="text-sm">مبلغ نهایی</th>
                                            <th class="text-sm">وضعیت پرداخت</th>
                                            <th class="text-sm">شیوه پراخت</th>
                                            <th class="text-sm">درگاه</th>
                                            <th class="text-sm">وضعیت ارسال</th>
                                            <th class="text-sm">شیوه ارسال</th>
                                            <th class="text-sm">وضعیت سفارش</th>
                                            <th class="text-sm">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->order_final_amount }} تومان</td>
                                                <td>{{ $order->order_discount_amount }} تومان</td>
                                                <td>{{ $order->order_total_products_discount_amount }} تومان</td>
                                                <td>{{ $order->getOrderTotalAmount }} تومان</td>
                                                <td>{{ $order->getOrderPaymentStatus }}</td>
                                                <td>{{ $order->getOrderPaymentType }}</td>
                                                <td>{{ $order->payment->paymentable->gateway ?? '-' }}</td>
                                                <td>{{ $order->getOrderDeliveryStatus }}</td>
                                                <td>{{ $order->delivery->name }}</td>
                                                <td>{{ $order->getOrderStatus }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-bars"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="{{ route('admin.market.order.show', $order->id) }}" class="dropdown-item">مشاهده فاکتور</a>
                                                            <a href="{{ route('admin.market.order.changeOrderStatus', $order->id) }}" class="dropdown-item">تغییر وضعیت سفارش</a>
                                                            <a href="{{ route('admin.market.order.changeSendStatus', $order->id) }}" class="dropdown-item">تغییر وضعیت ارسال</a>
                                                        </div>
                                                    </div>
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
