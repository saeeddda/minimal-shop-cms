@extends('admin.layouts.master')
@section('title', 'ادمین - تخفیفات عمومی')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'تخفیفات عمومی'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">تخفیفات عمومی</h3>
                            <a href="{{ route('admin.market.coupon.general.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus mr-1"></i>افزودن تخفیف</a>

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
                                            <th>مقدار</th>
                                            <th>سقف</th>
                                            <th>عنوان</th>
                                            <th>شروع</th>
                                            <th>پایان</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($generalDiscounts as $generalDiscount)
                                            <tr>
                                                <td>{{ $generalDiscount->id }}</td>
                                                <td>{{ $generalDiscount->percentage }}%</td>
                                                <td>{{ $generalDiscount->discount_selling }}</td>
                                                <td>{{ $generalDiscount->title }}</td>
                                                <td>{{ jalaliDate($generalDiscount->start_date) }}</td>
                                                <td>{{ jalaliDate($generalDiscount->end_date) }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input onchange="changeStatus({{ $generalDiscount->id }})" data-url="{{ route('admin.market.coupon.general.status', $generalDiscount->id ) }}" type="checkbox" class="custom-control-input" id="switch_{{ $generalDiscount->id }}" @if($generalDiscount->status == 1) checked @endif>
                                                        <label class="custom-control-label" for="switch_{{ $generalDiscount->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.market.coupon.general.destroy', $generalDiscount->id) }}" method="post">
                                                        @csrf
                                                        <a href="{{ route('admin.market.coupon.general.edit', $generalDiscount->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-1"></i></a>
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm delete_button"><i class="fa fa-trash mr-1"></i></button>
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
                                title: 'تخفیف فعال شد',
                                confirmButtonText: 'تائید'
                            })
                        }else{
                            input_element.prop('checked', false);
                            Swal.fire({
                                icon: 'success',
                                title: 'تخفیف غیرفعال شد',
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
