@extends('admin.layouts.master')
@section('title', 'ادمین - پاسخگویان تیکت ها')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'پاسخگویان تیکت ها'])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('admin.alerts.alert-section.success')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">پاسخگویان تیکت ها</h3>

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
                                            <th>نام پاسخگو</th>
                                            <th>ایمیل پاسخگو</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->fullName }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>
                                                <a href="{{ route('admin.ticket.admin.set', $admin->id ) }}" class="btn btn-{{ $admin->ticketAdmin == null ? 'success' : 'danger' }} btn-sm">
                                                    <i class="fa fa-{{ $admin->ticketAdmin == null ? 'check' : 'times' }} mr-1"></i>
                                                    {{ $admin->ticketAdmin == null ? 'افزودن' : 'حذف' }}
                                                </a>
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
