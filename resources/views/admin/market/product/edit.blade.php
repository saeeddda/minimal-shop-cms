@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش محصول')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش محصول'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.market.product.update', $product->id) }}" method="POST" id="form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش محصول</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>عنوان محصول</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
                                            @error('name')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>دسته بندی</label>
                                            <select class="form-control" name="category_id">
                                                <option value="">انتخاب نشده</option>
                                                @foreach($productCategories as $category)
                                                    <option value="{{ $category->id }}" @if(old('category_id', $product->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
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
                                            <label>برند محصول</label>
                                            <select class="form-control" name="brand_id">
                                                <option value="">انتخاب نشده</option>
                                                @foreach($productBrands as $brand)
                                                    <option value="{{ $brand->id }}" @if(old('brand_id', $product->brand_id) == $brand->id) selected @endif>{{ $brand->persian_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>تصویر محصول</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                <label class="custom-file-label" for="image">انتخاب تصویر</label>
                                            </div>
                                            @error('image')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            @php
                                                $number = 1;
                                            @endphp

                                            @foreach ($product->image['index_array'] as $key => $value)
                                                <div class="col-{{ 6 / $number }}">
                                                    <input type="radio" name="current_image" id="size-{{ $key }}" value="{{ $key }}" @if($product->image['current_image'] == $key) checked @endif>
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
                                            <label>قیمت محصول</label>
                                            <input type="text" class="form-control" name="price" value="{{ old('price', $product->price) }}">
                                            @error('price')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>تاریخ انتشار</label>
                                            <input type="text" id="published_view" class="form-control" value="{{ jalaliDate($product->published_at) }}">
                                            <input type="hidden" id="published_at" name="published_at" class="form-control" value="{{ $product->published_at }}">
                                            @error('published_at')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>وزن</label>
                                            <input type="text" class="form-control" name="weight" value="{{ old('weight', $product->weight) }}">
                                            @error('weight')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>ارتفاع</label>
                                            <input type="text" class="form-control" name="height" value="{{ old('height',$product->height) }}">
                                            @error('height')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>عرض</label>
                                            <input type="text" class="form-control" name="width" value="{{ old('width', $product->width) }}">
                                            @error('width')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>طول</label>
                                            <input type="text" class="form-control" name="length" value="{{ old('length', $product->length) }}">
                                            @error('length')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>برجسب ها</label>
                                            <input type="hidden" class="form-control" id="tags" name="tags" value="{{ old('tags', $product->tags) }}">
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
                                                <option value="0" @if(old('status', $product->status) == 0) selected @endif>غیرفعال</option>
                                                <option value="1" @if(old('status', $product->status) == 1) selected @endif>فعال</option>
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
                                            <label>وضعیت فروش</label>
                                            <select class="form-control" name="marketable">
                                                <option value="0" @if(old('marketable', $product->marketable) == 0) selected @endif>غیرفعال</option>
                                                <option value="1" @if(old('marketable', $product->marketable) == 1) selected @endif>فعال</option>
                                            </select>
                                            @error('marketable')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>توضیحات محصول</label>
                                            <textarea name="introduction" class="form-control" id="introduction" rows="10">{{ old('introduction', $product->introduction) }}</textarea>
                                            @error('introduction')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 py-2 border-top">
                                        @foreach($product->meta as $meta)
                                            <div class="product_meta">
                                                <div class="row" >
                                                    <div class="col-5">
                                                        <div class="form-group">
                                                            <input type="text" name="meta_key[]" class="form-control" placeholder="ویژگی ..." value="{{ $meta->meta_key }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="form-group">
                                                            <input type="text" name="meta_value[]" class="form-control" placeholder="مقدار ..." value="{{ $meta->meta_value }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" id="removeMeta" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <button type="button" id="insertMeta" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.market.product.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
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

        CKEDITOR.replace('introduction',{
            language: 'fa',
            rtl: true,
        });

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

            $('#published_view').persianDatepicker({
                altField: '#published_at',
                format: 'YYYY/MM/DD HH:MM:ss',
                timePicker: {
                    enabled: true
                }
            });

            $('#insertMeta').on('click',function(){
                let element = $(this).prev().clone(true);
                $(this).before(element);
            });

            $('#removeMeta').on('click',function(){
                let ele = $('.product_meta').length;
                if(ele > 1) {
                    $(this).parent().parent().remove();
                }
            });
        });
    </script>
@endsection
