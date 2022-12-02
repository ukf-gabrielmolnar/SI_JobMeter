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
            height: 520px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            border-radius: 0px;
            padding-top: 22px;
        }
        .box input[type="email"],.box input[type="password"],.box input[type="text"] {
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

        .list-group-item {
            display: block;
            margin: 20px auto;
            padding: 14px 10px 0px 10px;
            width: 300px;
            border-radius: 0px;
            color: white;
        }

        .form-select {
            background-color: #212529;!important;
            border: 2px solid #3a3a3a;
            color: #6c757d;
            text-align: center;
            font-size: 17px;
        }

        button {
            display: block;
            margin: 20px auto 0px auto;
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
        @media screen and (max-width: 600px) {
            .box {
                width: 100%;
                position: relative;
                margin-top: 300px;
            }
        }


    </style>

    <main class="form-signin d-flex align-items-center justify-content-center flex-grow-1">
        <form method="post" action="/register/user" class="box">
            <h1 class="h3 mb-3 fw-normal" style="padding: 5px">Registrácia</h1>
            @csrf

            <div class="form-group">
                <li class="list-group-item">
                    <select style="border-radius: 0px" class="form-select form-select-lg mb-3" id="role_id" name="role_id" required>
                        <option value="" disabled selected hidden>Rola</option>
                        <option value="1">Admin</option>
                        <option value="4">Student</option>
                        <option value="3">PPP</option>
                        <option value="5">Ceo</option>
                        <option value="2">Manager</option>
                    </select>
                </li>
            </div>

            <div class="form-group">
                <input name="email" type="email" class="form-control" id="floatingInput" @if($errors->has('email')) placeholder="{{ $errors->first('email') }}" style="::placeholder: color: red" @else placeholder="Email" @endif>
            </div>

            <div class="form-group">
                <input name="firstname" type="text" class="form-control" id="firstname" @if($errors->has('firstname')) placeholder="{{ $errors->first('firstname') }}" @else placeholder="Meno" @endif>
            </div>

            <div class="form-group">
                <input name="lastname" type="text" class="form-control" id="lastname" @if($errors->has('lastname')) placeholder="{{ $errors->first('lastname') }}" @else placeholder="Priezvisko" @endif>
            </div>

            <div class="form-group">
                <input name="password" type="password" class="form-control" id="floatingPassword" @if($errors->has('password')) placeholder="{{ $errors->first('password') }}" @else placeholder="Heslo" @endif>
            </div>

            <div class="form-group">
                <input name="repeatPassword" type="password" class="form-control" id="passwordRepeat" @if($errors->has('repeatPassword')) placeholder="{{ $errors->first('repeatPassword') }}" @else placeholder="Heslo ešte raz" @endif>
            </div>
            <button style="border-radius: 0px 0px; "  class="w-100 btn btn-lg btn-darkgrey" type="submit">Registrovať</button>

        </form>
    </main>
@endsection
