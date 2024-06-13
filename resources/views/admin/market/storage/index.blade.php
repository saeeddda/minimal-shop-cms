@extends('admin.layouts.master')
@section('title', 'ادمین - انبار')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'انبار'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">انبار</h3>

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
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-sm">کد کالا</th>
                                            <th class="text-sm">تصویر کالا</th>
                                            <th class="text-sm">نام کالا</th>
                                            <th class="text-sm">قابل فروش</th>
                                            <th class="text-sm">رزرو</th>
                                            <th class="text-sm">فروخته شده</th>
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
                                                <td>{{ $product->marketable_number }}</td>
                                                <td>{{ $product->frozen_number }}</td>
                                                <td>{{ $product->sold_number }}</td>
                                                <td>
                                                    <a href="{{ route('admin.market.storage.addToStorage', $product->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-1"></i>افزودن به موجودی</a>
                                                    <a href="{{ route('admin.market.storage.edit', $product->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-1"></i>ویرایش موجودی</a>
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
