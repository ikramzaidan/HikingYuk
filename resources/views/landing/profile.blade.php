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
                    <span>Edit Profile</span>
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
                    </div>
                    <div class="col-lg-8">
                        <form action="/dashboard/profile" class="mb-5" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <div class="form-group">
                                <label for="photo">Foto Profil</label>
                                <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">
                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    placeholder="Name" value="{{ auth()->user()->name }}" required>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                                    placeholder="Username" value="{{ auth()->user()->username }}" disabled>
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    placeholder="Email" value="{{ auth()->user()->email }}" required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="city">Kota</label>
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                                    placeholder="City" value="{{ auth()->user()->city }}">
                                @error('city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="province">Kota</label>
                                <input id="province" type="text" class="form-control @error('province') is-invalid @enderror" name="province"
                                    placeholder="Province" value="{{ auth()->user()->province }}">
                                @error('province')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" id="ButtonSubmit" class="btn btn-success form-control mb-3">Save</button>
                            <a class="btn-custom w-100 btn-rounded no-decoration" href="/dashboard/profile/password">Change Password</a>
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
    </body>
</html>