@extends('site.layouts.master')
@section('title', 'نمایش تیکت')

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
                                    <span>نمایش تیکت</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">تیکت</h3>
                            </div>
                            <div class="card-body">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $ticket->user->fullName }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <h4>{{ $ticket->subject }}</h4>
                                            <p>{{ $ticket->description }}</p>
                                        </div>
                                    </div>
                                </div>

                                <h6>پاسخ ها :</h6>

                                @foreach($answers as $answer)
                                    <div class="card my-1">
                                        <div class="card-body">
                                            <p>{{ $answer->description }}</p>
                                        </div>
                                    </div>
                                @endforeach

                                <form action="{{ route('site.account.tickets.answer', $ticket->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>پاسخ شما : </label>
                                        <textarea class="form-control" rows="5" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                        <div class="text-danger pt-2">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane mr-1"></i>ارسال پاسخ</button>
                                </form>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('site.account.tickets.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                            </div>
                        </div>
                    </section>
                </main>
            </section>
        </section>
    </section>
@endsection
