<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HikingYuk - Login</title>

    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="/assets/css/extras.css" rel="stylesheet">

</head>

<body>

    <div class="container py-5">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center">

            <div class="col-xl-6 col-lg-6">
                <img class="bg-login" src="/assets/img/bg-login.jpg">
            </div>
            <div class="col-xl-5 col-lg-6">
                <div class="card o-hidden border-0 shadow-lg mb-3">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h1 text-cs font-weight-bold font-italic mb-4">HikingYuk</h1>
                                @if(session()->has('status'))
                                <div class="alert alert-success alert-dismissible fade show">{{ session('status') }}</div>
                                @endif

                                @if(session()->has('LoginError'))
                                <div class="alert alert-danger alert-dismissible fade show">{{ session('LoginError') }}</div>
                                @endif
                            </div>
                            <form class="user" action="/login" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                        id="InputEmail" value="{{ old('email') }}" placeholder="Email" required>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="InputPassword" placeholder="Password" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card o-hidden border-0 shadow-lg mt-2">
                    <div class="card-body py-3">
                        <div class="text-center small">
                            Don't have an account? <a href="/register">Register</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>

</body>

</html>