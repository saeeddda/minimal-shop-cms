@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش صفحه')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش صفحه'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.content.page-builder.update', $page->id) }}" method="POST" id="form">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش صفحه</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>عنوان صفحه</label>
                                            <input type="text" class="form-control" name="title" value="{{ old('title', $page->title) }}">
                                            @error('title')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>لینک</label>
                                            <input type="text" class="form-control">
                                            @error('status')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>برجسب ها</label>
                                            <input type="hidden" class="form-control" id="tags" name="tags" value="{{ old('tags', $page->tags) }}">
                                            <select class="select2" id="tags_select_2" multiple="multiple" style="width: 100%"></select>
                                            @error('tags')
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
                                                <option value="0" @if(old('status', $page->status) == 0) selected @endif>غیرفعال</option>
                                                <option value="1" @if(old('status', $page->status) == 1) selected @endif>فعال</option>
                                            </select>
                                            @error('status')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>محتوا</label>
                                            <textarea name="body" id="body" rows="15" class="form-control">{{ old('body', $page->body) }}</textarea>
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
                                <a href="{{ route('admin.content.page-builder.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('admin-scripts')
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
        });
    </script>
@endsection