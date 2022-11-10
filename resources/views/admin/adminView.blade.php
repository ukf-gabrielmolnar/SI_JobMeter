@extends ('layouts.main')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">email</th>
            <th scope="col">tel</th>
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
                        <button type="submit">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
