@extends('admin.layouts.master')
@section('title', 'ادمین - گالری محصول')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'گالری محصول'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">گالری محصول</h3>
                            <a href="{{ route('admin.market.product.gallery.create', $product->id) }}" class="btn btn-success btn-sm"><i class="fa fa-plus mr-1"></i>آپلود تصویر محصول</a>

                            <div class="card-tools">
                                <h4 class="card-title"> محصول : {{ $product->name }}</h4>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-sm">#</th>
                                            <th class="text-sm">تصویر</th>
                                            <th class="text-sm">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product->galleries as $picture)
                                            <tr>
                                                <td>{{ $picture->id }}</td>
                                                <td>
                                                    <img src="{{ asset($picture->image['index_array'][$picture->image['current_image']]) }}" alt="" width="100px" >
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.market.product.gallery.destroy', ['product' => $product->id,'productGallery' => $picture->id]) }}" method="POST">
                                                        @csrf
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
