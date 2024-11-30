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
                    <span></span> Sliders
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    Tất cả trình chiếu
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.home.slide.add') }}" class="btn btn-success float-end">Thêm slide mới</a>
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
                                        <th>Tiêu đề chính</th>
                                        <th>Tiêu đề</th>
                                        <th>Phụ đề</th>
                                        <th>Ưu đãi</th>
                                        <th>Liên kết</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($slides as $slide)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><img src="{{ asset('assets/imgs/slider') }}/{{ $slide->image }}" width="80" alt=""></td>
                                            <td>{{ $slide->top_title }}</td>
                                            <td>{{ $slide->title }}</td>
                                            <td>{{ $slide->sub_title }}</td>
                                            <td>{{ $slide->offer }}</td>
                                            <td>{{ $slide->link }}</td>
                                            <td>{{ $slide->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}</td>
                                            <td>
                                                <a href="{{ route('admin.home.slide.edit',['slide_id'=>$slide->id]) }}" class="text-info">Sửa</a>
                                                <a href="#" class="text-danger" onclick="deleteConfirmation({{ $slide->id }})" style="margin-left: 10px;">Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                            <button type="button" class="btn btn-danger" onclick="deleteSlide()">Xóa</button>
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
            @this.set('slide_id',id);
            $('#deleteConfirmation').modal('show');
        }  
        
        function deleteSlide()
        {
            @this.call('deleteSlide');
            $('#deleteConfirmation').modal('hide');
        }
    </script>    
@endpush