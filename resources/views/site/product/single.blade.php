@extends('site.layouts.master')
@section('title', $product->name . ' - فروشگاه آمازون')

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
                                    <span>{{ $product->name }}</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>

                        <form action="{{ route('site.sale.add-to-cart', $product->id) }}" method="post">
                            @csrf
                            <section class="row mt-4">
                                <!-- start image gallery -->
                                <section class="col-md-4">
                                    <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                        <section class="product-gallery">
                                            <section class="product-gallery-selected-image mb-3">
                                                <img src="{{ asset($product->image['index_array']['medium']) }}" alt="{{ $product->name }}">
                                            </section>

                                            <section class="product-gallery-thumbs">
                                                <img class="product-gallery-thumb"
                                                     src="{{ asset($product->image['index_array']['medium']) }}"
                                                     alt="{{ $product->name }}"
                                                     data-input="{{ asset($product->image['index_array']['medium']) }}">
                                                @foreach($product->galleries as $image)
                                                    <img class="product-gallery-thumb"
                                                         src="{{ asset($image->image['index_array']['small']) }}"
                                                         alt="{{ $product->name }}"
                                                         data-input="{{ asset($image->image['index_array']['medium']) }}">
                                                @endforeach
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                <!-- end image gallery -->

                                <!-- start product info -->
                                <section class="col-md-5">

                                    <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                        <!-- start vontent header -->
                                        <section class="content-header mb-3">
                                            <section class="d-flex justify-content-between align-items-center">
                                                <h2 class="content-header-title content-header-title-small">{{ $product->name }}</h2>
                                            </section>
                                        </section>
                                        <section class="product-info">
                                            @if($product->colors()->count() > 0)
                                                <p>
                                                    <span id="color_name">رنگ انتخاب شده : {{ $product->colors()->first()->color_name }}</span>
                                                </p>
                                                <p>
                                                    @foreach($product->colors as $key => $color)
                                                        <span class="color_holder">
                                                            <label for="color_{{ $color->id }}" style="background-color: {{ $color->color_code }};" class="product-info-colors me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $color->color_name }}"></label>
                                                            <input type="radio" class="d-none" name="color"
                                                                   id="color_{{ $color->id }}" value="{{ $color->id }}"
                                                                   data-color-name="{{ $color->color_name }}"
                                                                   data-color-price="{{ $color->price_increase }}"
                                                                    @if($key == 0) checked @endif/>
                                                        </span>
                                                    @endforeach
                                                </p>
                                            @endif

                                            <p>
                                                <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i> گارانتی :
                                                <label for="guarantee">گارانتی : </label>
                                                <select name="guarantee" id="guarantee" class="form-select">
                                                    @foreach($product->guarantees as $key => $guarantee)
                                                        <option value="{{ $guarantee->id }}"
                                                                data-guarantee-price="{{ $guarantee->price_increase }}"
                                                                @if($key == 0) selected @endif
                                                        >{{ $guarantee->name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            <p>
                                                <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                                <span>{{ $product->marketable ? 'موجود در انبار' : 'ناموجود در انبار' }}</span>
                                            </p>

                                            <p>
                                                @auth
                                                    <button type="button"
                                                            class="btn btn-light  btn-sm text-decoration-none"
                                                            onclick="addToFav(this)"
                                                            data-url="{{ route('site.product.add-to-favorite', $product->id) }}">
                                                        <i class="fa fa-heart @if($product->user->contains(auth()->user()->id)) text-danger @endif"></i>
                                                        @if($product->user->contains(auth()->user()->id))
                                                            حذف از علاقه مندی
                                                        @else
                                                            افزودن به علاقه مندی
                                                        @endif
                                                    </button>
                                                @endauth
                                            </p>
                                            <p>
                                                @auth
                                                    @php
                                                        $is_compared = $product->compares->contains(function ($compare, $key){
                                                            return $compare->id == auth()->user()->compare->id;
                                                        });
                                                    @endphp
                                                    <button type="button"
                                                            class="btn btn-light btn-sm text-decoration-none"
                                                            onclick="addToCompare(this)"
                                                            data-url="{{ route('site.product.add-to-compare', $product->id) }}">
                                                        <i class="fa fa-industry @if($is_compared) text-danger @endif"></i>
                                                        @if($is_compared)
                                                            حذف از مقایسه
                                                        @else
                                                            افزودن به مقایسه
                                                        @endif
                                                    </button>
                                                @endauth
                                            </p>
                                            <p>
                                                <a href="{{ route('site.product.rate', $product->slug) }}" class="btn btn-light btn-sm">امتیاز 5</a>
                                            </p>

                                            <section>
                                                <section class="cart-product-number d-inline-block ">
                                                    <button class="cart-number-down" type="button">-</button>
                                                    <input type="number" min="1" step="1" name="quantity" value="1" readonly="readonly">
                                                    <button class="cart-number-up" type="button">+</button>
                                                </section>
                                            </section>

                                            <p class="mb-3 mt-5">
                                                <i class="fa fa-info-circle me-1"></i>کاربر گرامی  خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش صورت میگیرد. پس از ثبت سفارش کالا بر اساس نحوه ارسال که شما انتخاب کرده اید کالا برای شما در مدت زمان مذکور ارسال می گردد.
                                            </p>
                                        </section>
                                    </section>

                                </section>
                                <!-- end product info -->

                                <section class="col-md-3">
                                    <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                        <div class="attribute-wrapper pb-3">
                                            <div class="attribute-select">
                                                <select class="form-select" name="attribute">
                                                    @foreach($product->categoryValues()->get() as $value)
                                                        <option value="{{ $value->id }}">{{ $value->attribute()->first()->name }} - {{ json_decode($value->value)->value }} {{ $value->attribute()->first()->unit }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        @if(!empty($product->getActiveAmazingCoupon()))
                                            <section class="d-flex justify-content-between align-items-center">
                                                <p class="text-muted">قیمت کالا</p>
                                                <p class="text-muted fs-5">
                                                    <del>
                                                        {{ $product->getPriceFormated }} <span class="small">تومان</span>
                                                    </del>
                                                </p>
                                            </section>

                                            <section class="d-flex justify-content-between align-items-center">
                                                <p class="text-muted">تخفیف کالا</p>
                                                <p class="text-danger fw-bolder fs-5" id="discount_product_price" data-discount-price="{{ $product->getDiscountPrice }}">{{ $product->getDiscountPriceFormated }} <span class="small">تومان</span></p>
                                            </section>
                                        @endif

                                        <input type="hidden" id="original_product_price" data-original-product-price="{{ $product->price }}" value="{{ $product->price }}">

                                        <section class="border-bottom mb-3"></section>

                                        <section class="d-flex justify-content-end align-items-center">
                                            <p class="fw-bolder fs-4" ><span id="final_product_price">{{ $product->getSalePriceFormated }}</span> <span class="small">تومان</span></p>
                                        </section>


                                        <section class="">
                                            @if($product->marketable_number > 0)
                                                <button type="submit" id="next-level" class="btn btn-danger d-block w-100">افزودن به سبد خرید</button>
                                            @else
                                                <span class="border-1 rounded-3 border-secondary p-2 text-center text-muted fs-5 w-100">نا موجود</span>
                                            @endif
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

        <!-- start description, features and comments -->
        <section class="mb-4">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start content header -->
                            <section id="introduction-features-comments" class="introduction-features-comments">
                                <section class="content-header">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title">
                                            <span class="me-2"><a class="text-decoration-none text-dark" href="#introduction">معرفی</a></span>
                                            <span class="me-2"><a class="text-decoration-none text-dark" href="#features">ویژگی ها</a></span>
                                            <span class="me-2"><a class="text-decoration-none text-dark" href="#comments">دیدگاه ها</a></span>
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <!-- start content header -->

                            <section class="py-4">

                                <!-- start vontent header -->
                                <section id="introduction" class="content-header mt-2 mb-4">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            معرفی
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="product-introduction mb-4">
                                    {!! $product->introduction !!}
                                </section>

                                <!-- start vontent header -->
                                <section id="features" class="content-header mt-2 mb-4">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            ویژگی ها
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="product-features mb-4 table-responsive">
                                    <table class="table table-bordered border-white">
                                        @foreach($product->meta as $meta)
                                            <tr>
                                                <td>{{ $meta->meta_key }}</td>
                                                <td>{{ $meta->meta_value }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </section>

                                <!-- start vontent header -->
                                <section id="comments" class="content-header mt-2 mb-4">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            دیدگاه ها
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="product-comments mb-4">

                                    <section class="comment-add-wrapper">
                                        <button class="comment-add-button" type="button" data-bs-toggle="modal" data-bs-target="#add-comment" ><i class="fa fa-plus"></i> افزودن دیدگاه</button>
                                        <!-- start add comment Modal -->
                                        <section class="modal fade" id="add-comment" tabindex="-1" aria-labelledby="add-comment-label" aria-hidden="true">
                                            <section class="modal-dialog">
                                                <section class="modal-content">
                                                    <form action="{{ route('site.product.add-comment', $product) }}" method="POST">
                                                        <section class="modal-header">
                                                            <h5 class="modal-title" id="add-comment-label"><i class="fa fa-plus"></i> افزودن دیدگاه</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </section>
                                                        <section class="modal-body">
                                                            @csrf
                                                            <div class="row">
                                                                <section class="col-12 mb-2">
                                                                    <label for="comment" class="form-label mb-1">دیدگاه شما</label>
                                                                    <textarea class="form-control form-control-sm" id="comment" placeholder="دیدگاه شما ..." rows="4" name="body"></textarea>
                                                                </section>
                                                            </div>
                                                        </section>
                                                        <section class="modal-footer py-1">
                                                            <button type="submit" class="btn btn-sm btn-primary">ثبت دیدگاه</button>
                                                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                                        </section>
                                                    </form>
                                                </section>
                                            </section>
                                        </section>
                                    </section>

                                    @foreach($product->activeComments() as $comment)
                                        <section class="product-comment">
                                            <section class="product-comment-header d-flex justify-content-start">
                                                <section class="product-comment-date">{{ jalaliDate($comment->created_at) }}</section>
                                                <section class="product-comment-title">{{ $comment->user->fullName ?? 'ناشناس' }}</section>
                                            </section>
                                            <section class="product-comment-body">{!! $comment->body !!}</section>
                                        </section>

                                        @foreach($comment->answers as $answers)
                                            <section class="product-comment @if($comment->answers()->count() > 0) ms-4 @endif">
                                                <section class="product-comment-header d-flex justify-content-start">
                                                    <section class="product-comment-date">{{ jalaliDate($answers->created_at) }}</section>
                                                    <section class="product-comment-title">{{ $answers->user->fullName ?? 'ناشناس' }}</section>
                                                </section>
                                                <section class="product-comment-body">{!! $answers->body !!}</section>
                                            </section>
                                        @endforeach
                                    @endforeach
                                </section>
                            </section>

                        </section>
                    </section>
                </section>
            </section>
        </section>
        <!-- end description, features and comments -->

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


@section('site-scripts')
    <script>
        $(document).ready(function (){
            bill();

            $('input[name=color]').change(function (){
                bill();
            });

            $('select[name=guarantee]').change(function (){
                bill();
            });
        });

        function bill(){
            let color_input = $('input[name=color]:checked');
            let guarantee_input = $('#guarantee option:selected');
            let discount_element = $('#discount_product_price');
            let product_price_element = $('#original_product_price');
            let final_product_price_element = $('#final_product_price');

            let selected_color_price = 0;
            let selected_guarantee_price = 0;
            let product_discount_price = 0;
            let product_original_price = parseFloat(product_price_element.attr('data-original-product-price'));
            let final_price = 0;

            if(color_input.length !== 0){
                $('#color_name').html('رنگ انتخاب شده : ' + color_input.attr('data-color-name'))

                selected_color_price = parseFloat(color_input.attr('data-color-price'));
            }

            if(guarantee_input.length !== 0){
                selected_guarantee_price = parseFloat(guarantee_input.attr('data-guarantee-price'));
            }

            if(discount_element.length !== 0){
                product_discount_price = parseFloat(discount_element.attr('data-discount-price'));

                final_price = (selected_color_price + selected_guarantee_price + product_original_price) - product_discount_price;
            }else{
                final_price = selected_color_price + selected_guarantee_price + product_original_price;
            }

            final_product_price_element.html(toFarsiNumber(final_price));
        }

        function toFarsiNumber(number){
            const farsiDigits = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
            number = new Intl.NumberFormat().format(number);
            return number.toString().replace(/\d/g, x=> farsiDigits[x]);
        }

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
                            ele.innerHTML = '<i class="fa fa-heart text-danger"></i> حذف از علاقه مندی';
                        }else if(response.type === 1){
                            ele.innerHTML = '<i class="fa fa-heart"></i> افزودن به علاقه مندی';
                        }
                    }
                }
            });
        }

        function addToCompare(ele){
            $.ajax({
                url: ele.dataset.url,
                method: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function (response){
                    if(response.success) {
                        if(response.type === 0) {
                            ele.innerHTML = '<i class="fa fa-industry text-danger"></i> حذف از مقایسه';
                        }else if(response.type === 1){
                            ele.innerHTML = '<i class="fa fa-industry"></i> افزودن به مقایسه';
                        }
                    }
                }
            });
        }

        // //start product introduction, features and comment
        $(document).ready(function() {
            var s = $("#introduction-features-comments");
            var pos = s.position();
            $(window).scroll(function() {
                var windowpos = $(window).scrollTop();

                if (windowpos >= pos.top) {
                    s.addClass("stick");
                } else {
                    s.removeClass("stick");
                }
            });
        });
        // //end product introduction, features and comment
    </script>
@endsection
