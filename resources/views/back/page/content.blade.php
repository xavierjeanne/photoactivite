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
    jQuery(document).ready(function($) {
    
    /*** GESTION DES PAGES ***/
    
    //----- Open model CREATE -----//
    jQuery('#btn-add-bloc').click(function() {
        jQuery('#btn-save-bloc').val("add");
        jQuery('#myForm').trigger("reset");
        jQuery('#formModalLabel').text('Créer un nouveau bloc');
        jQuery('#formModal').modal('show');
    });
    // open modal for edit page //
    jQuery('.btn-edit-bloc').click(function() {
        var id = $(this).data('id');
        jQuery('#myForm').trigger("reset");
        jQuery('#formModalLabel').text('Editer le bloc');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: 'content/edit/' + id,
            dataType: 'json',
            success: function(data) {
                $("<input type='hidden' id='bloc_id' value='" + data.id + "' />").attr("name", "bloc_id").appendTo("#myForm");
                jQuery('#formModal input[name="bloc_name"]').val(data.bloc_name);
                jQuery('#formModal textarea').text(data.content);
                jQuery('#formModal input[name="page_id"]').val(data.page_id);
                jQuery('#formModal').modal('show');
            }
        });
    });
    //delete alert danger
    $("#formModal input").focus(function() {
        $(".text-danger").html('');
    });
    //Create bloc
    $("#btn-save-bloc").click(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            bloc_name: jQuery('#bloc_name').val(),
            content: jQuery('#content_bloc').val(),
            page_id: jQuery('#page_id').val(),
            bloc_id: jQuery('#bloc_id').val(),
        };
        var state = jQuery('#btn-save-bloc').val();
        var type = "POST";
        // var bloc_id = jQuery("bloc_id").val();
        var ajaxurl = 'content/new';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
        success: function(data) {
            var bloc = '<tr id="bloc-' + data.id + '"><td>' + data.bloc_name + '</td><td>' + data.content + '</td><td><button class="btn-edit-bloc" data-id="' + data.id + '"><i class="fa fa-pen" title="{{ __(" Éditer") }}"></i></button><button class="btn-suppr-bloc" data-id="' + data.id + '"><i class="fa fa-trash" title="{{ __(" Supprimer") }}"></i></button></td></tr>';
            if (state == "add") {
                jQuery('#blocs-list').append(bloc);
            } 
            else {
                jQuery("#bloc" + data.id).replaceWith(bloc);
            }
            jQuery('#myForm').trigger("reset");
            $(".text-danger").html('');
            jQuery('#formModal').modal('hide');
            location.reload(true);
        },
        error: function(xhr) {
            $('.error').html('');
            $.each(xhr.responseJSON.errors, function(key, value) {
                $('.' + key + '_error').append('<div class="alert alert-danger">' + value + '</div');
                }); 
            } 
        }); 
    }); 
     //DELETE 
    $('.btn-suppr-bloc').click(function() { 
        var id=($(this).data('id')); 
        var confirmation=confirm("Etes vous sur de vouloir effacer ce bloc?"); 
        if (confirmation) { 
            $.ajaxSetup({ 
                headers: { 
                    'X-CSRF-TOKEN' : jQuery('meta[name="csrf-token" ]').attr('content') 
                } 
            }); 
            var type="DELETE" ; 
            var ajaxurl='delete/content/' + id;
            $.ajax({ 
                type: type, 
                url: ajaxurl, 
                dataType: 'json' , 
                success: function() { 
                    $("#blocs-list tr#bloc-" + id).remove();
                     location.reload(true);
                }, 
                error: function(xhr) { 
                } 
            }); 
        } 
    }); /** FIN GESTION DES PAGES **/ });
</script>
@endsection