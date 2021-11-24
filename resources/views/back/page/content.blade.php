@extends('back.layout')
@section('content')
<div class="container">
    <h1>Contentu de la page {{$page->title}}</h1>
    <button id="btn-add-bloc"><i class="fas fa-plus"></i> Ajouter un bloc</button>
    <table class="table" id="blocks-list" name="blocks-list">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Contenu</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contents as $content)
            <tr id="block-{{$content->id}}">
                <td>{{$content->bloc_name}}</td>
                <td>{{$content->content}}</td>
                <td><button class="btn-edit-bloc" data-id="{{$content->id}}"><i class="fa fa-pen" title="{{ __(" Éditer")
                            }}"></i></button>
                    <button class="btn-suppr-bloc" data-id="{{$content->id}}"><i class="fa fa-trash" title="{{ __(" Supprimer")
                            }}"></i></button>
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
                <h4 class="modal-title" id="formModalLabel">Creer un nouveau bloc</h4>
            </div>
            <div class="modal-body">
                <form id="myForm" name="myForm" class="form-horizontal" novalidate="">
                    <div class="form-group">
                        <label>Nom du bloc</label>
                        <input type="text" class="form-control" id="bloc_name" name="bloc_name" placeholder="Entrer le nom" value=""/>
                        <span class="text-danger error-text bloc_name_error"></span>
                    </div>

                    <div class="form-group">
                        <label>Contenu</label>
                        <textarea  class="form-control" id="content_bloc" name="content">
                        </textarea>
                        <span class="text-danger error-text content_error"></span>
                    </div>
                <input type="hidden" id="page_id" name="page_id" value={{$page->id}}>
                </form>
                <div class="errors">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save-bloc" value="">Enregistrer
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection