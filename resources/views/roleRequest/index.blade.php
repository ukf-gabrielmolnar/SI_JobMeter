@extends ('layouts.main')
@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">User name</th>
            <th scope="col">Requested role</th>
            <th scope="col">Approve</th>
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
                            Approve
                        </button>
                        <button type="submit" value="reject" name="action">
                            Reject
                        </button>
                    </td>
                </form>
            @endforeach
        </tr>
        </tbody>
    </table>

@endsection
