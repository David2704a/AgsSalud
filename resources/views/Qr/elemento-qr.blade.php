@extends('Qr.plantilla')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card" style="width: 18rem;">
                <img src="{{ $elemento->codigo }}" class="card-img-top" alt="QRCode">
                <div class="card-body">
                    <h5 class="card-title">{{ $elemento->id_dispo }}</h5>
                    <p class="card-text">{{ $elemento->nombre }}</p>
                    <p class="card-text">{{ $elemento->referencia }}</p>
                    <p class="card-text">{{ $elemento->name }}</p>
                    <p class="card-text">{{ $elemento->identificacion }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
