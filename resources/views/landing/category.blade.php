<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Hiking Yuk - {{ $title }}</title>
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
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&display=swap" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link href="/assets/css/styles.css" rel="stylesheet" />
        <link href="/assets/css/extras.css" rel="stylesheet" />
    </head>
    <body>
        
        @include('landing.partials.navbar')

        <!-- Icons Grid-->
        <section class="features-icons bg-light text-center">
            <div class="container">
                <h2 class="mb-2">{{ $title }}</h2>
                <?php if(isset($category)) {?><div class="text-md text-cs mb-5"><a href="/">Home</a> / {{ $category }}</div><?php }?>
                <div class="row">
                @if (count($Products) != 0)
                    
                    @foreach ($Products as $item)

                    <div class="col-lg-3">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <a href="/product/{{ $item->id }}">
                                <div class="box">
                                    @if ($item->images->count() != 1)
                                        @foreach($item->images->where('index', '<', 3) as $image)
                                            @if($image->index == 1)
                                            <img class="img-product img-top" src="/storage/{{ $image->url }}">
                                            @else
                                            <img class="img-product" src="/storage/{{ $image->url }}">
                                            @endif
                                        @endforeach
                                    @else
                                    <img class="img-product" src="/storage/{{ $item->firstImage($item->id)->url }}">
                                    @endif
                                </div>
                            </a>
                            <a href="/product/{{ $item->id }}" class="text-lg text-dark text-uppercase d-inline-block text-truncate">{{ $item->name }}</a>
                        <div>IDR {{ number_format($item->price) }}</div>
                        </div>
                    </div>

                    @endforeach

                @else
                    <div class="h3 py-5 text-center">Oops, Tidak ada Produk yang bisa kami temukan!</div>
                @endif

                </div>

                @if ($title == "All Products")
                <div class="mt-3 d-flex justify-content-end">
                    {{ $Products->links() }}
                </div>
                @endif
            </div>
        </section>
        
        @include('landing.partials.footer')

        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/scripts.js"></script>
    </body>
</html>