@extends('manager.index')

@section('content')
    <table class="table table-white table-hover">
        <thead>
        <tr>
            <th scope="col">Meno</th>
            <th scope="col">Priezvisko</th>
            <th scope="col">E-mail</th>
            <th scope="col">Studijný program</th>
            <th scope="col">Ročník</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <td>{{$user->firstname}}</td>
                <td>{{$user->lastname}}</td>
                <td>{{$user->email}}</td>
                @foreach($study_programs as $st)
                    @if($user->study_programs_id === $st->id)
                        <td>{{$st->study_program}}</td>
                        <td>{{$st->year}}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
