@extends('site.layouts.master')
@section('title', 'لیست مقایسه من')

@section('content')
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                @include('site.account.partials.sidebar-menu')
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>لیست مقایسه من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->

                        @php
                            $all_products = auth()->user()->compare->products;
                        @endphp

                        @if($all_products->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>عکس محصول</td>
                                            @foreach($all_products as $product)

                                                <td>
                                                    <img src="{{ asset($product->image['index_array']['small']) }}" alt="" width="100">
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>نام محصول</td>
                                            @foreach($all_products as $product)
                                                <td>{{ $product->name }}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>قیمت محصول</td>
                                            @foreach($all_products as $product)
                                                <td>{{ priceFormat($product->price) }}</td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>لیست مقایسه شما خالی است</p>
                        @endif
                    </section>
                </main>
            </section>
        </section>
    </section>
@endsection
