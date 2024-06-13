@extends('admin.layouts.master')
@section('title', 'ادمین - محصولات')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'محصولات'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">محصولات</h3>
                            <a href="{{ route('admin.market.product.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus mr-1"></i>ایجاد محصول</a>

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
                                            <th class="text-sm">#</th>
                                            <th class="text-sm">تصویر کالا</th>
                                            <th class="text-sm">نام کالا</th>
                                            <th class="text-sm">قیمت کالا</th>
                                            <th class="text-sm">دسته بندی</th>
                                            <th class="text-sm">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>
                                                    <img src="{{ asset($product->image['index_array'][$product->image['current_image']]) }}" alt="" width="50px" >
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->price }} تومان</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>
                                                    <form action="{{ route('admin.market.product.destroy', $product->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-screwdriver-wrench"></i>
                                                                عملیات
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('admin.market.product.gallery.index', $product->id) }}">گالری</a>
                                                                <a class="dropdown-item" href="{{ route('admin.market.product.color.index', $product->id) }}">رنگبندی</a>
                                                                <a class="dropdown-item" href="{{ route('admin.market.product.guarantee.index', $product->id) }}">گارانتی</a>
                                                                <a class="dropdown-item" href="{{ route('admin.market.product.edit', $product->id) }}">ویرایش</a>
                                                                <div class="dropdown-divider"></div>
                                                                <button type="submit" class="dropdown-item">حذف</button>
                                                            </div>
                                                        </div>
                                                    </form>
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
