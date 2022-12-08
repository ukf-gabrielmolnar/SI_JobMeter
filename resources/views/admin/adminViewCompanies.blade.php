@extends ('layouts.main')
@section('content')

    @if (auth()->user())

        @if (auth()->user()->inRole('admin') || auth()->user()->inRole('dev'))

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Firma</th>
                    <th scope="col">Adresa</th>
                    <th scope="col">Schválená</th>
                    <th scope="col"> </th>
                    <th scope="col"> </th>
                </tr>
                </thead>
                <tbody>

                @foreach($companies as $company)

                    <tr>
                        <td>{{$company-> id}}</td>
                        <td>{{$company-> name}}</td>
                        <td>{{$company-> address}}</td>
                        <td>
                            <form method="get" action="{{ route('company.edit') }}">
                                <input hidden id="company_id" name="company_id" value="{{$company->id}}">
                                @csrf
                                @if($company->approved == null)
                                    <button id="action" name="action" value="1" class="btn btn-sm btn-outline-danger" type="submit">Nie</button>
                                    <input hidden id="approved" name="approved" value="1">
                                @else
                                    <button id="action" name="action" value="1" class="btn btn-sm btn-outline-success" type="submit">Áno</button>
                                    <input hidden id="approved" name="approved" value="0">
                                @endif
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#companyEdit{{$company->id}}" onclick="fillData({{$company->id}})">Upraviť</button>
                            <div class="modal fade" id="companyEdit{{$company->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Upraviť</h1>
                                            <!-- x kilepes -->
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form method="get" action="{{ route('company.edit') }}">
                                            <div class="modal-body">

                                                <input hidden id="company_id" name="company_id" value="{{$company->id}}">
                                                <input type="name" placeholder="Company name" value="{{$company->name}}" id="name" name="name">
                                                <input type="name" placeholder="Address" value="{{$company->address}}" id="address" name="address">

                                            </div>
                                            <div class="modal-footer">
                                                <button id="action" name="action" value="0" type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <form method="get" action="{{ route('company.destroy')}}">
                                @csrf
                                @method('delete')
                                <button type="submit" name="id" id="id" value="{{$company->id}}" class="btn btn-sm btn-outline-danger">
                                    Zmazať
                                </button>
                            </form>
                        </td>
                    </tr>
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
