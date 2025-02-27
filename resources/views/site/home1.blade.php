@extends('site.layouts.master')
@section('title', 'فروشگاه آمازون')

@section('content')

    <!-- start main one col -->
    <main id="main-body-one-col" class="main-body">
        <div class="container">
            @include('site.alerts.alert-section.info')
            @include('site.alerts.alert-section.success')
            @include('site.alerts.alert-section.danger')
            @include('site.alerts.alert-section.warning')
        </div>
        <!-- start slideshow -->
        <section class="container-xxl my-4">
            <section class="row">
                <section class="col-md-8 pe-md-1 ">
                    <section id="slideshow" class="owl-carousel owl-theme">
                        @foreach($slideShows as $slide)
                            <section class="item">
                                <a class="w-100 d-block h-auto text-decoration-none" href="{{ urldecode($slide->url) }}">
                                    <img class="w-100 rounded-2 d-block h-auto" src="{{ asset($slide->image) }}" alt="{{ $slide->title }}">
                                </a>
                            </section>
                        @endforeach
                    </section>
                </section>
                <section class="col-md-4 ps-md-1 mt-2 mt-md-0">
                    @foreach($topBanners as $banner)
                        <section class="mb-2">
                            <a href="{{ urldecode($banner->url) }}" class="d-block">
                                <img class="w-100 rounded-2" src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
                            </a>
                        </section>
                    @endforeach
                </section>
            </section>
        </section>
        <!-- end slideshow -->



        <!-- start product lazy load -->
        <section class="mb-3">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>جدیدترین کالاها</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <a href="{{ route('site.products', ['sort' => 1]) }}">مشاهده همه</a>
                                    </section>
                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper" >
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">
                                    @foreach($mostVisitedProducts as $product)
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



        <!-- start ads section -->
        <section class="mb-3">
            <section class="container-xxl">
                <!-- two column-->
                <section class="row py-4">
                    @foreach($middleBanners as $banner)
                        <section class="col-12 col-md-6 mt-2 mt-md-0">
                            <a href="{{ urldecode($banner->url) }}" class="d-block">
                                <img class="d-block rounded-2 w-100" src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
                            </a>
                        </section>
                    @endforeach
                </section>

            </section>
        </section>
        <!-- end ads section -->


        <!-- start product lazy load -->
        <section class="mb-3">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>پیشنهاد آمازون به شما</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <a href="{{ route('site.products', ['sort' => 6]) }}">مشاهده همه</a>
                                    </section>
                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper" >
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">
                                    @foreach($offerProducts as $product)
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
                                                            @if(!empty($product->getActiveAmazingCoupon()))
                                                                <section class="product-discount">
                                                                    <span class="product-old-price">{{ $product->getDiscountPriceFormated }} تومان</span>
                                                                    <span class="product-discount-amount">{{ convertEnglishNumToPersianNum($product->getActiveAmazingCoupon()->percentage) }}%</span>
                                                                </section>
                                                            @endif
                                                            <section class="product-price">{{ $product->getSalePriceFormated }} تومان</section>
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


        <!-- start ads section -->
        <section class="mb-3">
            <section class="container-xxl">
                <!-- one column -->
                <section class="row py-4">
                    @foreach($bottomBanners as $banner)
                        <section class="col">
                            <a href="{{ urldecode($banner->url) }}" class="d-block">
                                <img class="d-block rounded-2 w-100" src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
                            </a>
                        </section>
                    @endforeach
                </section>

            </section>
        </section>
        <!-- end ads section -->



        <!-- start brand part-->
        <section class="brand-part mb-4 py-4">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex align-items-center">
                                <h2 class="content-header-title">
                                    <span>برندهای ویژه</span>
                                </h2>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="brands-wrapper py-4" >
                            <section class="brands dark-owl-nav owl-carousel owl-theme">
                                @foreach($brands as $brand)
                                    <section class="item">
                                        <section class="brand-item">
                                            <a href="{{ route('site.products', [ 'brands[]' => $brand->id ]) }}">
                                                <img class="rounded-2" src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}">
                                            </a>
                                        </section>
                                    </section>
                                @endforeach
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
        <!-- end brand part-->

    </main>
    <!-- end main one col -->
@endsection

@section('site-scripts')
    <script>
        function addToFav(ele){
            $.ajax({
                url: ele.dataset.url,
                method: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function (response){
                    if(response.success) {
                        if(response.type === 0) {
                            ele.classList.add('text-danger');
                            ele.title = 'حذف از علاقه مندی';
                        }else if(response.type === 1){
                            ele.classList.remove('text-danger');
                            ele.title = 'افزودن به علاقه مندی';
                        }
                    }
                }
            });
        }
    </script>
@endsection
