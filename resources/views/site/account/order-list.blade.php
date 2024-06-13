@extends('site.layouts.master')
@section('title', 'فروشگاه آمازون')

@section('content')
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                @include('site.account.partials.sidebar-menu')
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>تاریخچه سفارشات</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->


                        <section class="d-flex justify-content-center my-4">
                            <a class="btn btn-info btn-sm mx-1" href="{{ route('site.account.orders.index') }}">تمام سفارشات</a>
                            <a class="btn btn-warning btn-sm mx-1" href="{{ route('site.account.orders.index', 'type=1') }}">در حال پردازش</a>
                            <a class="btn btn-info btn-sm mx-1" href="{{ route('site.account.orders.index', 'type=2') }}">تائید نشده</a>
                            <a class="btn btn-success btn-sm mx-1" href="{{ route('site.account.orders.index', 'type=3') }}">تحویل شده</a>
                            <a class="btn btn-dark btn-sm mx-1" href="{{ route('site.account.orders.index', 'type=4') }}">لغو شده</a>
                            <a class="btn btn-danger btn-sm mx-1" href="{{ route('site.account.orders.index', 'type=5') }}">مرجوعی</a>
                        </section>


                        <!-- start content header -->
                        <section class="content-header mb-3">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    در انتظار پرداخت
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end content header -->


                        <section class="order-wrapper">
                            @forelse($orders as $order)
                                <section class="order-item">
                                    <section class="d-flex justify-content-between">
                                        <section>
                                            <section class="order-item-date"><i class="fa fa-calendar-alt"></i>{{ jalaliDate($order->created_at) }}</section>
                                            <section class="order-item-id"><i class="fa fa-id-card-alt"></i>کد سفارش : {{ $order->id }}</section>
                                            <section class="order-item-status"><i class="fa fa-clock"></i>{{ $order->getOrderStatus }}</section>
                                            <section class="order-item-products">

                                                <a href="#"><img src="{{ asset('site-assets/images/products/1.jpg') }}" alt=""></a>
                                                <a href="#"><img src="{{ asset('site-assets/images/products/2.jpg') }}" alt=""></a>
                                            </section>
                                        </section>
                                        <section class="order-item-link"><a href="#">پرداخت سفارش</a></section>
                                    </section>
                                </section>
                            @empty
                                <section class="order-item">
                                    سفارشی یافت نشد
                                </section>
                            @endforelse
                        </section>
                    </section>
                </main>
            </section>
        </section>
    </section>
@endsection
