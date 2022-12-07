@extends ('layouts.main')
@section('content')

    @if (auth()->user())

        @if (auth()->user()->inRole('ceo') || auth()->user()->inRole('dev'))

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Hours</th>
                    <th scope="col">Approved</th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{$record->date}}</td>
                        <td>{{$record->hours}}</td>
                        <td>
                            <form method="get" action="{{ route('ceo.edit') }}">
                                <input hidden name="record_id" id="record_id" value="{{$record->id}}">
                                @if($record->approved == null)
                                    <button id="approved" name="approved" value="1" class="btn btn-sm btn-outline-danger" type="submit">Nie</button>
                                @else
                                    <button id="approved" name="approved" value="0" class="btn btn-sm btn-outline-success" type="submit">Ano</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <a class="btn btn-sm btn-outline-warning" href="/ceoView">
                Spat
            </a>
        @else

            @include('nopermission')

        @endif

    @else

        <h1 style="text-align: center;">You are not logged in!</h1>

    @endif

@endsection
