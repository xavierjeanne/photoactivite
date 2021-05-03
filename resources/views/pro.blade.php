@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center main-header">
        <div class="col-12">
            <h1>Photo et activités agréables adaptées à des usages professionnel</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 mb-5">
            <div class="card">
                <div class="card-header">
                    <h2>Professionnel cognitif</h2>
                </div>
                <div class="card-body">
                    <p>Matériel de réhabilitation cognitive,de mobilisation et de réédeuction.</p>
                    <p>Photos appaisantes et favorisant les émotions positives.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-5">
            <div class="card">
                <div class="card-header">
                    <h2>Professionnel de l'animation</h2>
                </div>
                <div class="card-body">
                    <p>Photos variées et à thèmes.</p>
                    <p>Echanges entre générations et jeux.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-5">
            <div class="card">
                <div class="card-header">
                    <h2>Professionnel de la relaxation</h2>
                </div>
                <div class="card-body">
                    <p>Photos appaisantes, amusantes, favorisant les émotions positives.</p>
                    <p>Jeux pour détourner l'attention.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-5">
            <div class="card">
                <div class="card-header">
                    <h2>Professionnel de l'enseignement</h2>
                </div>
                <div class="card-body">
                    <p>Découvrir le monde, travailler sa culture générale.</p>
                    <p>Jeux éducatifs</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <h3>Tarif Mensuel</h3>
            <p>Prix : 10 € / mois</p>
        </div>
        <div class="col-4">
            <h3>Tarif Trimestriel</h3>
            <p>Prix : 25 € / trimestre</p>
        </div>
        <div class="col-4">
            <h3>Tarif Annuel</h3>
            <p>Prix : 80€ / an</p>
        </div>
    </div>
    <div class="row">
        <a href="/licence" class="btn btn-primary">S'abonner</a>
    </div>
@endsection