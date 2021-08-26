@extends('layouts.app')

@section('content')
<div class="container">
    {{dd($homeContents)}}
    <div class="row justify-content-center main-header">
        <div class="col-12">
            <h1>Photo et activités agréables adaptées à des usages professionnel et personnel</h1>
        </div>
    </div>
    <div class="row justify-content-center description">
        <div class="col-12">
            <p>Les activités qui vous proposées ont été crées par un un Neuropsychologue et un Développeur web.</p>
            <p>7000 photos permettent de vous proposer des activités agréables adaptées à vos besoins et à votre âge pour un usage privé ou professionnel.</p>
            <ul>  
                <li>Personnes ayant des difficukltés cognitives (difficultés de mémoires, de langage, de contrentration ...)</li>
                <li>Stimulation des capacitées cognitives</li>
                <li>Relaxation (stress, manifestations anxieuses ...)</li>
                <li>Favoriser en groupe les échanges et la conviivalités.</li>
                <li>Découverte du monde (imagiers pour enfants et adolescents)</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Usage personnel</h2> 
                </div>
                <div class="card-body">
                    <p>Activités enfant</p>
                    <p>Activités adulte</p>
                    <a href="/perso" class="btn btn-primary">Découvrir</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h2>Usage professionnel</h2>
            </div>
            <div class="card-body">
                <p>Cognitif</p>
                <p>AnimatioN</p>
                <p>Relaxation</p>
                <p>Enseignement</p>
                <a href="/pro" class="btn btn-primary">Découvrir</a>
            </div>
        </div></div>
    </div>
</div>
@endsection
