@extends ('layouts.main')
@section('content')

@if (auth()->user())

    @if (auth()->user()->inRole('admin') || auth()->user()->inRole('manager') || auth()->user()->inRole('dev'))

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Prihlasovacie meno</th>
            <th scope="col">Požadovaná rola</th>
            <th scope="col">Schváliť</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @foreach($role_requests as $rq)
                <form method="get" action="{{ route('role.update') }}">
                    <input hidden value="{{$rq->id}}" id="ID" name="ID">
                    @foreach($users as $user)
                        @if($rq->users_id == $user->id)
                            <td>
                                <input hidden value="{{$user->id}}" id="userID" name="userID">
                                {{$user->firstname}} {{$user->lastname}}
                            </td>
                        @endif
                    @endforeach
                        @foreach($roles as $role)
                            @if($rq->requested_role == $role->id)
                                <td>
                                    <input hidden value="{{$role->id}}" id="roleID" name="roleID">
                                    {{$role->name}}
                                </td>
                            @endif
                        @endforeach
                    <td>
                        <button type="submit" value="approve" name="action">
                            Schváliť
                        </button>
                        <button type="submit" value="reject" name="action">
                            Odmietnuť
                        </button>
                    </td>
                </form>
            @endforeach
        </tr>
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
