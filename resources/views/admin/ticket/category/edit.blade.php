@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش دسته تیکت ها')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش دسته تیکت ها'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.ticket.category.update', $ticketCategory->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش دسته تیکت</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>عنوان</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $ticketCategory->name) }}">
                                            @error('name')
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
                                                <option value="0" @if(old('status', $ticketCategory->status) == 0) selected @endif>غیرفعال</option>
                                                <option value="1" @if(old('status', $ticketCategory->status) == 1) selected @endif>فعال</option>
                                            </select>
                                            @error('status')
                                                <div class="text-danger pt-2">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.ticket.category.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
