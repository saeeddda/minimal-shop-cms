@extends('admin.layouts.master')
@section('title', 'ادمین - تیکت')

@section('content')
    @include('admin.layouts.breadcrumb', ['title' => 'تیکت'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
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
                                <div class="card">
                                    <div class="card-body">
                                        <p>{{ $answer->description }}</p>
                                    </div>
                                </div>
                            @endforeach

                            <form action="{{ route('admin.ticket.answer', $ticket->id) }}" method="POST">
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
                            <a href="{{ route('admin.ticket.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
