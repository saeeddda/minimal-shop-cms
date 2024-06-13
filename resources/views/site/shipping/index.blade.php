@extends('site.layouts.master')
@section('title','اطلاعات ارسال - فروشگاه آمازون')

@section('content')
    <main id="main-body-one-col" class="main-body">
        <div class="container">
            @include('site.alerts.alert-section.info')
            @include('site.alerts.alert-section.success')
            @include('site.alerts.alert-section.danger')
            @include('site.alerts.alert-section.warning')
        </div>
        <section class="mb-4">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>تکمیل اطلاعات ارسال کالا (آدرس گیرنده، مشخصات گیرنده، نحوه ارسال) </span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>

                        <section class="row mt-4">
                            <section class="col-md-9">
                                <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                    <!-- start vontent header -->
                                    <section class="content-header mb-3">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h2 class="content-header-title content-header-title-small">
                                                انتخاب آدرس و مشخصات گیرنده
                                            </h2>
                                            <section class="content-header-link">
                                                <!--<a href="#">مشاهده همه</a>-->
                                            </section>
                                        </section>
                                    </section>

                                    <section class="address-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                        <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                        <secrion>
                                            پس از ایجاد آدرس، آدرس را انتخاب کنید.
                                        </secrion>
                                    </section>

                                    <section class="address-select">
                                        <section id="address_holder">
                                            @foreach($addresses as $address)
                                                <input form="send_to_payment_form" type="radio" name="address_id" value="{{ $address->id }}" id="a{{ $address->id }}"/>
                                                <label for="a{{ $address->id }}" class="address-wrapper mb-2 p-2">
                                                    <section class="mb-2">
                                                        <i class="fa fa-map-marker-alt mx-1"></i>
                                                        {{ $address->address }}
                                                    </section>
                                                    <section class="mb-2">
                                                        <i class="fa fa-user-tag mx-1"></i>
                                                        گیرنده : {{ $address->getRecipientFullName }}
                                                    </section>
                                                    <section class="mb-2">
                                                        <i class="fa fa-mobile-alt mx-1"></i>
                                                        موبایل گیرنده : {{ $address->mobile }}
                                                    </section>
                                                    <a class="" href="#"><i class="fa fa-edit"></i> ویرایش آدرس</a>
                                                    <span class="address-selected">کالاها به این آدرس ارسال می شوند</span>
                                                </label>
                                            @endforeach
                                        </section>

                                        <div class="address-add-wrapper">
                                            <button class="address-add-button" type="button" data-bs-toggle="modal" data-bs-target="#add_address_modal" ><i class="fa fa-plus"></i> ایجاد آدرس جدید</button>
                                            <!-- start add address Modal -->
                                            <div class="modal fade" id="add_address_modal" tabindex="-1" aria-labelledby="add-address-label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form  action="{{ route('site.sale.shipping.add-address') }}" method="post" id="address_form">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="add-address-label"><i class="fa fa-plus"></i> ایجاد آدرس جدید</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-6 mb-2">
                                                                        <label for="province_i" class="form-label mb-1">استان</label>
                                                                        <select class="form-select form-select-sm" id="province_i">
                                                                            <option value="" selected>استان را انتخاب کنید</option>
                                                                            @foreach($provinces as $province)
                                                                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-6 mb-2">
                                                                        <label for="city_i" class="form-label mb-1">شهر</label>
                                                                        <select class="form-select form-select-sm" name="city_id" id="city_i">
                                                                            <option value="" selected>استان را انتخاب کنید</option>
                                                                            @foreach($cities as $city)
                                                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <div class="error-holder" id="city"></div>
                                                                    </div>
                                                                    <div class="col-12 mb-2">
                                                                        <label for="address_i" class="form-label mb-1">نشانی</label>
                                                                        <input name="address" type="text" class="form-control form-control-sm" id="address_i" placeholder="نشانی">
                                                                        <div class="error-holder" id="address"></div>
                                                                    </div>

                                                                    <div class="col-6 mb-2">
                                                                        <label for="postalcode_i" class="form-label mb-1">کد پستی</label>
                                                                        <input name="postalcode" type="text" class="form-control form-control-sm" id="postalcode_i" placeholder="کد پستی">
                                                                        <div class="error-holder" id="postalcode"></div>
                                                                    </div>

                                                                    <div class="col-3 mb-2">
                                                                        <label for="number_i" class="form-label mb-1">پلاک</label>
                                                                        <input name="number" type="text" class="form-control form-control-sm" id="number_i" placeholder="پلاک">
                                                                        <div class="error-holder" id="number"></div>
                                                                    </div>

                                                                    <div class="col-3 mb-2">
                                                                        <label for="unit_i" class="form-label mb-1">واحد</label>
                                                                        <input name="unit" type="text" class="form-control form-control-sm" id="unit_i" placeholder="واحد">
                                                                        <div class="error-holder" id="unit"></div>
                                                                    </div>

                                                                    <div class="border-bottom mt-2 mb-3"></div>

                                                                    <div class="col-6 mb-2">
                                                                        <label for="recipient_first_name_i" class="form-label mb-1">نام گیرنده</label>
                                                                        <input name="recipient_first_name" type="text" class="form-control form-control-sm" id="recipient_first_name_i" placeholder="نام گیرنده">
                                                                        <div class="error-holder" id="recipient_first_name"></div>
                                                                    </div>

                                                                    <div class="col-6 mb-2">
                                                                        <label for="recipinet_last_name_i" class="form-label mb-1">نام خانوادگی گیرنده</label>
                                                                        <input name="recipinet_last_name" type="text" class="form-control form-control-sm" id="recipinet_last_name_i" placeholder="نام خانوادگی گیرنده">
                                                                        <div class="error-holder" id="recipinet_last_name"></div>
                                                                    </div>

                                                                    <div class="col-6 mb-2">
                                                                        <label for="mobile_i" class="form-label mb-1">شماره موبایل</label>
                                                                        <input name="mobile" type="text" class="form-control form-control-sm" id="mobile_i" placeholder="شماره موبایل">
                                                                        <div class="error-holder" id="mobile"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer py-1">
                                                                <button type="submit" class="btn btn-sm btn-primary">ثبت آدرس</button>
                                                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- end add address Modal -->
                                        </div>

                                    </section>
                                </section>


                                <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                    <!-- start vontent header -->
                                    <section class="content-header mb-3">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h2 class="content-header-title content-header-title-small">
                                                انتخاب نحوه ارسال
                                            </h2>
                                            <section class="content-header-link">
                                                <!--<a href="#">مشاهده همه</a>-->
                                            </section>
                                        </section>
                                    </section>
                                    <section class="delivery-select ">

                                        <section class="address-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                            <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                            <secrion>
                                                نحوه ارسال کالا را انتخاب کنید. هنگام انتخاب لطفا مدت زمان ارسال را در نظر بگیرید.
                                            </secrion>
                                        </section>

                                        @foreach($deliveries as $delivery)
                                            <input form="send_to_payment_form" type="radio" name="delivery_id" value="{{ $delivery->id }}" id="d{{ $delivery->id }}"/>
                                            <label for="d{{ $delivery->id }}" class="col-12 col-md-4 delivery-wrapper mb-2 pt-2">
                                                <section class="mb-2">
                                                    <i class="fa fa-shipping-fast mx-1"></i>
                                                    {{ $delivery->name }}
                                                </section>
                                                <section class="mb-2">
                                                    <i class="fa fa-money-bill-wave mx-1"></i>
                                                    {{ priceFormat($delivery->amount) }} تومان
                                                </section>
                                                <section class="mb-2">
                                                    <i class="fa fa-calendar-alt mx-1"></i>
                                                    تامین کالا از {{ $delivery->deliveryTimeWithUnit }} کاری آینده
                                                </section>
                                            </label>
                                        @endforeach
                                    </section>
                                </section>
                            </section>
                            @php
                                $totalCartPrice = 0;
                                $totalCartDiscountPrice = 0;
                            @endphp
                            @foreach($cartItems as $item)
                                @php
                                    $totalCartPrice += $item->cartItemTotalPrice();
                                    $totalCartDiscountPrice += $item->cartItemTotalDiscount();
                                @endphp
                            @endforeach
                            <section class="col-md-3">
                                <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قیمت کالاها ({{ $cartItems->count() }})</p>
                                        <p class="text-muted">{{ priceFormat($totalCartPrice) }} تومان</p>
                                    </section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف کالاها</p>
                                        <p class="text-danger fw-bolder">{{ priceFormat($totalCartDiscountPrice) }} تومان</p>
                                    </section>

                                    <section class="border-bottom mb-3"></section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">جمع سبد خرید</p>
                                        <p class="fw-bolder" id="final_cart_price" data-url="{{ $totalCartPrice - $totalCartDiscountPrice }}">{{ priceFormat($totalCartPrice - $totalCartDiscountPrice) }} تومان</p>
                                    </section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">هزینه ارسال</p>
                                        <p class="text-warning" id="delivery_amount">54,000 تومان</p>
                                    </section>

                                    <p class="my-3">
                                        <i class="fa fa-info-circle me-1"></i> کاربر گرامی کالاها بر اساس نوع ارسالی که انتخاب می کنید در مدت زمان ذکر شده ارسال می شود.
                                    </p>

                                    <section class="border-bottom mb-3"></section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">مبلغ قابل پرداخت</p>
                                        <p class="fw-bold" id="final_payment">374,000 تومان</p>
                                    </section>

                                    <section class="">
                                        <section id="address-button" class="text-warning border border-warning text-center py-2 pointer rounded-2 d-block">آدرس و نحوه ارسال را انتخاب کن</section>
                                        <button id="next-level" onclick="document.getElementById('send_to_payment_form').submit();"  class="btn btn-danger d-none w-100">ادامه فرآیند خرید</button>
                                    </section>

                                    <form action="{{ route('site.sale.shipping.set-address-and-delivery') }}"  id="send_to_payment_form" method="post">@csrf</form>

                                </section>
                            </section>
                        </section>
                    </section>
                </section>

            </section>
        </section>
    </main>
@endsection

@section('site-scripts')
    <script>
        $('#address_form').submit(function (e){
            e.preventDefault();
            let form = $('#address_form');

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function (response){
                    if(response.success){
                        if(response.data !== null){
                            let input = document.createElement('input');
                            input.setAttribute('type', 'radio');
                            input.setAttribute('name', 'address');
                            input.setAttribute('id', 'a' + response.data.id);
                            input.setAttribute('value', + response.data.id);

                            let label = document.createElement('label');
                            label.setAttribute('for','a' + response.data.id);
                            label.classList.add('address-wrapper');
                            label.classList.add('mb-2');
                            label.classList.add('p2');

                            let address_section = document.createElement('section');
                            address_section.classList.add('mb-2');
                            address_section.innerHTML = '<i class="fa fa-map-marker-alt mx-1"></i>' + response.data.address;

                            let recipient_section = document.createElement('section');
                            recipient_section.classList.add('mb-2');
                            recipient_section.innerHTML = '<i class="fa fa-user-tag mx-1"></i> گیرنده : ' + response.data.recipient_first_name + response.data.recipinet_last_name;

                            let mobile_section = document.createElement('section');
                            mobile_section.classList.add('mb-2');
                            mobile_section.innerHTML = '<i class="fa fa-mobile-alt mx-1"></i> موبایل گیرنده : ' + response.data.mobile;

                            let edit_a = document.createElement('a');
                            edit_a.setAttribute('href', '#');
                            edit_a.innerHTML = '<i class="fa fa-edit"></i> ویرایش آدرس';

                            let notice_span = document.createElement('span');
                            notice_span.classList.add('address-selected');
                            notice_span.innerHTML = 'کالاها به این آدرس ارسال می شوند';

                            label.appendChild(address_section);
                            label.appendChild(recipient_section);
                            label.appendChild(mobile_section);
                            label.appendChild(edit_a);
                            label.appendChild(notice_span);

                            let address_holder = document.getElementById('address_holder');
                            address_holder.appendChild(input);
                            address_holder.appendChild(label);

                            hide_modal();
                        }

                        if( typeof response.errors !== 'undefined'){
                            let city = $('#city');
                            let address = $('#address');
                            let postalcode = $('#postalcode');
                            let number = $('#number');
                            let unit = $('#unit');
                            let recipient_first_name = $('#recipient_first_name');
                            let recipinet_last_name = $('#recipinet_last_name');
                            let mobile = $('#mobile');

                            if(response.errors.city_id !== null){
                                city.innerHTML = response.errors.city_id;
                            }

                            if(response.errors.address !== null){
                                address.innerHTML = response.errors.address;
                            }

                            if(response.errors.postalcode !== null){
                                postalcode.innerHTML = response.errors.postalcode;
                            }

                            if(response.errors.number !== null){
                                number.innerHTML = response.errors.number;
                            }

                            if(response.errors.unit !== null){
                                unit.innerHTML = response.errors.unit;
                            }

                            if(response.errors.recipient_first_name !== null){
                                recipient_first_name.innerHTML = response.errors.recipient_first_name;
                            }

                            if(response.errors.recipinet_last_name !== null){
                                recipinet_last_name.innerHTML = response.errors.recipinet_last_name;
                            }

                            if(response.errors.mobile !== null){
                                mobile.innerHTML = response.errors.mobile;
                            }
                        }

                        hide_modal();
                    }
                }
            });
        });

        function hide_modal(){
            $('.modal-backdrop').remove();
            $('#add_address_modal').modal('hide');
        }

        $('input[name=delivery_type] option:selected');
    </script>
@endsection
