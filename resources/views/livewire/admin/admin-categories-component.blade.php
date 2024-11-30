<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> <a href="{{ route('admin.dashboard') }}">Trang quản trị</a>
                    <span></span> Tất cả danh mục
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            {{-- <div class="row">
                                <div class="col-md-6">
                                    Tất cả danh mục
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.category.add') }}" class="btn btn-success float-end">Thêm danh mục mới</a>
                                </div>
                            </div> --}}
                            <div class="row align-items-center mb-2">
                                <div class="col-md-6 d-flex align-items-center">
                                    <h5 class="mb-0">Tất cả danh mục</h5>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end align-items-center">
                                    <!-- Thanh tìm kiếm -->
                                    <input type="text" class="form-control mb-0 me-2" placeholder="Tìm kiếm danh mục..." wire:model.live.debounce.300ms="search" style="max-width: 300px;" />
                                    <!-- Nút thêm sản phẩm -->
                                    <a href="{{ route('admin.category.add') }}" class="btn btn-success mb-0">Thêm danh mục mới</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên danh mục</th>
                                        <th>Slug (Đường dẫn)</th>
                                        <th>Thịnh hành</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = ($categories->currentPage()-1)*$categories->perPage();
                                    @endphp
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><img src="{{ asset('assets/imgs/categories') }}/{{ $category->image }}" alt="" width="60"></td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>{{ $category->is_popular == 1 ? 'Có' : 'Không' }}</td>
                                            <td>
                                                <a href="{{ route('admin.category.edit',['category_id'=>$category->id]) }}" class="text-info">Sửa</a>
                                                <a href="#" class="text-danger" onclick="deleteConfirmation({{ $category->id }})" style="margin-left: 20px;">Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <div class="modal" id="deleteConfirmation" wire:ignore>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body pb-30 pt-30">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4 class="pb-3">Bạn có chắc chắn muốn xóa?</h4>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Hủy bỏ</button>
                            <button type="button" class="btn btn-danger" onclick="deleteCategory()">Xóa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        function deleteConfirmation(id)
        {
            @this.set('category_id',id);
            $('#deleteConfirmation').modal('show');
        }  
        
        function deleteCategory()
        {
            @this.call('deleteCategory');
            $('#deleteConfirmation').modal('hide');
        }
    </script>    
@endpush