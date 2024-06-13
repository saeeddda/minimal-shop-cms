@extends('admin.layouts.master')
@section('title', 'ادمین - بنرهای سایت')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'بنرهای سایت'])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('admin.alerts.alert-section.success')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">بنرهای سایت</h3>
                            <a href="{{ route('admin.content.banner.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus mr-1"></i>افزودن بنر</a>

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
                                            <th>تصویر</th>
                                            <th>عنوان</th>
                                            <th>آدرس</th>
                                            <th>مکان</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($banners as $banner)
                                        <tr>
                                            <td>{{ $banner->id }}</td>
                                            <td>
                                                <img width="50" src="{{ asset($banner->image) }}" alt="">
                                            </td>
                                            <td>{{ $banner->title }}</td>
                                            <td>{{ $banner->url }}</td>
                                            <td>{{ $banner->getPositionText }}</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input onchange="changeStatus({{ $banner->id }})" data-url="{{ route('admin.content.banner.status', $banner->id ) }}" type="checkbox" class="custom-control-input" id="switch_{{ $banner->id }}" @if($banner->status == 1) checked @endif>
                                                    <label class="custom-control-label" for="switch_{{ $banner->id }}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.content.banner.destroy', $banner->id ) }}" method="post" id="delete_form">
                                                    @csrf
                                                    <a href="{{ route('admin.content.banner.edit', $banner->id ) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-1"></i>ویرایش</a>
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
                                title: 'بنر فعال شد',
                                confirmButtonText: 'تائید'
                            })
                        }else{
                            input_element.prop('checked', false);
                            Swal.fire({
                                icon: 'success',
                                title: 'بنر غیرفعال شد',
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
