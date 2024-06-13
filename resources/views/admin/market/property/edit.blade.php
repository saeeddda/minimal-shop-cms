@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش فرم کالا')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش فرم کالا'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.market.property.update', $categoryAttribute->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش فرم کالا</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>عنوان</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $categoryAttribute->name) }}">
                                    @error('name')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>واحد اندازه گیری</label>
                                    <input type="text" class="form-control" name="unit" value="{{ old('unit', $categoryAttribute->unit) }}">
                                    @error('unit')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>دسته والد</label>
                                    <select class="form-control" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if(old('category_id', $categoryAttribute->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.market.property.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
