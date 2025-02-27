@extends('site.layouts.master')
@section('title', 'محصولات - فروشگاه آمازون')

@section('content')
    <!-- start main one col -->
    <main id="main-body-one-col" class="main-body">

        <div class="container">
            @include('site.alerts.alert-section.info')
            @include('site.alerts.alert-section.success')
            @include('site.alerts.alert-section.danger')
            @include('site.alerts.alert-section.warning')
        </div>

        <section class="">
            <section id="main-body-two-col" class="container-xxl body-container">
                <section class="row">
                    @include('site.product.partials.shop-sidebar', [ 'categories' => $categories ])

                    <main id="main-body" class="main-body col-md-9">
                        <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                            <section class="filters mb-3">
                                @if(request()->search)) <span class="d-inline-block border p-1 rounded bg-light">نتیجه جستجو برای : <span class="badge bg-info text-dark">"{{ request()->search }}"</span></span> @endif
                                @if(request()->brand_id)) <span class="d-inline-block border p-1 rounded bg-light">برند : <span class="badge bg-info text-dark">"{{ implode(', ', $selectedBrands) }}"</span></span> @endif
                                @if(request()->category)) <span class="d-inline-block border p-1 rounded bg-light">دسته : <span class="badge bg-info text-dark">"کتاب"</span></span> @endif
                                @if(request()->min_price)) <span class="d-inline-block border p-1 rounded bg-light">قیمت از : <span class="badge bg-info text-dark">{{ priceFormat(request()->min_price) }} تومان</span></span> @endif
                                @if(request()->max_price)) <span class="d-inline-block border p-1 rounded bg-light">قیمت تا : <span class="badge bg-info text-dark">{{ priceFormat(request()->max_price) }} تومان</span></span> @endif

                            </section>
                            <section class="sort ">
                                <span>مرتب سازی بر اساس : </span>
                                <a href="{{ route('site.products', [ 'search' => request()->search, 'sort' => '1', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brand_id ]) }}" class="btn @if(request()->sort == 1) btn-info @else btn-light @endif btn-sm px-1 py-0" type="button">جدیدترین</a>
{{--                                <a href="{{ route('site.products', [ 'search' => request()->search, 'sort' => '2', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brand_id ]) }}" class="btn @if(request()->sort == 2) btn-info @else btn-light @endif btn-sm px-1 py-0" type="button">محبوب ترین</a>--}}
                                <a href="{{ route('site.products', [ 'search' => request()->search, 'sort' => '3', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brand_id ]) }}" class="btn @if(request()->sort == 3) btn-info @else btn-light @endif btn-sm px-1 py-0" type="button">گران ترین</a>
                                <a href="{{ route('site.products', [ 'search' => request()->search, 'sort' => '4', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brand_id ]) }}" class="btn @if(request()->sort == 4) btn-info @else btn-light @endif btn-sm px-1 py-0" type="button">ارزان ترین</a>
{{--                                <a href="{{ route('site.products', [ 'search' => request()->search, 'sort' => '5', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brand_id ]) }}" class="btn @if(request()->sort == 5) btn-info @else btn-light @endif btn-sm px-1 py-0" type="button">پربازدیدترین</a>--}}
                                <a href="{{ route('site.products', [ 'search' => request()->search, 'sort' => '6', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brand_id ]) }}" class="btn @if(request()->sort == 6) btn-info @else btn-light @endif btn-sm px-1 py-0" type="button">پرفروش ترین</a>
                            </section>


                            <section class="main-product-wrapper row my-4" >
                                @forelse($products as $product)
                                    <section class="col-md-3 p-0">
                                        <section class="product">
                                            <section class="product-add-to-cart"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section>
                                            <section class="product-add-to-favorite"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی"><i class="fa fa-heart"></i></a></section>
                                            <a class="product-link" href="{{ route('site.product.single', $product->slug) }}">
                                                <section class="product-image">
                                                    <img class="" src="{{ asset($product->image['index_array']['medium']) }}" alt="{{ $product->name }}">
                                                </section>
                                                <section class="product-colors">
                                                    @foreach($product->colors as $color)
                                                        <section class="product-colors-item" style="background-color: {{ $color->color_code }}"></section>
                                                    @endforeach
                                                </section>
                                                <section class="product-name">
                                                    <h3>{{ $product->name }}</h3>
                                                </section>
                                                <section class="product-price-wrapper">
                                                    <section class="product-price">{{ $product->getSalePriceFormated }} تومان</section>
                                                </section>
                                            </a>
                                        </section>
                                    </section>
                                @empty
                                    <p>موردی یافت نشد</p>
                                @endforelse

                                <section class="col-12">

                                    <section class="my-4 d-flex justify-content-center">
                                        <nav>
                                            {{ $products->links('pagination::bootstrap-5') }}
                                        </nav>
                                    </section>
                                </section>

                            </section>


                        </section>
                    </main>
                </section>
            </section>
        </section>
    </main>
    <!-- end main one col -->
@endsection
