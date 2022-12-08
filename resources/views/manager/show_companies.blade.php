@extends('layouts.main')
@section('content')

@if (auth()->user())

    @if (auth()->user()->inRole('admin') || auth()->user()->inRole('manager') || auth()->user()->inRole('dev'))

    <table class="table table-white table-hover">
        <thead>
        <tr>
            <th scope="col">Nazov</th>
            <th scope="col">Adresa</th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr>
                <td>{{$company->name}}</td>
                <td>{{$company->address}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @else

        @include('nopermission')

    @endif

@else

    <div class="alert alert-warning" role="alert">
        Nie ste prihlásený!
    </div>

@endif

@endsection
