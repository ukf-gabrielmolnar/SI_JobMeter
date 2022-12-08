@extends ('layouts.main')
@section('content')

    @if (auth()->user())

        @if (auth()->user()->inRole('admin') || auth()->user()->inRole('dev'))

            @php
                $help = 0;
                    foreach ($jobs as $job) {
                        $help++;
                    }
            @endphp

            @if ($help == 0)
                <h1 style="text-align: center">Tabuľka je prázdna</h1>
            @else

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Typ práce</th>
                    <th scope="col">Študijný program</th>
                    <th scope="col">Organizácia</th>
                    <th scope="col">Schválená</th>
                    <th scope="col"> </th>
                    <th scope="col"> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($jobs as $job)
                    @foreach($companies as $company)
                        @if($job->companies_id == $company->id)
                            <tr>
                                <td>{{$job-> id}}</td>
                                <td>{{$job-> job_type}}</td>

                                @foreach($sps as $sp)
                                    @if($job->study_programs_id == $sp->id)
                                        <td>{{$sp->study_program}}</td>
                                        <td>{{$company-> name}}</td>


                                        <td>
                                            <form method="get" action="{{ route('job.edit') }}">
                                                <input hidden id="job_id" name="job_id" value="{{$job->id}}">
                                                @csrf
                                                @if($job->approved == null)
                                                    <button id="action" name="action" value="1" class="btn btn-sm btn-outline-danger" type="submit">Nie</button>
                                                    <input hidden id="approved" name="approved" value="1">
                                                @else
                                                    <button id="action" name="action" value="1" class="btn btn-sm btn-outline-success" type="submit">Áno</button>
                                                    <input hidden id="approved" name="approved" value="0">
                                                @endif
                                            </form>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#jobEdit{{$job->id}}" onclick="fillData({{$job->id}})">Upraviť</button>
                                            <div class="modal fade" id="jobEdit{{$job->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Upraviť</h1>
                                                            <!-- x kilepes -->
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <form method="get" action="{{ route('job.edit') }}">
                                                            <div class="modal-body">

                                                                <input hidden id="job_id" name="job_id" value="{{$job->id}}">
                                                                <input type="name" placeholder="Company name" value="{{$job->job_type}}" id="job_type" name="job_type">
                                                                <select class="form-select form-select-lg mb-3 text-dark custom-select" id="companies_id" name="companies_id">
                                                                    @foreach($companies as $companyS)
                                                                        @if($company->id == $companyS->id)
                                                                            <option selected value="{{ $companyS->id }}"> {{$companyS->name}}</option>
                                                                        @else
                                                                            <option  value="{{ $companyS->id }}"> {{$companyS->name}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>

                                                                <select class="form-select form-select-lg mb-3 text-dark custom-select" id="study_programs_id" name="study_programs_id">
                                                                    @foreach($sps as $spS)
                                                                        @if($sp->id == $spS->id)
                                                                            <option selected value="{{ $spS->id }}"> {{$spS->study_program}}</option>
                                                                        @else
                                                                            <option  value="{{ $spS->id }}"> {{$spS->study_program}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button id="action" name="action" value="0" type="submit" class="btn btn-primary">Uložiť zmeny</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <form method="get" action="{{ route('job.destroy')}}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" name="id" id="id" value="{{$job->id}}" class="btn btn-sm btn-outline-danger">
                                                    Zmazať
                                                </button>
                                            </form>
                                        </td>
                            </tr>
                        @endif
                    @endforeach
                    @endif
                @endforeach

                @endforeach
                </tbody>
            </table>

            @endif

        @else

            @include('nopermission')

        @endif

    @else

        <h1 style="text-align: center;">You are not logged in!</h1>

    @endif

@endsection
