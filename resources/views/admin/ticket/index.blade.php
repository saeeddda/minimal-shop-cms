@extends('admin.layouts.master')
@section('title', 'ادمین - تیکت ها')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'تیکت ها'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">{{ $page_name }}</h3>
                            {{-- <a href="{{ route('admin.content.comment.create') }}" class="btn btn-success btn-sm" disabled ><i class="fa fa-plus mr-1"></i>Add comment</a> --}}

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
                                            <th>#</th>
                                            <th>نویسنده تیکت</th>
                                            <th>عنوان تیکت</th>
                                            <th>دسته تیکت</th>
                                            <th>اولویت تیکت</th>
                                            <th>ارجاع شده از</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                            <tr>
                                                <td>{{ $ticket->id }}</td>
                                                <td>{{ $ticket->user->fullName }}</td>
                                                <td>{{ $ticket->subject }}</td>
                                                <td>{{ $ticket->category->name }}</td>
                                                <td>{{ $ticket->priority->name }}</td>
                                                <td>{{ $ticket->admin->user->fullName }}</td>
                                                <td>
                                                    <form action="{{ route('admin.ticket.change', $ticket->id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-{{ $ticket->status == 1 ? 'danger' : 'success' }} btn-sm"><i class="fa fa-{{ $ticket->status == 1 ? 'times' : 'check' }} mr-1"></i>{{ $ticket->status == 1 ? 'بستن' : 'باز کردن' }}</button>
                                                        <a href="{{ route('admin.ticket.show', $ticket->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye mr-1"></i>نمایش</a>
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
