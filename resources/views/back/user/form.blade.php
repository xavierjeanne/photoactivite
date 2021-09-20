@extends('back.layout')
@section('content')
@if(!empty($successMsg))
    <div class="alert alert-success"> {{ $successMsg }}</div>
@endif
    <form method="post" action="{{ route("admin.user.save") }}" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="form-group">
            <label for="name">{{ __("Nom") }}</label>
            <div class="input-group">
                <input id="name" type="text" class="form-control input-name" name="name" value="{{ $user->name }}">
            </div>
        </div>
        <div class="form-group">
            <label for="lastmane">{{ __("Prénom") }}</label>
            <div class="input-group">
                <input id="lastname" type="text" class="form-control input-lastname" name="lastname" value="{{ $user->lastname }}">
            </div>
        </div>
        <div class="form-group">
            <label for="email">{{ __("Email") }}</label>
            <div class="input-group">
                <input id="email" type="email" class="form-control input-email" name="email" value="{{ $user->email }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ __("Enregistrer") }}</button>
    </form>
@endsection