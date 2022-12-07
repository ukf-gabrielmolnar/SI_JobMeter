@extends ('layouts.main')
@section('content')

    @if (auth()->user())

        @if (auth()->user()->inRole('admin') || auth()->user()->inRole('dev'))

            <form method="get" action="{{ route('admin.yearFilter') }}">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <div class="col-sm-2">
                        <select class="form-select" id="filter" name="filter" onchange="this.form.submit()">
                            @if($filter == 1)
                                <option value="1" selected>Všetky</option>
                                <option value="2">2022-23</option>
                                <option value="3">2023-24</option>
                            @endif
                            @if($filter == 2)
                                <option value="1">Všetky</option>
                                <option value="2" selected>2022-23</option>
                                <option value="3">2023-24</option>
                            @endif
                            @if($filter == 3)
                                <option value="1">Všetky</option>
                                <option value="2">2022-23</option>
                                <option value="3" selected>2023-24</option>
                            @endif
                        </select>
                    </div>
                </div>
            </form>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Job type</th>
                    <th scope="col">name ppp</th>
                    <th scope="col">Contact name</th>
                    <th scope="col">od</th>
                    <th scope="col">do</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contracts as $contract)
                    @if($contract->ppp_id != null)
                    <tr>
                        <td>
                            {{$contract-> id}}
                        </td>

                        @foreach($users as $user)
                            @if($contract->users_id == $user->id)
                                <td>
                                    {{ $user->firstname." ".$user->lastname }}
                                </td>

                                @foreach($jobs as $job)
                                    @if($contract->jobs_id == $job->id)
                                        <td>
                                            {{ $job->job_type }}
                                        </td>

                                        @foreach($users as $ppp)

                                            @if($contract->ppp_id == $ppp->id)
                                                <td>
                                                    {{ $ppp->firstname." ".$ppp->lastname }}
                                                </td>

                                                @foreach($contacts as $contact)
                                                    @if($contract->contacts_id == $contact->id)
                                                        <td>
                                                            {{ $contact->firstname." ".$contact->lastname }}
                                                        </td>
                                                        <td>
                                                            {{ $contract->od }}
                                                        </td>
                                                        <td>
                                                            {{ $contract->do }}
                                                        </td>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                <td>
                                    <form method="get" action="{{ route('admin.delete')}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" name="id" id="id" value="{{$contract->id}}" class="delete-button">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                            @endif
                        @endforeach
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>


        @else

            @include('nopermission')

        @endif

    @else

        <h1 style="text-align: center;">You are not logged in!</h1>

    @endif

@endsection
