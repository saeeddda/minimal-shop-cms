@extends('admin.layouts.master')
@section('title', 'ادمین - ویرایش دسترسی های نقش')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'ویرایش دسترسی های نقش'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.user.role.permission-update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش دسترسی های نقش</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>عنوان نقش</label>
                                            <input type="text" class="form-control" disabled value="{{ old('name', $role->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>توضیحات نقش</label>
                                            <input type="text" class="form-control" disabled value="{{ old('description', $role->description) }}">
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex flex-row">

                                        @php
                                            $rolePermissionArray = $role->permissions->pluck('id')->toArray();
                                        @endphp

                                        @foreach($permissions as $permission)
                                            <div class="form-group w-25">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox"
                                                           id="permission_{{ $permission->id }}"
                                                           name="permissions[]"
                                                           value="{{ $permission->id }}"
                                                            @if(in_array( $permission->id, $rolePermissionArray)) checked @endif>
                                                    <label for="permission_{{ $permission->id }}"
                                                           class="custom-control-label">{{ $permission->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.user.role.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
