@extends('layouts.modal')
@section('before')
<form method="delete" data-method="delete" action="{{ route("admin.page.delete", ['id' => $page->id]) }}"
    class="container ajax-form">
    @csrf
    @endsection
    @section('id', 'modalDeletePage')
    @section('dialog-class', 'modal-md')
    @section('label', 'modalDeletePageLabel')
    @section('title', __("Suppression de :name", ['name' => $page->title]))
    @section('content')
    <div class="col-12 text-center">
        <p><i class="fa fa-3x fa-exclamation-triangle text-danger"></i></p>
        <p>Cette opération est irréversible.</p>
        <p>Continuer ?</p>
    </div>
    @endsection
    @section('footer')
    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Annuler") }}</button>
    <button type="submit" class="btn btn-danger">{{ __("Confirmer") }}</button>
    @endsection
    @section('after')
</form>
@endsection