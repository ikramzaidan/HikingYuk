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
    </head>
    <body>
        
        @include('landing.partials.navbar')

        <!-- Section-->
        <section class="section-dashboard bg-light">
            <div class="container">
                <div class="h2">
                    <a href="/dashboard" style="color: black !important;"><i class="fa-solid fa-angle-left"></i></a>
                    <span>Add Product</span>
                </div>
                <div class="row py-5">
                    <div class="col-lg-4 mb-5">
                        <div class="d-flex justify-content-center">
                            @if(auth()->user()->photo != NULL)
                            <img class="img-photo mb-3" src="/storage/{{ auth()->user()->photo }}">
                            @else
                            <img class="img-photo mb-3" src="/assets/img/no-profile.png">
                            @endif
                        </div>
                        <div class="h4">{{ auth()->user()->name }}</div>
                        <div class="mb-4"><i class="fa-solid fa-location-dot"></i> Bandung, Jawa Barat</div>
                        <a href="/dashboard/profile" class="btn-custom w-100 btn-rounded no-decoration">Edit Profile</a>
                    </div>
                    <div class="col-lg-8">
                        @if(session()->has('StoreError'))
                        <div class="alert alert-danger alert-dismissible fade show">{{ session('StoreError') }}</div>
                        @endif
                        <form action="/dashboard/product/create" class="mb-5" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="form-group">
                                <label for="inputName" class="form-label text-dark">Nama</label>
                                <input type="text" id="inputName" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" placeholder="Nama Produk" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="form-label text-dark">Foto</label>
                                <input class="form-control" type="file" name="files[]" multiple>
                            </div>
                            <div class="form-group">
                                <label for="selectCategory" class="form-label text-dark">Jual/Sewa</label>
                                <select id="selectCategory" class="form-control" name="type">
                                    <option value="1" selected>Sewa</option>
                                    <option value="2">Jual</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputPrice" class="form-label text-dark">Harga</label>
                                <input type="number" id="inputPrice" class="form-control @error('price') is-invalid @enderror" name="price"
                                    value="{{ old('price') }}" placeholder="Harga Produk" required>
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputStock" class="form-label text-dark">Stok</label>
                                <input type="number" id="inputStock" class="form-control @error('stock') is-invalid @enderror" name="stock"
                                    value="{{ old('stock') }}" placeholder="Stok Produk" required>
                                @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="selectCategory" class="form-label text-dark">Kategori</label>
                                <select id="selectCategory" class="form-control" name="category_id">
                                    @foreach ($Categories as $item)
                                    @if(old('category') == $item->id)
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
                                <textarea class="form-control" type="text" name="description">{{ old('description') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Save</button>
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

        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/scripts.js"></script>
        <!-- Script -->
        
    </body>
</html>