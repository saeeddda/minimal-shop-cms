@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش پست')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش پست'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.content.post.update', $post->id) }}" method="POST" id="form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش پست</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>عنوان پست</label>
                                            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
                                            @error('title')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>دسته بندی</label>
                                            <select name="category_id" class="form-control">
                                                @foreach ($postCategory as $category)
                                                    <option value="{{ $category->id }}" @if(old('category_id', $post->category_id) == $category->id) selected @endif>{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>وضعیت</label>
                                            <select class="form-control" name="status">
                                                <option value="0" @if(old('status', $post->status) == 0) selected @endif>غیرفعال</option>
                                                <option value="1" @if(old('status', $post->status) == 1) selected @endif>فعال</option>
                                            </select>
                                            @error('status')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>دریافت نظرات؟</label>
                                            <select class="form-control" name="commentable">
                                                <option value="1" @if(old('commentable', $post->commentable) == 1) selected @endif>فعال</option>
                                                <option value="0" @if(old('commentable', $post->commentable) == 0) selected @endif>غیرفعال</option>
                                            </select>
                                            @error('commentable')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>برجسب ها</label>
                                            <input type="hidden" class="form-control" id="tags" name="tags" value="{{ old('tags', $post->tags) }}">
                                            <select class="select2" id="tags_select_2" multiple="multiple" style="width: 100%"></select>
                                            @error('tags')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-6">
                                        <div class="form-group">
                                            <label>نویسنده</label>
                                            <select name="author_id" class="form-control">
                                                <option value="">عمومی</option>
                                                <option value="">خصوصی</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>تصویر پست</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                <label class="custom-file-label" for="image">انتخاب تصویر</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @php 
                                                $number = 1;
                                            @endphp

                                            @foreach ($post->image['index_array'] as $key => $value)
                                                <div class="col-{{ 6 / $number }}">
                                                    <input type="radio" name="current_image" id="size-{{ $key }}" value="{{ $key }}" @if($post->image['current_image'] == $key) checked @endif>
                                                    <label for="size-{{ $key }}">
                                                        <img src="{{ asset($value) }}" class="w-100">
                                                    </label>
                                                </div>
                                                @php
                                                    $number++;
                                                @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>تاریخ انتشار</label>
                                            <input type="text" id="published_view" class="form-control">
                                            <input type="hidden" id="published_at" name="published_at" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>خلاصه</label>
                                            <textarea name="summary" class="form-control" rows="5">{{ old('summary', $post->summary) }}</textarea>
                                            @error('summary')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>محتوا</label>
                                            <textarea name="body" class="form-control" id="body" rows="15">{{ old('body', $post->body) }}</textarea>
                                            @error('body')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.content.post.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('admin-styles')
    <link rel="stylesheet" href="{{ asset('admin-assets/css/persian-datepicker.css') }}">
@endsection

@section('admin-scripts')
    <script src="{{ asset('admin-assets/js/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('body',{
            language: 'fa',
            rtl: true,
        });
        jQuery(document).ready(function($){
            let tags_input = $('#tags');
            let tags_select_2 = $('#tags_select_2');
            let default_tags = tags_input.val();
            let default_data = null;

            if(tags_input !==null && tags_input.val().length > 0){
                default_data = default_tags.split(',');
            }

            tags_select_2.select2({
                theme: 'bootstrap4',
                language: "fa",
                dir: "rtl",
                placeholder: 'تک های خود را وارد کنید',
                tags: true,
                data: default_data
            });

            tags_select_2.children('option').attr('selected', true).trigger('change');

            $('#form').submit(function(event){
                if(tags_select_2.val() !==null && tags_select_2.val().length > 0){
                    let selected_tags = tags_select_2.val().join(',');
                    tags_input.val(selected_tags);
                }
            });

            $('#published_view').persianDatepicker({
                altField: '#published_at',
                format: 'YYYY/MM/DD HH:MM:ss',
                timePicker: {
                    enabled: true
                }
            });
        });
    </script>
@endsection