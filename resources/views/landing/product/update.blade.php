@if($Product['user_id'] == auth()->user()->id)
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>HikingYuk | Outdoor Gear Marketplace</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/1565b44817.js" crossorigin="anonymous"></script>
        <!-- Simple line icons-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link href="/assets/css/styles.css" rel="stylesheet" />
        <link href="/assets/css/extras.css" rel="stylesheet" />
        <script src="/assets/vendor/jquery/jquery.min.js"></script>
    </head>
    <body>
        
        @include('landing.partials.navbar')

        <!-- Section-->
        <section class="section-dashboard bg-light">
            <div class="container">
                <div class="h2">
                    <a href="/dashboard" style="color: black !important;"><i class="fa-solid fa-angle-left"></i></a>
                    <span>Edit Product</span>
                </div>
                <div class="row py-5">
                    <div class="col-lg-4 mb-5">
                        <img class="img-fluid mb-3" src="/storage/{{ $Product->firstImage($Product->id)->url }}">
                        <a href="/product/{{ $Product['id'] }}" class="btn-custom w-100 btn-rounded no-decoration mb-3">View Product</a>
                        <a class="deleteProduct btn btn-danger w-100" data-id="{{ $Product->id }}">Delete Product</a>
                    </div>
                    <div class="col-lg-8">
                        @if(session()->has('StoreError'))
                        <div class="alert alert-danger alert-dismissible fade show">{{ session('StoreError') }}</div>
                        @endif
                        <form action="/dashboard/product/update/{{ $Product['id'] }}" class="mb-5" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="form-group">
                                <label for="inputName" class="form-label text-dark">Nama</label>
                                <input type="text" id="inputName" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $Product['name'] }}" placeholder="Nama Produk" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="selectCategory" class="form-label text-dark">Kategori</label>
                                <select id="selectCategory" class="form-control" name="type">
                                    <option value="1" @if( $Product['type'] == 1 ) selected @endif>Sewa</option>
                                    <option value="2" @if( $Product['type'] == 2 ) selected @endif>Jual</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputPrice" class="form-label text-dark">Harga</label>
                                <input type="number" id="inputPrice" class="form-control @error('name') is-invalid @enderror" name="price"
                                    value="{{ $Product['price'] }}" placeholder="Harga Produk" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputStock" class="form-label text-dark">Stok</label>
                                <input type="number" id="inputStock" class="form-control @error('stock') is-invalid @enderror" name="stock"
                                    value="{{ $Product['stock'] }}" placeholder="Stok Produk" required>
                                @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="selectCategory" class="form-label text-dark">Kategori</label>
                                <select id="selectCategory" class="form-control" name="category_id">
                                    @foreach ($Categories as $item)
                                    @if( $Product['category_id']  == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editor" class="form-label text-dark">Deskripsi</label>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <textarea class="form-control" type="text" name="description">{{ $Product['description'] }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100 mb-3">Update Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Image-->
        <section class="foothead text-white text-center">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <h1 class="mb-5">#JelajahIndonesia</h1>
                    </div>
                </div>
            </div>
        </section>
        
        @include('landing.partials.footer')

        <!-- Delete Product Modal-->
        <div class="modal" id="deleteProductModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Delete Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Are you sure want to delete this product?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form id="del" action="" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
        $('.deleteProduct').on('click',function(){
            const id = $(this).data('id');
            $("form#del").attr("action", "/dashboard/product/delete/"+id);
            $("#deleteProductModal").modal('show');
        });
        </script>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/scripts.js"></script>
    </body>
</html>
@endif