@extends('admin.layouts.master')
@section('title', 'ادمین - تعیین نقش')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'تعیین نقش'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.user.admin.role-store', $user->id) }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">تعیین نقش</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>نقش ها</label>
                                            <select class="select2" id="roles" name="roles[]" multiple="multiple" style="width: 100%">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        @foreach($user->roles as $user_role)
                                                            @if($user_role->id == $role->id )
                                                                selected
                                                             @endif
                                                        @endforeach
                                                    >{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('roles')
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
            $('#roles').select2({
                theme: 'bootstrap4',
                language: "fa",
                dir: "rtl",
                placeholder: 'نقش های خود را انتخاب کنید',
            });
        });
    </script>
@endsection
