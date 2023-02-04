<!DOCTYPE html>
<html class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">

    <title>Login Admin</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('src/vendor/bootstrap5/bootstrap-5.2.2-dist/css/bootstrap.min.css') }}">
    <!-- Font awesome 4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ url('src/css/admin.css') }}">
</head>

<body class="h-100">
    <div class="container-fluid h-100 p-0">
        <div class="row p-0 h-100 login-section" style="background-color: gray;">
            <div class="offset-lg-8 col-lg-4 offset-md-8 col-md-4 col-10 offset-1 pt-5 bg-white">
                <div class="px-5">
                    <h1 class="pt-5 mb-2" style="font-size: 35px;">Login Sistem</h1>
                    <hr>
                    <p style="font-size: 1rem;">Input data kredensial.</p>
                    <form action="{{ route('admin.login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Username..">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password..">
                        </div>
                        <button type="submit" class="btn" style="background-color: #66ccff; color: #00334d;">Masuk Sistem</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>