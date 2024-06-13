@extends('site.layouts.master')
@section('title', $page->title)

@section('content')

    <!-- start main one col -->
    <main id="main-body-one-col" class="main-body">
        <div class="container">
            @include('site.alerts.alert-section.info')
            @include('site.alerts.alert-section.success')
            @include('site.alerts.alert-section.danger')
            @include('site.alerts.alert-section.warning')
        </div>

        {!! $page->body !!}
    </main>
    <!-- end main one col -->
@endsection
