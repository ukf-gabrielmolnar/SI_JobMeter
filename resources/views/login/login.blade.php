@extends('layouts.main')

@section('content')
    <style>
        *{
            margin: 0px;
            padding: 0px;
            font-family: sans-serif;
        }
        *:focus {
            outline: 0 !important;
        }
        .form-group{
            margin-bottom: 15px;
        }
        .form-group .help-block{
            color: #bb2d3b;
        }
        h1{
            color: white;
            text-transform: uppercase;
        }
        .box{
            background: #212529;
            width: 400px;
            height: 350px;
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            border-radius: 30px;
            padding-top: 22px;
            margin-bottom: 20px;
        }
        .box input[type="email"],.box input[type="password"]{
            border: 0px;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid green;
            padding: 14px 10px;
            width: 280px;
            border-radius: 25px;
            color: white;
        }
        button {
            border: 0px;
            background: green;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid green;
            padding: 14px 10px;
            width: 120px;
            border-radius: 25px;
            color: white;
            outline: none;
            text-transform: uppercase;
            font-weight: bold;
        }
        button:hover{
            background-color:  #2E9AD5 ;
            border-color: #2E9AD5;
            cursor: pointer;
            /*  transition: 0.4s;*/
        }

        .box input[type="email"]:hover,.box input[type="password"]:hover{
            width: 320px;
            border-color: #2E9AD5;
            transition: 0.4s;
        }
        button:active{
            color: #2E9AD5;
        }


    </style>

    <main class="form-signin d-flex align-items-center justify-content-center flex-grow-1 main">
        <form method="post" action="/login" class="box">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            @csrf

            <div class="form-group">
                <input name="email" type="email" class="form-control" id="floatingInput" placeholder="Email">
                <div class="help-block">
                    @if($errors->has('email'))
                        {{ $errors->first('email') }}
                    @endif
                </div>
            </div>

            <div class="form-group">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <div class="help-block">
                    @if($errors->has('password'))
                        {{ $errors->first('password') }}
                    @endif
                </div>
            </div>

            <div class="checkbox mb-3">
                <label style="color: white">
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn-primary" type="submit">Sign in</button>
        </form>
    </main>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

@endsection
