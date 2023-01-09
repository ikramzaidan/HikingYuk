<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ $Product['name'] }}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="/assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/1565b44817.js" crossorigin="anonymous"></script>
        <!-- Simple line icons-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link href="/assets/css/styles.css" rel="stylesheet" />
        <link href="/assets/css/extras.css" rel="stylesheet" />
    </head>
 
    <body>

        @include('landing.partials.navbar')
        
        <!-- Product-->
        <section id="product-content" class="mt-3 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="">
                            <fieldset id="f11" class="active">
                                <div class="product-pic"> <img class="pic0" src="/storage/{{ $Product->firstImage($Product->id)->url }}"> </div>
                            </fieldset>
                            @foreach($Product->images as $item)
                            @if($item->index != 1)
                            <fieldset id="f{{ $item->index }}1" class="">
                                <div class="product-pic"> <img class="pic0" src="/storage/{{ $item->url }}"> </div>
                            </fieldset>
                            @endif
                            @endforeach
                            <div class="d-flex w-100 justify-content-center mt-1 mb-3">
                                <div id="f1" class="tb tb-active"> <img class="thumbnail-img fit-image" src="/storage/{{ $Product->firstImage($Product->id)->url }}"> </div>
                                @foreach($Product->images as $item)
                                @if($item->index != 1)
                                <div id="f{{ $item->index }}" class="tb"> <img class="thumbnail-img fit-image" src="/storage/{{ $item->url }}"> </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-left">
                        <div class="pb-5">
                            <?php if(isset($Product->category->name)){?><a class="text-md text-cs" href="/categories/<?= $Product->category->slug ?>"><?= $Product->category->name ?></a><?php }?>
                            <h2 class="">{{ $Product['name'] }}</h2>
                            <div class="mb-3 text-lg">
                                IDR {{ number_format($Product['price']) }}
                                <span class="text-sm py-1 px-1" style="background-color: #EEE">
                                    @if($Product['type'] == 1)
                                    Harga Sewa
                                    @else
                                    Harga Jual
                                    @endif
                                </span>
                            </div>
                            <p>{{ $Product['description'] }}</p>
                            @if (auth()->user())
                            <form action="/product/{{ $Product['id'] }}" method="post">
                                @csrf
                                <div class="pt-3">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <div><label for="quantity">Qty</label></div>
                                    <input id="quantity" class="input-products" type="number" name="quantity" value="1" 
                                        min="1" max="{{ $Product['stock'] }}" placeholder="Quantity">
                                    @if ($Product['user_id'] != auth()->user()->id and $Product['stock'] != 0)
                                    <button type="submit" class="mt-3 py-2 px-3">ADD TO CART</button>
                                    @elseif ($Product['user_id'] == auth()->user()->id)
                                    <button type="submit" class="mt-3 py-2 px-3" disabled>ADD TO CART</button>
                                    @elseif ($Product['stock'] == 0)
                                    <button type="submit" class="mt-3 py-2 px-3" disabled>EMPTY STOCK</button>
                                    @endif
                                </div>
                            </form>
                            @else
                            <div class="text-center text-lg-left">
                                <a href="/login" class="btn-custom mt-3 py-2 px-3">You Need To Login First</a>
                            </div>
                            @endif
                        </div>
                        <div class="py-3 px-3" style="background-color: #EEE">
                            <div class="h6 mb-3">Pemilik</div>
                            <div class="row no-gutters">
                                <div class="col-2 px-2">
                                    @if($Product->user->photo != NULL)
                                    <img class="img-photo mb-3" src="/storage/{{ $Product->user->photo }}">
                                    @else
                                    <img class="img-photo mb-3" src="/assets/img/no-profile.png">
                                    @endif
                                </div>
                                <div class="col-10 px-2">
                                    <div class="text-md font-weight-bold">
                                        {{ $Product->user->name }} 
                                        @if($Product->user->verified == 0)
                                        <span class="bg-secondary text-sm text-light px-1">Belum Terverifikasi</span>
                                        @else
                                        <span class="bg-success text-sm text-light px-1">Terverifikasi</span>
                                        @endif
                                    </div>
                                    <div class="text-md"><i class="fa-solid fa-location-dot"></i> 
                                        @if($Product->user->city != NULL AND $Product->user->province != NULL)
                                        {{ $Product->user->city.', '.$Product->user->province }}
                                        @else
                                        Unknown
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="product-related" class="mb-5">
            <div class="container">
                <hr class="divider">
                <div class="h4 text-center">Related Products</div>
                @if ($RelatedProducts->where('category_id', $Product['category_id'])->
                        where('id', '!=', $Product['id'])->count() != 0)
                <div class="row">
                    @foreach ($RelatedProducts->where('category_id', $Product['category_id'])->slice(1, 4) as $item)

                    <div class="col-lg-3 col-6 mb-3 text-center">
                        <a href="{{ $item->id }}">
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
                        <a href="{{ $item->id }}" class="text-md text-uppercase d-inline-block text-truncate">{{ $item->name }}</a>
                        <div>IDR {{ number_format($item->price) }}</div>          
                    </div>

                    @endforeach
                </div>
                @else
                <div class="py-5 text-center">
                    <div class="h4">Maaf, Belum ada produk terkait disini.</div>
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
        <script src="/assets/js/scripts.js"></script>
        <script>
            $(document).ready(function(){
                $(".tb").click(function(){

                    $(".tb").removeClass("tb-active");
                    $(this).addClass("tb-active");

                    current_fs = $(".active");

                    next_fs = $(this).attr('id');
                    next_fs = "#" + next_fs + "1";

                    $("fieldset").removeClass("active");
                    $(next_fs).addClass("active");

                    current_fs.animate({}, {
                        step: function() {
                            current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                            });
                            next_fs.css({
                            'display': 'block'
                            });
                        }
                    });
                });
                $(".square-radio").click(function(){
                    $(".square-radio").removeClass("square-radio-active");
                    $(this).addClass("square-radio-active");
                });
            });
        </script>
    </body>
</html>