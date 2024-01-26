<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi SukaSuka</title>
    <link rel="icon" href="{{ asset('Admin/dist/img/sukarsuk.png') }}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>
<body>
    <div class="container"><br>
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center">Reset Password</h3>
            <hr>
            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
            <form action="{{ route('submit.resspassword') }}" method="post">
            @csrf
            <input type="text" value="{{ $verify_key }}" hidden>
                <div class="form-group">
                    <label>Alamat email</label>
                    <input type="email" name="email" class="form-control" value="{{ $email }}" required readonly>
                </div>
                <div class="form-group">
                    <label>Password baru</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-submit"></i> Submit</button>
                <hr>
                <p class="text-center">Sudah punya akun silahkan <a href="{{ url('/') }}">Login Disini!</a></p>
            </form>
        </div>
    </div>
</body>
</html>