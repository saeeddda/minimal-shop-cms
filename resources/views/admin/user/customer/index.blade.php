@extends('admin.layouts.master')
@section('title', 'ادمین - مشتریان')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'مشتریان'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">مشتریان</h3>
                            <a href="{{ route('admin.user.customer.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus mr-1"></i>افزودن مشتری</a>

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
                                            <th>#</th>
                                            <th>ایمیل</th>
                                            <th>شماره موبایل</th>
                                            <th>نام</th>
                                            <th>وضعیت حساب</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->mobile }}</td>
                                                <td>{{ $user->fullName }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input onchange="changeActivation({{ $user->id }})" data-url="{{ route('admin.user.customer.activation', $user->id ) }}" type="checkbox" class="custom-control-input" id="switch_a_{{ $user->id }}" @if($user->activation == 1) checked @endif>
                                                        <label class="custom-control-label" for="switch_a_{{ $user->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input onchange="changeStatus({{ $user->id }})" data-url="{{ route('admin.user.customer.status', $user->id ) }}" type="checkbox" class="custom-control-input" id="switch_{{ $user->id }}" @if($user->status == 1) checked @endif>
                                                        <label class="custom-control-label" for="switch_{{ $user->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.user.customer.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        <a href="{{ route('admin.user.customer.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-1"></i></a>
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
