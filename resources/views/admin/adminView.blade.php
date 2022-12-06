@extends ('layouts.main')
@section('content')

@if (auth()->user())

    @if (auth()->user()->inRole('admin') || auth()->user()->inRole('dev'))

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Meno</th>
            <th scope="col">Priezvisko</th>
            <th scope="col">E-mail</th>
            <th scope="col">Telefónne číslo</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user-> id}}</td>
                <td>{{$user-> firstname}}</td>
                <td>{{$user-> lastname}}</td>
                <td>{{$user-> email}}</td>
                <td>{{$user-> tel}}</td>
                <td>
                    <form method="post" action="{{ route('admin.destroy', $user->id)}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="delete-button">
                            Zmazať
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @else

        @include('nopermission')

    @endif

@else

    <h1 style="text-align: center;">Nie ste prihlásený!</h1>

@endif

@endsection
