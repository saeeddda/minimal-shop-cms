@extends('admin.layouts.master')
@section('title', 'ادمین - دسته بندی محصولات')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'دسته بندی محصولات'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">دسته بندی محصولات</h3>
                            <a href="{{ route('admin.market.category.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus mr-1"></i>افزودن دسته بندی</a>

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
                                            <th>نامک</th>
                                            <th>والد</th>
                                            <th>نمایش در منو</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productCategories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>
                                                    <img width="50" src="{{ asset($category->image['index_array'][$category->image['current_image']]) }}" alt="">
                                                </td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->parent_id != null ? $category->parent->name : 'منو اصلی' }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input onchange="changeShowInMenu({{ $category->id }})" data-url="{{ route('admin.market.category.show-change', $category->id ) }}" type="checkbox" class="custom-control-input" id="switch_s_{{ $category->id }}" @if($category->show_in_menu == 1) checked @endif>
                                                        <label class="custom-control-label" for="switch_s_{{ $category->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input onchange="changeStatus({{ $category->id }})" data-url="{{ route('admin.market.category.status', $category->id ) }}" type="checkbox" class="custom-control-input" id="switch_{{ $category->id }}" @if($category->status == 1) checked @endif>
                                                        <label class="custom-control-label" for="switch_{{ $category->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.market.category.destroy', $category->id ) }}" method="post">
                                                        @csrf
                                                        <a href="{{ route('admin.market.category.edit', $category->id ) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-1"></i></a>
                                                        @method('DELETE')
                                                        <button type="submit" class="delete_button btn btn-danger btn-sm delete_button"><i class="fa fa-trash mr-1"></i></button>
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
        function changeShowInMenu(id){
            let input_element = jQuery('#switch_s_' + id);
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
                                title: 'نمایش در منو فعال شد',
                                confirmButtonText: 'تائید'
                            })
                        }else{
                            input_element.prop('checked', false);
                            Swal.fire({
                                icon: 'success',
                                title: 'نمایش در منو غیرفعال شد',
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
                                title: 'دسته بندی فعال شد',
                                confirmButtonText: 'تائید'
                            })
                        }else{
                            input_element.prop('checked', false);
                            Swal.fire({
                                icon: 'success',
                                title: 'دسته بندی غیرفعال شد',
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
