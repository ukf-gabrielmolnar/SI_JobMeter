@extends('layouts.main')

@section('content')
    <form action="{{ route('manager.saveSupervisor') }}" method="post">
        @csrf
    <table class="table table-white table-hover">
        <thead>
        <tr>
            <th scope="col">Student</th>
            <th scope="col">Prace</th>
            <th scope="col">od</th>
            <th scope="col">do</th>
            <th scope="col">Nadriadeny</th>
            <th scope="col"> </th>
        </tr>
        </thead>
        <tbody>
        @foreach($contracts as $contract)
            @if($contract->approved === 1 && $contract->contacts_id === NULL)
                <tr>
                    @foreach($users as $user)
                        @if($contract->users_id === $user->id)
                            <td>{{$user->firstname}}{{" "}}{{$user->lastname}}</td>
                        @endif
                    @endforeach
                    @foreach($jobs as $job)
                        @if($contract->jobs_id === $job->id)
                            <td>{{$job->job_type}}</td>
                        @endif
                    @endforeach
                    <td>{{$contract->od}}</td>
                    <td>{{$contract->do}}</td>
                    <td>
                        <select class="form-select" id="contact_id" name="contact_id">
                            <option value="0" selected="selected" hidden>
                                {{__('Vyberte nadriadeneho')}}
                            </option>
                            @foreach($users as $user)
                                <!-- ide jön az r(i)ba(n)c auth hogy csak azok legyenek ott akik tanarok -->
                                <option value={{$user}}>
                                    {{$user->firstname}}{{"  "}}{{$user->lastname}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <a class="show-modal btn btn-sm btn-outline-warning" onclick="saveSelected({{$contract}})">Priradit</a>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $
        function saveSelected(contract){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var ele = document.getElementById("contact_id");
            var selectedSup = ele.options[ele.selectedIndex].value;
            if(ele.id != null){
                $.ajax({
                    url: 'savesupervisor',
                    type: 'post',
                    cache: false,
                    data:{
                        _token: CSRF_TOKEN,contact:ele.id,contract:contract
                    }
                })
            }

        }
    </script>
@endsection
