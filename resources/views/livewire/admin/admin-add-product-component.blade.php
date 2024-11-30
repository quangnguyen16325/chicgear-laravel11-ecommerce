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
                    <span></span> <a href="{{ route('admin.products') }}">Tất cả sản phẩm</a>
                    <span></span> Thêm sản phẩm mới
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
                                    Thêm sản phẩm mới
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.products') }}" class="btn btn-success float-end">Tất cả sản phẩm</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <form wire:submit.prevent="addProduct">
                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Tên sản phẩm</label>
                                    <input type="text" name="name" class="form-control" placeholder="Điền tên sản phẩm" wire:model="name" wire:keyup="generateSlug">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="slug" class="form-label">Slug (Đường dẫn)</label>
                                    <input type="text" name="slug" class="form-control" placeholder="Điền đường dẫn sản phẩm (slug)" wire:model="slug">
                                    @error('slug')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="short_description" class="form-label">Miêu tả ngắn</label>
                                    <textarea class="form-control" name="short_description" id="" cols="30" rows="10" placeholder="Điền miêu tả ngắn" wire:model="short_description"></textarea>
                                    @error('short_description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="description" class="form-label">Miêu tả</label>
                                    <textarea class="form-control" name="description" id="" cols="30" rows="10" placeholder="Điền miêu tả" wire:model="description"></textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="regular_price" class="form-label">Giá gốc</label>
                                    <input type="text" name="regular_price" class="form-control" placeholder="Điền giá gốc" wire:model="regular_price">
                                    @error('regular_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="sale_price" class="form-label">Giá khuyến mãi</label>
                                    <input type="text" name="sale_price" class="form-control" placeholder="Điền giá khuyến mãi" wire:model="sale_price">
                                    @error('sale_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="sku" class="form-label">Đơn vị lưu kho (SKU)</label>
                                    <input type="text" name="sku" class="form-control" placeholder="Điền đơn vị lưu kho (SKU)" wire:model="sku">
                                    @error('sku')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="stock_status" class="form-label">Tình trạng kho hàng</label>
                                    <select class="form-control" name="stock_status" id="" wire:model="stock_status">
                                        <option value="instock">Còn hàng</option>
                                        <option value="outofstock">Hết hàng</option>
                                    </select>
                                    @error('stock_status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="featured" class="form-label">Nổi bật</label>
                                    <select class="form-control" name="featured" id="" wire:model="featured">
                                        <option value="0">Không</option>
                                        <option value="1">Có</option>
                                    </select>
                                    @error('featured')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="quantity" class="form-label">Số lượng</label>
                                    <input type="text" name="quantity" class="form-control" placeholder="Điền số lượng sản phẩm" wire:model="quantity">
                                    @error('quantity')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="image" class="form-label">Hình ảnh</label>
                                    <input type="file" name="image" class="form-control" wire:model="image"> 
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" alt="" width="120">
                                    @endif
                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="category_id" class="form-label">Danh mục</label>
                                    <select class="form-control" name="category_id" id="" wire:model="category_id">
                                        <option value="">Chọn Danh mục</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
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
