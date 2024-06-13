@extends('admin.layouts.master')
@section('title', 'ادمین - مقدار فرم کالا')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'مقدار فرم کالا'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">مقدار فرم کالا</h3>
                            <a href="{{ route('admin.market.property.value.create', $categoryAttribute->id) }}" class="btn btn-success btn-sm"><i class="fa fa-plus mr-1"></i>افزودن مقدار فرم کالا</a>

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
                                            <th>کالا</th>
                                            <th>فرم کالا</th>
                                            <th>مقدار</th>
                                            <th>افزایش قیمت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categoryAttribute->categoryValues as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->product->name }}</td>
                                                <td>{{ $value->attribute->name }}</td>
                                                <td>{{ json_decode($value->value)->value }}</td>
                                                <td>{{ json_decode($value->value)->price_increase }}</td>
                                                <td>
                                                    <form action="{{ route('admin.market.property.value.destroy', ['categoryAttribute' => $categoryAttribute->id, 'categoryValue' => $value->id]) }}" method="POST">
                                                        @csrf
                                                        <a href="{{ route('admin.market.property.value.edit', ['categoryAttribute' => $categoryAttribute->id, 'categoryValue' => $value->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-1"></i>ویرایش</a>
                                                        @method('DELETE')
                                                        <button type="submit" class="delete_button btn btn-danger btn-sm"><i class="fa fa-trash mr-1"></i>حذف</button>
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
