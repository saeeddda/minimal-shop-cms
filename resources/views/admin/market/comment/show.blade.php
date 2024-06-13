@extends('admin.layouts.master')
@section('title', 'ادمین - نظر محصولات')

@section('content')
    @include('admin.layouts.breadcrumb', ['title' => 'نظر محصولات'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.market.comment.answer', $comment->id) }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">نظر</h3>
                            </div>
                            <div class="card-body">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">نظر از : {{ $comment->user->fullname }} - {{ $comment->user->id }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <h5 class="mb-2">نظر برای : {{ $comment->commentable->name }} - {{ $comment->commentable->id }}</h5>
                                            <p>{{ $comment->body }}</p>
                                        </div>
                                    </div>
                                </div>

                                <h6>پاسخ ها :</h6>

                                @if($answers)
                                    @foreach($answers as $answer)
                                        <div class="card">
                                            <div class="card-body">
                                                <p>{{ $answer->body }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div class="form-group">
                                    <label>نظر شما : </label>
                                    <textarea class="form-control" rows="5" placeholder="" name="body"></textarea>
                                  </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.market.comment.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
