@extends('back.layout')
@section('content')
    <div class="container">
        <h1>liste des pages</h1>
        <button id="btn-add"><i class="fas fa-plus"></i> Ajouter une page</button>
        <table class="table" id="pages-list" name="pages-list">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
                <tr id="page-{{$page->id}}">
                    <td>{{$page->title}}</td>
                    <td>{{$page->slug}}</td>
                    <td><button class="btn-edit" data-id="{{$page->id}}"><i class="fa fa-pen" title="{{ __(" Éditer") }}"></i></button>
                        <button class="btn-suppr" data-id="{{$page->id}}"><i class="fa fa-trash" title="{{ __(" Supprimer") }}"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="formModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="formModalLabel">Creer une nouvelle page</h4>
                </div>
                <div class="modal-body">
                    <form id="myForm" name="myForm" class="form-horizontal" novalidate="">
    
                        <div class="form-group">
                            <label>Titre</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Entrer le titre"
                                value="">
                                <span class="text-danger error-text title_error"></span>
                        </div>
    
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug"
                                placeholder="Entrer le slug" value="">
                                <span class="text-danger error-text slug_error"></span>
                        </div>
                    </form>
                    
                    <div class="errors">
                        
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
                    </button>
                    <input type="hidden" id="todo_id" name="todo_id" value="0">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    
</script>
@endsection