@extends ('layouts.main')
@section('content')

    @if (auth()->user())

        @if (auth()->user()->inRole('admin') || auth()->user()->inRole('dev'))

            <form method="get" action="{{ route('admin.filter') }}">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <div class="col-sm-2">
                        <select class="form-select" id="filter" name="filter">
                            @if($filter == 1)
                                <option value="1" selected>Všetky</option>
                                <option value="2">Admin</option>
                                <option value="3">Manažér</option>
                                <option value="4">PPP</option>
                                <option value="5">Študent</option>
                                <option value="6">CEO</option>
                            @endif
                            @if($filter == 2)
                                <option value="1">Všetky</option>
                                <option value="2" selected>Admin</option>
                                <option value="3">Manažér</option>
                                <option value="4">PPP</option>
                                <option value="5">Študent</option>
                                <option value="6">CEO</option>
                            @endif
                            @if($filter == 3)
                                <option value="1">Všetky</option>
                                <option value="2">Admin</option>
                                <option value="3" selected>Manažér</option>
                                <option value="4">PPP</option>
                                <option value="5">Študent</option>
                                <option value="6">CEO</option>
                            @endif
                            @if($filter == 4)
                                <option value="1">Všetky</option>
                                <option value="2">Admin</option>
                                <option value="3">Manažér</option>
                                <option value="4" selected>PPP</option>
                                <option value="5">Študent</option>
                                <option value="6">CEO</option>
                            @endif
                            @if($filter == 5)
                                <option value="1">Všetky</option>
                                <option value="2">Admin</option>
                                <option value="3">Manažér</option>
                                <option value="4">PPP</option>
                                <option value="5" selected>Študent</option>
                                <option value="6">CEO</option>
                            @endif
                            @if($filter == 6)
                                <option value="1">Všetky</option>
                                <option value="2">Admin</option>
                                <option value="3">Manažér</option>
                                <option value="4">PPP</option>
                                <option value="5">Študent</option>
                                <option value="6" selected>CEO</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary"> Použiť filtre </button>
                </div>
            </form>


            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Meno</th>
                    <th scope="col">Priezvisko</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Tel. číslo</th>
                    <th scope="col">Organizácia</th>
                    <th scope="col">Študijný program</th>
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


                        @if($user->companies_id != null)
                            @foreach($companies as $company)
                                @if($user->companies_id == $company->id)
                                    <td>
                                        <input hidden id="company_id{{$user-> id}}" name="company_id{{$user-> id}}" value="{{ $company->id }}">
                                        {{ $company->name }}
                                    </td>
                                @endif
                            @endforeach
                        @else
                            <td>
                                <input hidden id="company_id{{$user-> id}}" name="company_id{{$user-> id}}" value="">
                                Žiadna
                            </td>
                        @endif
                        @if($user->years_id != null)
                            @foreach($years as $year)
                                @if($user->years_id == $year->id)
                                    @foreach($study_programs as $sp)
                                        @if($year->study_programs_id == $sp->id)
                                            <td>
                                                <input hidden id="year_id{{$user-> id}}" name="year_id{{$user-> id}}" value="{{ $year->id }}">
                                                <input hidden id="sp_id{{$user-> id}}" name="sp_id{{$user-> id}}" value="{{ $sp->id }}">
                                                {{ $year->year." ".$sp->study_program }}
                                            </td>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @else
                            <td>
                                <input hidden id="year_id{{$user-> id}}" name="year_id{{$user-> id}}" value="">
                                <input hidden id="sp_id{{$user-> id}}" name="sp_id{{$user-> id}}" value="">
                                Žiadny
                            </td>
                        @endif
                        <td>
                            <button class="btn btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#userEdit{{$user->id}}" onclick="fillData({{$user->id}})">Edit</button>
                            <div class="modal fade" id="userEdit{{$user->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Upraviť</h1>
                                            <!-- x kilepes -->
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="get" action="{{ route('admin.edit') }}">
                                            <div class="modal-body">

                                                <input hidden id="user_id" name="user_id" value="{{$user->id}}">
                                                <input type="name" placeholder="Firstname" value="{{$user->firstname}}" id="firstname" name="firstname">
                                                <input type="name" placeholder="Lastname" value="{{$user->lastname}}" id="lastname" name="lastname">
                                                <input type="name" placeholder="E-mail" value="{{$user->email}}" id="email" name="email">
                                                <input type="name" placeholder="Tel. Number" value="{{$user->tel}}" id="tel" name="tel">

                                                <select class="form-select form-select-lg mb-3 text-dark custom-select" id="companies_idSelect{{$user->id}}" name="companies_idSelect{{$user->id}}">

                                                </select>

                                                <select class="form-select form-select-lg mb-3 text-dark custom-select" id="sp_idSelect{{$user->id}}" name="sp_idSelect{{$user->id}}">

                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Uložiť zmeny</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <form method="post" action="{{ route('admin.destroy', $user->id)}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger">
                                    Zmazať
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <script>

                function fillData(user_id) {
                    var CompanyId = $("#company_id" + user_id).val();
                    var YearId = $("#year_id" + user_id).val();
                    var SpId = $("#sp_id" + user_id).val();

                    var CompanyData = @json($companies);
                    var YearData = @json($years);
                    var SpData = @json($study_programs);

                    $('#companies_idSelect' + user_id).empty()
                    $('#companies_idSelect' + user_id).append('<option value="" selected disabled hidden>Choose here</option>')
                    $.each(CompanyData, function (index, company) {
                        if (company.id == CompanyId) {
                            $('#companies_idSelect' + user_id).append('<option selected value="' + company.id + '">' + company.name + '</option>')
                        } else {
                            $('#companies_idSelect' + user_id).append('<option value="' + company.id + '">' + company.name + '</option>')
                        }
                    })

                    $('#sp_idSelect' + user_id).empty()
                    $('#sp_idSelect' + user_id).append('<option value="" selected disabled hidden>Choose here</option>')
                    $.each(YearData, function (index, year) {
                        $.each(SpData, function (index, sp) {
                            if (year.study_programs_id == sp.id) {
                                if (year.id == YearId && sp.id == SpId) {
                                    $('#sp_idSelect' + user_id).append('<option  selected value="' + year.id + '">' + year.year + " " + sp.study_program + '</option>')
                                } else {
                                    $('#sp_idSelect' + user_id).append('<option   value="' + year.id + '">' + year.year + " " + sp.study_program + '</option>')
                                }
                            }
                        })
                    })
                }

            </script>
        @else

            @include('nopermission')

        @endif

    @else

        <h1 style="text-align: center;">You are not logged in!</h1>

    @endif

@endsection
