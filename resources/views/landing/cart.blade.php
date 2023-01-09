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
                    <span>Cart</span>
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
                        <div class="row justify-content-between mb-5">
                            <div class="col">
                                <h3>Cart ({{ $Carts->where('user_id', auth()->user()->id)->count() }})</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/" class="btn-custom no-decoration">Wishlist</a>
                            </div>
                        </div>
                        @if ($Carts->where('user_id', auth()->user()->id)->count() == 0)
                        <div class="text-center py-5">
                            <div class="h4 mb-3">Belum ada barang disini!</div>
                            <a href="/categories/all" class="btn-custom no-decoration">Mulai Belanja</a>
                        </div>
                        @else
                        <div class="row px-1 py-1 font-weight-bold text-cs">
                            <div class="col-6 align-self-center text-center">
                                <div class="text-md text-dark text-uppercase">Product</div>
                            </div>
                            <div class="col-2 align-self-center text-center">
                                <div class="text-md text-dark text-uppercase">Qty</div>
                            </div>
                            <div class="col-3 align-self-center text-center">
                                <div class="text-md text-dark text-uppercase">Price</div>
                            </div>
                        </div>
                        @foreach ($Carts->where('user_id', auth()->user()->id) as $item)
                        <div class="card px-1 text-cs mb-2">
                            <div class="row">
                                <div class="col-2">
                                    <div class="box">
                                        <img class="img-product" src="/storage/{{ $item->productImage($item->product->id)->url }}">
                                    </div>
                                </div>
                                <div class="col-4 align-self-center">
                                    <a href="/dashboard/product/update/{{ $item->product->id }}">
                                        <div class="text-md text-dark text-uppercase text-truncate">{{ $item->product->name }}</div>
                                    </a>
                                </div>
                                <div class="col-2 align-self-center text-center">
                                    <div class="text-md text-dark text-uppercase">{{ $item->quantity }}</div>
                                </div>
                                <div class="col-3 align-self-center text-center">
                                    <div class="text-md text-dark text-uppercase text-truncate">IDR {{ number_format($item->product->price*$item->quantity) }}</div>
                                </div>
                                <div class="col-1 align-self-center text-center">
                                    <form id="del" action="/dashboard/cart/{{ $item->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="transparent"><i class="fa-solid fa-trash text-danger"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="row px-1 py-3 font-weight-bold">
                            <div class="col-6 text-center">
                                <div class="text-md text-dark text-uppercase">Total</div>
                            </div>
                            <div class="col-2 text-center"></div>
                            <div class="col-3 text-center">
                                @php
                                    $totalAmount = 0;
                                    foreach($Carts->where('user_id', auth()->user()->id)->where('status', 0) as $item){
                                        $amount = $item->product->price*$item->quantity;
                                        $totalAmount += $amount;
                                    }
                                @endphp
                                <div class="text-md text-dark text-uppercase">IDR {{ number_format($totalAmount) }}</div>
                            </div>
                        </div>
                        <a class="btn btn-success w-100">Checkout</a>
                        @endif
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