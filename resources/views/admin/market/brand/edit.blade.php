@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش برند محصولات')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'برند محصولات'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.market.brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش برند</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>نام فارسی</label>
                                            <input type="text" class="form-control" name="persian_name" value="{{ old('persian_name', $brand->persian_name) }}">
                                            @error('persian_name')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>نام اصلی</label>
                                            <input type="text" class="form-control" name="original_name" value="{{ old('original_name', $brand->original_name) }}">
                                            @error('original_name')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>برجسب ها</label>
                                            <input type="hidden" class="form-control" id="tags" name="tags" value="{{ old('tags', $brand->tags) }}">
                                            <select class="select2" id="tags_select_2" multiple="multiple" style="width: 100%"></select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>وضعیت</label>
                                            <select class="form-control" name="status">
                                                <option value="0" @if(old('status', $brand->status) == 0) selected @endif>غیرفعال</option>
                                                <option value="1" @if(old('status', $brand->status) == 1) selected @endif>فعال</option>
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
                                            <label>تصویر</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="logo" name="logo">
                                                <label class="custom-file-label" for="logo">انتخاب تصویر</label>
                                            </div>
                                            @error('image')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.market.brand.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
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
    <script>
        jQuery(document).ready(function($){
            let tags_input = $('#tags');
            let tags_select_2 = $('#tags_select_2');
            let default_tags = tags_input.val();
            let default_data = null;

            if(tags_input !== null && tags_input.val().length > 0){
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
