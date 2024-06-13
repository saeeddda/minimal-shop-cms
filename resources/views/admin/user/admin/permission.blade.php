@extends('admin.layouts.master')
@section('title', 'ادمین - تعیین دسترسی ها')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'تعیین دسترسی ها'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.user.admin.permission-store', $user->id) }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">تعیین دسترسی ها</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>دسترسی ها</label>
                                            <select class="select2" id="permissions" name="permissions[]" multiple="multiple" style="width: 100%">
                                                @foreach($permissions as $permission)
                                                    <option value="{{ $permission->id }}"
                                                        @foreach($user->permissions as $user_permission)
                                                            @if($user_permission->id == $permission->id )
                                                                selected
                                                             @endif
                                                        @endforeach
                                                    >{{ $permission->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('permissions')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.user.admin.index') }}" class="btn btn-default"><i class="fa fa-chevron-left mr-1"></i>بازگشت</a>
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
            $('#permissions').select2({
                theme: 'bootstrap4',
                language: "fa",
                dir: "rtl",
                placeholder: 'دسترسی های خود را انتخاب کنید',
            });
        });
    </script>
@endsection
