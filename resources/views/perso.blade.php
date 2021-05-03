@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center main-header">
        <div class="col-12">
            <h1>Photo et activités agréables adaptées à des usages personnel</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 mb-5">
            <div class="card">
                <div class="card-header">
                    <h2>Public adulte</h2>
                </div>
                <div class="card-body">
                    <p>Activités pour des personnes ayant des difficultés cognitives ou des besoins de stimulations cérébrales.</p>
                    <p>Relaxation en cas de stress ou d'anxiété.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-5">
            <div class="card">
                <div class="card-header">
                    <h2>Public enfant ou adolescent</h2>
                </div>
                <div class="card-body">
                    <p>Photos selon les centres d'intérêt et variés.</p>
                    <p>Jeux pour détourner l'attention.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <h3>Tarif Mensuel</h3>
            <p>Prix : 5 € / mois</p>
        </div>
        <div class="col-4">
            <h3>Tarif Trimestriel</h3>
            <p>Prix : 10 € / trimestre</p>
        </div>
        <div class="col-4">
            <h3>Tarif Annuel</h3>
            <p>Prix : 30€ / an</p>
        </div>
    </div>
    <div class="row">
        <a href="/licence" class="btn btn-primary">S'abonner</a>
    </div>
</div>
@endsection