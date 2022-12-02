@extends ('layouts.main')
@section('content')

    <table>
        <thead>
            <tr>
                <th scope="col">Company</th>
                <th scope="col">Job</th>
                <th scope="col">Study program</th>
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
@endsection
