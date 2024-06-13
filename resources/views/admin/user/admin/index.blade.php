@extends('admin.layouts.master')
@section('title', 'ادمین - مدیران')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'مدیران'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">مدیران</h3>
                            <a href="{{ route('admin.user.admin.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus mr-1"></i>افزودن مدیر</a>

                            <div class="card-tools">
                                <form action="">
                                    <div class="input-group input-group-sm">
                                        <input type="search" name="search" class="form-control" placeholder="جستجو...">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>نام</th>
                                            <th>ایمیل / موبایل</th>
                                            <th>نقش ها</th>
                                            <th>سایر دسترسی ها</th>
                                            <th>وضعیت حساب</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($admins as $admin)
                                            <tr>
                                                <td>{{ $admin->fullName }}</td>
                                                <td>
                                                    <ul>
                                                        <li>{{ $admin->email }}</li>
                                                        <li>{{ $admin->mobile }}</li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @forelse($admin->roles as $role)
                                                            <li>{{ $role->name }}</li>
                                                        @empty
                                                            <li class="text-danger">نقشی ندارد</li>
                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @forelse($admin->permissions as $permission)
                                                            <li>{{ $permission->name }}</li>
                                                        @empty
                                                            <li class="text-danger">دسترسی ندارد</li>
                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input onchange="changeActivation({{ $admin->id }})" data-url="{{ route('admin.user.admin.activation', $admin->id ) }}" type="checkbox" class="custom-control-input" id="switch_a_{{ $admin->id }}" @if($admin->activation == 1) checked @endif>
                                                        <label class="custom-control-label" for="switch_a_{{ $admin->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input onchange="changeStatus({{ $admin->id }})" data-url="{{ route('admin.user.admin.status', $admin->id ) }}" type="checkbox" class="custom-control-input" id="switch_{{ $admin->id }}" @if($admin->status == 1) checked @endif>
                                                        <label class="custom-control-label" for="switch_{{ $admin->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.user.admin.destroy', $admin->id) }}" method="POST">
                                                        @csrf
                                                        <a title="تعیین دسترسی" href="{{ route('admin.user.admin.permission', $admin->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-user-lock mr-1"></i></a>
                                                        <a title="تعیین نقش" href="{{ route('admin.user.admin.role', $admin->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-user-shield mr-1"></i></a>
                                                        <a href="{{ route('admin.user.admin.edit', $admin->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-1"></i></a>
                                                        @method('DELETE')
                                                        <button type="submit" class="delete_button btn btn-danger btn-sm"><i class="fa fa-trash mr-1"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="card-tools">
                                <ul class="pagination pagination-sm float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('admin-scripts')
    <script>
        function changeStatus(id){
            let input_element = jQuery('#switch_' + id);
            let url = input_element.attr('data-url');
            let status = !input_element.prop('checked');

            jQuery.ajax({
                url: url,
                type: 'GET',
                success: function(response){
                    if(response.status === true){
                        if(response.checked === true){
                            input_element.prop('checked', true);
                            Swal.fire({
                                icon: 'success',
                                title: 'کاربر فعال شد',
                                confirmButtonText: 'تائید'
                            })
                        }else{
                            input_element.prop('checked', false);
                            Swal.fire({
                                icon: 'success',
                                title: 'کاربر غیرفعال شد',
                                confirmButtonText: 'تائید'
                            })
                        }
                    }else{
                        input_element.prop('checked', status);
                        Swal.fire({
                            icon: 'error',
                            title: 'مشکلی پیش آمده. مجدد تلاش کنید',
                            confirmButtonText: 'تائید'
                        })
                    }
                },
                error: function(){
                    input_element.prop('checked', status);
                    Swal.fire({
                        icon: 'error',
                        title: 'ارتباط برقرار نشد',
                        confirmButtonText: 'تائید'
                    })
                }
            });
        }

        function changeActivation(id){
            let input_element = jQuery('#switch_a_' + id);
            let url = input_element.attr('data-url');
            let status = !input_element.prop('checked');

            jQuery.ajax({
                url: url,
                type: 'GET',
                success: function(response){
                    if(response.status === true){
                        if(response.checked === true){
                            input_element.prop('checked', true);
                            Swal.fire({
                                icon: 'success',
                                title: 'حساب کاربر فعال شد',
                                confirmButtonText: 'تائید'
                            })
                        }else{
                            input_element.prop('checked', false);
                            Swal.fire({
                                icon: 'success',
                                title: 'حساب کاربر غیرفعال شد',
                                confirmButtonText: 'تائید'
                            })
                        }
                    }else{
                        input_element.prop('checked', status);
                        Swal.fire({
                            icon: 'error',
                            title: 'مشکلی پیش آمده. مجدد تلاش کنید',
                            confirmButtonText: 'تائید'
                        })
                    }
                },
                error: function(){
                    input_element.prop('checked', status);
                    Swal.fire({
                        icon: 'error',
                        title: 'ارتباط برقرار نشد',
                        confirmButtonText: 'تائید'
                    })
                }
            });
        }

        $('.delete_button').on('click', function(event){
            event.preventDefault();

            Swal.fire({
                title: 'آیا از حذف این مورد مطمئن هستید؟',
                showCancelButton: true,
                confirmButtonText: 'حذف',
                cancelButtonText: 'لغو',
                focusConfirm: false,
                focusCancel: true,
                icon: 'info'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent().submit();
                }
            });
        });
    </script>
@endsection
