@extends ('layouts.main')
@section('content')

    @if (auth()->user())

        @if (auth()->user()->inRole('ceo') || auth()->user()->inRole('dev'))

            <table class="table table-white table-hover">
                <thead>
                <tr>
                    <th scope="col">Študent</th>
                    <th scope="col">Praca</th>
                    <th scope="col">Od</th>
                    <th scope="col">Do</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <!----------Contract---------->
                @foreach($contracts as $contract)
                    <!----------Job---------->
                    @foreach($jobs as $job)
                        @if($contract->jobs_id == $job->id)
                            <!----------Company---------->
                            @foreach($companies as $company)
                                @if($job->companies_id == $company->id && $company->id == auth()->user()->companies_id)
                                    <!----------User---------->
                                    @foreach($users as $user)
                                        @if($contract->users_id == $user->id)
                                            <tr>
                                                <td>
                                                    {{ $user->firstname." ".$user->lastname }}
                                                </td>
                                                <td>
                                                    {{ $job->job_type }}
                                                </td>
                                                <td>
                                                    {{ $contract->od }}
                                                </td>
                                                <td>
                                                    {{ $contract->do }}
                                                </td>
                                                <td>
                                                    <form method="get" action="{{ route('ceo.show')}}">
                                                        <button class="btn btn-sm btn-outline-warning" id="contract_id" name="contract_id" value="{{$contract->id}}" type="submit">
                                                            Potvrdit hodiny
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <!------------------------>
                                @endif
                            @endforeach
                            <!--------------------------->
                        @endif
                    @endforeach
                    <!----------------------->
                @endforeach
                <!---------------------------->
                </tbody>
            </table>

        @else

            @include('nopermission')

        @endif

    @else

        <h1 style="text-align: center;">You are not logged in!</h1>

    @endif

@endsection
