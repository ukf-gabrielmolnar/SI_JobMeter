@extends('layouts.main')
@section('content')

    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successPopup" name="successPopup">
        <p id="popupText"></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <h1>Dashboard</h1>

    <script>
        window.onload = function (){
            var json = @json($popupMessage);
            var popupText = $('#popupText');
            var popup = $('#successPopup');
            document.getElementById('successPopup').style.display = 'none';

            if (json != ''){

                popupText.empty();
                switch (json){
                    case "successPraxReg":
                        document.getElementById('successPopup').style.display = 'block';
                        popupText.append('Registrácia na prax bol <strong>úspešný</strong>');
                        break;
                }

                popup.alert();
            }

        }
    </script>

@endsection
