@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($homeContents as $content)
    <div class="row justify-content-center main-header">
        <div class="col-12">
            <h1>@if($content['bloc_name']==='slogan'){{$content['content']}} @endif</h1>
        </div>
    </div>
    @endforeach
    @foreach ($homeContents as $content)
    <div class="row justify-content-center description">
        <div class="col-12">
            @if($content['bloc_name']==='primary_block'){{$content['content']}} @endif
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Usage personnel</h2> 
                </div>
                <div class="card-body">
                    <p>Activités enfant</p>
                    <p>Activités adulte</p>
                    <a href="{{ url('/perso') }}" class="btn btn-primary">Découvrir</a>
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
                <a href="{{ url('/pro') }}" class="btn btn-primary">Découvrir</a>
            </div>
        </div></div>
    </div>
</div>
@endsection
