@extends('site.layouts.master')
@section('title', 'لیست علاقه مندی ها')

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
                                    <span>لیست علاقه های من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->

                        @forelse(auth()->user()->products as $product)
                            <section class="cart-item d-flex py-3">
                                <section class="cart-img align-self-start flex-shrink-1"><img src="{{ asset($product->image['index_array']['medium']) }}" alt="{{ $product->name }}"></section>
                                <section class="align-self-start w-100">
                                    <p class="fw-bold">{{ $product->name }}</p>
                                    <section class="text-nowrap fw-bold">قیمت کالا : {{ priceFormat($product->price) }}</section>
                                    <section class="pt-3">
                                        <a class="text-decoration-none cart-delete" href="{{ route('site.account.favorite.remove', $product->id) }}"><i class="fa fa-trash-alt"></i> حذف از لیست علاقه ها</a>
                                    </section>
                                </section>
                            </section>
                        @empty
                            <section class="cart-item d-flex py-3">
                                محصولی یافت نشد
                            </section>
                        @endforelse
                    </section>
                </main>
            </section>
        </section>
    </section>
@endsection
