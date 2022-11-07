@extends('layouts.main')

@section('content')

    <style>
        .form-group{
            margin-bottom: 15px;
        }
        .form-group .help-block{
            color: #bb2d3b;
        }
    </style>

    <main class="form-signin d-flex align-items-center justify-content-center flex-grow-1">
        <form method="post" action="/register/user">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            @csrf

            <div class="form-group">
                <label for="floatingInput">Email address</label>
                <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <div class="help-block">
                    @if($errors->has('email'))
                        {{ $errors->first('email') }}
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input name="firstname" type="text" class="form-control" id="firstname" placeholder="John">

                <div class="help-block">
                    @if($errors->has('firstname'))
                        {{ $errors->first('firstname') }}
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Doe">

                <div class="help-block">
                    @if($errors->has('lastname'))
                        {{ $errors->first('lastname') }}
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="floatingPassword">Password</label>
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <div class="help-block">
                    @if($errors->has('password'))
                        {{ $errors->first('password') }}
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="passwordRepeat">Repeat Password</label>
                <input name="repeatPassword" type="password" class="form-control" id="passwordRepeat" placeholder="Password">
                <div class="help-block">
                    @if($errors->has('repeatPassword'))
                        {{ $errors->first('repeatPassword') }}
                    @endif
                </div>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
            <p class="mt-5 mb-3 text-muted">© 2017–2022</p>
        </form>
    </main>

@endsection
