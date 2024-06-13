@extends('site.layouts.master')
@section('title', 'تیکت ها')

@section('content')
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                @include('site.account.partials.sidebar-menu')
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>تیکت های من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->

                        <a href="{{ route('site.account.tickets.create') }}" class="btn btn-success">بازکردن تیکت</a>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان تیکت</th>
                                        <th>دسته تیکت</th>
                                        <th>اولویت تیکت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td>{{ $ticket->subject }}</td>
                                            <td>{{ $ticket->category->name }}</td>
                                            <td>{{ $ticket->priority->name }}</td>
                                            <td>
                                                <form action="{{ route('site.account.tickets.change', $ticket->id) }}" method="POST">
                                                    @csrf
                                                    <a href="{{ route('site.account.tickets.show', $ticket->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye mr-1"></i>نمایش</a>
                                                    <button class="btn btn-{{ $ticket->status == 1 ? 'danger' : 'success' }} btn-sm"><i class="fa fa-{{ $ticket->status == 1 ? 'times' : 'check' }} mr-1"></i>{{ $ticket->status == 1 ? 'بستن' : 'باز کردن' }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                تیکتی ندارید
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
                </main>
            </section>
        </section>
    </section>
@endsection
