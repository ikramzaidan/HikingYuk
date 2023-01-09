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
                    <span>Dashboard</span>
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
                        <div class="mb-4"><i class="fa-solid fa-location-dot"></i> 
                            @if(auth()->user()->city != NULL AND auth()->user()->province != NULL)
                            {{ auth()->user()->city.', '.auth()->user()->province }}
                            @else
                            Unknown
                            @endif
                        </div>
                        <a href="/dashboard/profile" class="btn-custom w-100 btn-rounded no-decoration">Edit Profile</a>
                    </div>
                    <div class="col-lg-8">
                        <div class="row justify-content-between mb-3">
                            <div class="col">
                                <h3>Products ({{ $Products->where('user_id', auth()->user()->id)->count() }})</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/dashboard/product/create" class="btn-custom no-decoration">Add Product</a>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($Products->where('user_id', auth()->user()->id) as $item)
                            <div class="col-lg-6 col-md-6 text-center">
                                <div class="card mb-5 mb-lg-3 pb-3 px-1">
                                    <a href="/dashboard/product/update/{{ $item->id }}">
                                        <div class="box">
                                            <img class="img-product" src="/storage/{{ $item->firstImage($item->id)->url }}">
                                        </div>
                                    </a>
                                    <a href="/dashboard/product/update/{{ $item->id }}" class="text-lg text-dark text-uppercase text-truncate">{{ $item->name }}</a>
                                    <div>IDR {{ number_format($item->price) }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
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
    </body>
</html>