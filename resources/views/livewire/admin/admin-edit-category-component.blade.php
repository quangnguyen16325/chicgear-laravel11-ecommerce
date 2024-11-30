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
                    <span></span> <a href="{{ route('admin.categories') }}">Tất cả danh mục</a>
                    <span></span> Chỉnh sửa danh mục
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
                                    Chỉnh sửa danh mục
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.categories') }}" class="btn btn-success float-end">Tất cả danh mục</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <form wire:submit.prevent="updateCategory">
                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Tên danh mục</label>
                                    <input type="text" name="name" class="form-control" placeholder="Điền tên danh mục" wire:model="name" wire:keyup="generateSlug">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Slug (Đường dẫn)</label>
                                    <input type="text" name="slug" class="form-control" placeholder="Điền đường dẫn danh mục (slug)" wire:model="slug">
                                    @error('slug')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="image" class="form-label">Hình ảnh</label>
                                    <input type="file" class="form-control" wire:model="newImage">
                                    @error('newImage')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    @if ($newImage)
                                        <img src="{{ $newImage->temporaryUrl() }}" alt="" width="120">
                                    @else
                                        <img src="{{ asset('assets/imgs/categories') }}/{{ $image }}" alt="" width="120">
                                    @endif
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="is_popular" class="form-label">Thịnh hành</label>
                                    <select name="is_popular" id="" class="form-control" wire:model="is_popular">
                                        <option value="0">Không</option>
                                        <option value="1">Có</option>
                                    </select>
                                    @error('is_popular')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
