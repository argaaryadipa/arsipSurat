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
            <h3 class="text-center">Lupa Password</h3>
            <hr>
            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div> 
            @elseif(session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>    
            @endif
            <form action="{{route('reset.password')}}" method="post">
            @csrf
                <div class="form-group">
                    <label>Masukan email</label>
                    <input type="emai" name="email" class="form-control" placeholder="ex : contoh@gmail.com" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-submit"></i> Submit</button>
                <hr>
                <p class="text-center">Sudah punya akun silahkan <a href="{{ url('/') }}">Login Disini!</a></p>
            
            </form>
        </div>
    </div>
</body>
</html>