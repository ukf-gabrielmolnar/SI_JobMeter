@extends('manager.index')

@section('content')
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
@endsection
