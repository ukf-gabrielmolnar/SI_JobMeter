@extends ('layouts.main')
@section('content')

    @if (auth()->user())

        @if (auth()->user()->inRole('admin') || auth()->user()->inRole('dev'))

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Meno</th>
                    <th scope="col">Priezvisko</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Tel. číslo</th>
                    <th scope="col">Firma</th>
                    <th scope="col">Schválená</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }} </td>
                            <td>{{ $contact->firstname }} </td>
                            <td>{{ $contact->lastname }} </td>
                            <td>{{ $contact->email }} </td>
                            <td>{{ $contact->tel }} </td>
                            @foreach($companies as $company)
                                @if($contact->companies_id == $company->id)
                                    <td>{{ $company->name}} </td>

                                    <td>
                                        <form method="get" action="{{ route('contact.edit') }}">
                                            <input hidden id="contact_id" name="contact_id" value="{{$contact->id}}">
                                            @csrf
                                            @if($contact->approved == null)
                                                <button id="action" name="action" value="1" class="btn btn-sm btn-outline-danger" type="submit">Nie</button>
                                                <input hidden id="approved" name="approved" value="1">
                                            @else
                                                <button id="action" name="action" value="1" class="btn btn-sm btn-outline-success" type="submit">Áno</button>
                                                <input hidden id="approved" name="approved" value="0">
                                            @endif
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#companyEdit{{$contact->id}}">Upraviť</button>
                                        <div class="modal fade" id="companyEdit{{$contact->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Upraviť</h1>
                                                        <!-- x kilepes -->
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form method="get" action="{{ route('contact.edit') }}">
                                                        <div class="modal-body">

                                                            <input hidden id="contact_id" name="contact_id" value="{{$contact->id}}">
                                                            <input type="name" placeholder="Firstname" value="{{$contact->firstname}}" id="firstname" name="firstname">
                                                            <input type="name" placeholder="Lastname" value="{{$contact->lastname}}" id="lastname" name="lastname">
                                                            <input type="email" placeholder="Email" value="{{$contact->email}}" id="email" name="email">
                                                            <input type="tel" placeholder="Tel" value="{{$contact->tel}}" id="tel" name="tel">

                                                            <select class="form-select form-select-lg mb-3 text-dark custom-select" id="companies_id" name="companies_id">
                                                                @foreach($companies as $companyS)
                                                                    @if($contact->companies_id == $companyS->id)
                                                                        <option selected value="{{ $companyS->id }}"> {{$companyS->name}}</option>
                                                                    @else
                                                                        <option  value="{{ $companyS->id }}"> {{$companyS->name}}</option>
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
                                        <form method="get" action="{{ route('contact.destroy')}}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" name="id" id="id" value="{{$company->id}}" class="btn btn-sm btn-outline-danger">
                                                Zmazať
                                            </button>
                                        </form>
                                    </td>

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
