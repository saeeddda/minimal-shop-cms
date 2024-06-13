@extends('site.layouts.master')
@section('title','سبد خرید - فروشگاه آمازون')

@section('content')
    <!-- start main one col -->
    <main id="main-body-one-col" class="main-body">
        <div class="container">
            @include('site.alerts.alert-section.info')
            @include('site.alerts.alert-section.success')
            @include('site.alerts.alert-section.danger')
            @include('site.alerts.alert-section.warning')
        </div>
        <!-- start cart -->
        <section class="mb-4">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>سبد خرید شما</span>
                                </h2>
                            </section>
                        </section>

                        <form action="{{ route('site.sale.cart-update') }}" id="cart_form" method="POST">
                            @csrf
                            <section class="row mt-4">
                                <section class="col-md-9 mb-3">
                                    <section class="content-wrapper bg-white p-3 rounded-2">

                                        @php
                                            $totalCartPrice = 0;
                                            $totalCartDiscountPrice = 0;
                                        @endphp
                                        @foreach($cartItems as $item)
                                            @php
                                                $totalCartPrice += $item->cartItemTotalPrice();
                                                $totalCartDiscountPrice += $item->cartItemTotalDiscount();
                                            @endphp
                                            <section class="cart-item d-md-flex py-3">
                                                <section class="cart-img align-self-start flex-shrink-1">
                                                    <img src="{{ asset($item->product->image['index_array']['small']) }}" alt="{{ $item->product->name }}">
                                                </section>
                                                <section class="align-self-start w-100">
                                                    <p class="fw-bold">{{ $item->product->name }}</p>
                                                    @if($item->color != null)
                                                        <p>
                                                            <span style="background-color: {{ $item->color->color_code }};" class="cart-product-selected-color me-1"></span> <span> {{ $item->color->color_name }}</span>
                                                        </p>
                                                    @endif
                                                    @if($item->guarantee != null)
                                                        <p>
                                                            <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i> <span> {{ $item->guarantee->name }}</span>
                                                        </p>
                                                    @endif
                                                    @if($item->product->marketable_number > 0)
                                                        <p>
                                                            <i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا موجود در انبار</span>
                                                        </p>
                                                    @endif

                                                    <section>
                                                        <section class="cart-product-number d-inline-block ">
                                                            <button class="cart-number-down" type="button">-</button>
                                                            <input class="cart-number" name="number[{{ $item->id }}]" type="number" min="1" step="1" value="{{ $item->number }}" readonly="readonly">
                                                            <button class="cart-number-up" type="button">+</button>
                                                        </section>
                                                        <a class="text-decoration-none ms-4 cart-delete" href="{{ route('site.sale.remove-from-cart', $item->id) }}"><i class="fa fa-trash-alt"></i> حذف از سبد</a>
                                                    </section>
                                                </section>

                                                <section class="align-self-end flex-shrink-1">
                                                    @if(!empty($item->cartItemDiscountPrice()))
                                                        <section class="cart-item-discount text-danger text-nowrap mb-1">تخفیف {{ priceFormat($item->cartItemDiscountPrice()) }} تومان</section>
                                                    @endif
                                                    <section class="text-nowrap fw-bold">{{ priceFormat($item->cartItemPrice()) }} تومان</section>
                                                </section>
                                            </section>
                                        @endforeach

                                        <section>
                                            <button type="submit" class="btn btn-primary mt-3">بروزرسانی سبد</button>
                                        </section>

                                    </section>
                                </section>
                                <section class="col-md-3">
                                    <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted" id="total_cart_count">قیمت کالاها ({{ $cartItems->count() }})</p>
                                            <p class="text-muted" id="total_cart_price">{{ priceFormat($totalCartPrice) }} تومان</p>
                                        </section>

                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted">تخفیف کالاها</p>
                                            <p class="text-danger fw-bolder" id="total_cart_discount_price">{{ priceFormat($totalCartDiscountPrice) }} تومان</p>
                                        </section>
                                        <section class="border-bottom mb-3"></section>
                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted">جمع سبد خرید</p>
                                            <p class="fw-bolder" id="final_cart_price">{{ priceFormat($totalCartPrice - $totalCartDiscountPrice) }} تومان</p>
                                        </section>

                                        <p class="my-3">
                                            <i class="fa fa-info-circle me-1"></i>کاربر گرامی  خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش صورت میگیرد.
                                        </p>


                                        <section class="">
                                            <a href="{{ route('site.sale.shipping.index') }}" class="btn btn-danger d-block">تکمیل فرآیند خرید</a>
                                        </section>

                                    </section>
                                </section>
                            </section>
                        </form>
                    </section>
                </section>

            </section>
        </section>
        <!-- end cart -->


        <!-- start product lazy load -->
        <section class="mb-4">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>کالاهای مرتبط</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper" >
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">
                                    @foreach($relatedProducts as $product)
                                        <section class="item">
                                            <section class="lazyload-item-wrapper">
                                                <section class="product">
                                                    <section class="product-add-to-cart">
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید">
                                                            <i class="fa fa-cart-plus"></i>
                                                        </a>
                                                    </section>
                                                    <section class="product-add-to-favorite">
                                                        @auth
                                                            <button type="button"
                                                                    class="btn btn-light btn-sm @if($product->user->contains(auth()->user()->id)) text-danger @endif"
                                                                    onclick="addToFav(this)"
                                                                    data-url="{{ route('site.product.add-to-favorite', $product->id) }}"
                                                                    title="@if($product->user->contains(auth()->user()->id)) حذف از علاقه مندی@else افزودن به علاقه مندی @endif">
                                                                <i class="fa fa-heart"></i>
                                                            </button>
                                                        @endauth
                                                    </section>
                                                    <a class="product-link" href="{{ route('site.product.single', $product->slug) }}">
                                                        <section class="product-image">
                                                            <img class="" src="{{ asset($product->image['index_array']['medium']) }}" alt="{{ $product->name }}">
                                                        </section>
                                                        <section class="product-name">
                                                            <h3>{{ $product->name }}</h3>
                                                        </section>
                                                        <section class="product-price-wrapper">
                                                            <section class="product-price-wrapper">
                                                                @if(!empty($product->getActiveAmazingCoupon()))
                                                                    <section class="product-discount">
                                                                        <span class="product-old-price">{{ $product->getDiscountPriceFormated }} تومان</span>
                                                                        <span class="product-discount-amount">{{ convertEnglishNumToPersianNum($product->getActiveAmazingCoupon()->percentage) }}%</span>
                                                                    </section>
                                                                @endif
                                                                <section class="product-price">{{ $product->getSalePriceFormated }} تومان</section>
                                                            </section>
                                                        </section>
                                                        <section class="product-colors">
                                                            @foreach($product->colors as $color)
                                                                <section class="product-colors-item" style="background-color: {{ $color->color_code }}"></section>
                                                            @endforeach
                                                        </section>
                                                    </a>
                                                </section>
                                            </section>
                                        </section>
                                    @endforeach
                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
        <!-- end product lazy load -->
    </main>
    <!-- end main one col -->
@endsection

