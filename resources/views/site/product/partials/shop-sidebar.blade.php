<aside id="sidebar" class="sidebar col-md-3">
    <form action="{{ route('site.products', request()->category ?? null) }}">
        <input type="hidden" name="sort" value="{{ request()->sort }}">
        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
            <!-- start sidebar nav-->
            <section class="sidebar-nav">
                @foreach($categories as $category)
                    <section class="sidebar-nav-item">
                        <span class="sidebar-nav-item-title">
                            <a class="d-inline" href="{{ route('site.products', $category->id) }}">{{ $category->name }} @if($category->children()->count() > 0)<i class="fa fa-angle-left"></i>@endif</a>
                        </span>
                        <section class="sidebar-nav-sub-wrapper">
                            @foreach($category->children()->get() as $child)
                                <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title">
                                        <a href="{{ route('site.products', $child->id) }}">{{ $child->name }}</a> @if($child->children()->count() > 0)<i class="fa fa-angle-left"></i>@endif
                                    </span>
                                    <section class="sidebar-nav-sub-sub-wrapper">
                                        @foreach($child->children()->get() as $sub_child)
                                            <section class="sidebar-nav-sub-sub-item"><a href="{{ route('site.products', $sub_child->id) }}">{{ $sub_child->name }}</a></section>
                                        @endforeach
                                    </section>
                                </section>
                            @endforeach
                        </section>
                    </section>
                @endforeach
            </section>
            <!--end sidebar nav-->
        </section>

        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
            <section class="content-header mb-3">
                <section class="d-flex justify-content-between align-items-center">
                    <h2 class="content-header-title content-header-title-small">
                        جستجو در نتایج
                    </h2>
                    <section class="content-header-link">
                        <!--<a href="#">مشاهده همه</a>-->
                    </section>
                </section>
            </section>

            <section class="">
                <input class="sidebar-input-text" type="text" name="search" value="{{ request()->search }}" placeholder="جستجو بر اساس نام، برند ...">
            </section>
        </section>

        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
            <section class="content-header mb-3">
                <section class="d-flex justify-content-between align-items-center">
                    <h2 class="content-header-title content-header-title-small">
                        برند
                    </h2>
                    <section class="content-header-link">
                        <!--<a href="#">مشاهده همه</a>-->
                    </section>
                </section>
            </section>

            <section class="sidebar-brand-wrapper">

                @foreach($brands as $brand)
                    <section class="form-check sidebar-brand-item">
                        <input class="form-check-input" type="checkbox" @checked(isset(request()->brands) && in_array($brand->id, request()->brands)) name="brands[]" value="{{ $brand->id }}" id="{{ $brand->id }}">
                        <label class="form-check-label d-flex justify-content-between" for="{{ $brand->id }}">
                            <span>{{ $brand->persian_name }}</span>
                            <span>{{ $brand->original_name }}</span>
                        </label>
                    </section>
                @endforeach
            </section>
        </section>

        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
            <section class="content-header mb-3">
                <section class="d-flex justify-content-between align-items-center">
                    <h2 class="content-header-title content-header-title-small">
                        محدوده قیمت
                    </h2>
                    <section class="content-header-link">
                        <!--<a href="#">مشاهده همه</a>-->
                    </section>
                </section>
            </section>
            <section class="sidebar-price-range d-flex justify-content-between">
                <section class="p-1"><input type="text" name="min_price" value="{{ request()->min_price }}" placeholder="قیمت از ..."></section>
                <section class="p-1"><input type="text" name="max_price" value="{{ request()->max_price }}" placeholder="قیمت تا ..."></section>
            </section>
        </section>

        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
            <section class="sidebar-filter-btn d-grid gap-2">
                <button class="btn btn-danger" type="submit">اعمال فیلتر</button>
            </section>
        </section>
    </form>
</aside>
