@extends('admin.layouts.master')
@section('title', 'ادمین - تنظیمات سایت')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'تنظیمات سایت'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">تنظیمات سایت</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>عنوان سایت</td>
                                            <td>توضیحات سایت</td>
                                            <td>کلمات کلیدی</td>
                                            <td>لوگو</td>
                                            <td>آیکون</td>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $settings->title }}</td>
                                            <td>{{ $settings->description }}</td>
                                            <td>{{ $settings->keywords }}</td>
                                            <td>
                                                <img src="{{ asset($settings->logo) }}" alt="logo" width="40" height="40">
                                            </td>
                                            <td>
                                                <img src="{{ asset($settings->icon) }}" alt="icon" width="40" height="40"></td>
                                            <td>
                                                <a href="{{ route('admin.setting.edit', $settings->id ) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-1"></i>ویرایش</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
