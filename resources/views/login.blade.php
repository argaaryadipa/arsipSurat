<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi SukaSuka</title>
    <link rel="icon" href="{{ asset('Admin/dist/img/sukarsuk.png') }}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container"><br>
        <div class="col-md-4 col-md-offset-4">
            <div class="text-center">
                <style>
                    #img{
                        height: 20%;
                        width: 20%;
                        margin-bottom: -10px;
                    }
                </style>
                <img src="{{asset('Admin/dist/img/sukarsuk.png')}}" alt="AdminLTE Logo" id="img" class="brand-image img-circle elevation-3" style="opacity: .8">
                <h2 class="text-center"><b>SukaSuka</b></h2>
                <h4 class="text-center">Surat Masuk Surat Keluar</h4>
            </div>
            <hr>
            @if(session('error'))
            <div class="alert alert-danger">
                <b>Opps!</b> {{session('error')}}
            </div>
            @endif
            @if(session('message'))
            <div class="alert alert-success">
                <b>Yay !</b> {{session('message')}}
            </div>
            @endif
            <form action="{{ route('actionlogin') }}" method="post">
            @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="changePasswordForm" class="form-control" placeholder="Password" required="">
                    <label style="margin-top:5px; padding: 2px; color:red;" id="errors"></label>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Log In</button>
                <hr>
                <p class="text-center">Belum punya akun? <a href="{{ url('register') }}">Register</a> sekarang!</p>
                <p class="text-center">Lupa kata sandi ? <a href="{{ url('password') }}">Ubah</a> sekarang!</p>
            </form>
        </div>
    </div>
</body>
</html>
