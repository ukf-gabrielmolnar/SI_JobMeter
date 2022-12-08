@extends ('layouts.main')
@section('content')

@if (auth()->user())

    @if (!(auth()->user()->inRole('ceo')))

    <table class="jobList">
        <thead>
            <tr>
                <th scope="col">Firma</th>
                <th scope="col">Práca</th>
                <th scope="col">Študijný program</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <tr>
                    @foreach($companies as $company)
                        @if($job->companies_id == $company->id)
                            <td>{{ $company->name }}</td>
                        @endif
                    @endforeach
                    <td>{{ $job->job_type }}</td>
                    @foreach($study_programs as $sp)
                        @if($job->study_programs_id == $sp->id)
                            <td>{{$sp->study_program}}</td>
                        @endif
                    @endforeach
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
