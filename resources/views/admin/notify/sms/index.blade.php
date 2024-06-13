@extends('admin.layouts.master')
@section('title', 'ادمین - اعلان پیامکی')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'اعلان پیامکی'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">اعلان پیامکی</h3>
                            <a href="{{ route('admin.notify.sms.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus mr-1"></i>افزودن اعلان</a>

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
                                            <th>عنوان اطلاعیه</th>
                                            <th>تاریخ ارسال</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sms as $single_sms)
                                            <tr>
                                                <td>{{ $single_sms->id }}</td>
                                                <td>{{ $single_sms->title }}</td>
                                                <td>{{ jalaliDate($single_sms->published_at, 'H:i:s Y-m-d') }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input onchange="changeStatus({{ $single_sms->id }})" data-url="{{ route('admin.notify.sms.status', $single_sms->id ) }}" type="checkbox" class="custom-control-input" id="switch_{{ $single_sms->id }}" @if($single_sms->status == 1) checked @endif>
                                                        <label class="custom-control-label" for="switch_{{ $single_sms->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.notify.sms.destroy', $single_sms->id) }}" method="POST">
                                                        @csrf
                                                        <a href="{{ route('admin.notify.sms.send-sms', $single_sms->id) }}" class="btn btn-primary btn-sm"><i class="far fa-paper-plane mr-1"></i>ارسال پیامک</a>
                                                        <a href="{{ route('admin.notify.sms.edit', $single_sms->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-1"></i>ویرایش</a>
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm delete_button"><i class="fa fa-trash mr-1"></i>حذف</button>
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
                                title: 'ارسال پیامک فعال شد',
                                confirmButtonText: 'تائید'
                            })
                        }else{
                            input_element.prop('checked', false);
                            Swal.fire({
                                icon: 'success',
                                title: 'ارسال پیامک غیرفعال شد',
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
