@extends('layouts.mainLoginRegister')

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
            height: 300px;
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            border-radius: 0px;
            padding-top: 22px;
            margin-bottom: 20px;
        }
        .box input[type="email"],.box input[type="password"],.box input[type="text"]{
            border: 0px;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #3a3a3a;
            padding: 14px 10px;
            width: 280px;
            border-radius: 0px;
            color: white;
        }
        button {
            display: block;
            margin: 20px auto;
            text-align: center;
            padding-top: 14px;
            width: 120px;
            border-radius: 0px;
            color: white;
            outline: none;
            text-transform: uppercase;
            font-weight: bold;
        }

        .box input[type="email"]:hover,.box input[type="password"]:hover,.box input[type="text"]:hover{
            width: 320px;
            border-color: #86F4FFFF;
            transition: 0.4s;
        }

        /* Responsivity */
        @media screen and (max-width: 550px) {
            .box {
                width: 100%;
                position: relative;
                margin-top: 180px;
            }
        }


    </style>

    <main class="form-signin d-flex align-items-center justify-content-center flex-grow-1 main">
        <form method="post" action="/login" class="box">
            <h1 class="h3 mb-3 fw-normal" style="padding: 5px">Prihlásenie</h1>
            @csrf

            <div class="form-group">
                <input name="email" type="email" class="form-control" id="floatingInput" @if($errors->has('email')) placeholder="{{ $errors->first('email') }}" style="::placeholder: color: red" @else placeholder="Email" @endif>
            </div>

            <div class="form-group">
                <input name="password" type="password" class="form-control" id="floatingPassword" @if($errors->has('password')) placeholder="{{ $errors->first('password') }}" @else placeholder="Password" @endif>
            </div>

            <div class="checkbox mb-3">
                <label style="color: white">
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button style="border-radius: 0px 0px; "  class="w-100 btn btn-lg btn-darkgrey" type="submit">Prihlásiť</button>
        </form>
    </main>

@endsection
