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
                        <button class="btn-details"><a href="{{route('admin.page.list.content',['id'=>$page->id])}}"><i class="fas fa-align-justify" title="{{ __(" Détail") }}"></i></a></button>
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
                                placeholder="Entrer le slug"  value="" >
                                <span class="text-danger error-text slug_error"></span>
                        </div>
                    </form>
                    
                    <div class="errors">
                        
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="">Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
<script type="text/javascript">
   
    
    /*** GESTION DES PAGES ***/
    
    //----- Open model CREATE -----//
    jQuery('#btn-add').click(function() {
        jQuery('#btn-save').val("add");
        jQuery('#myForm').trigger("reset");
        jQuery('#formModalLabel').text('Créer une nouvelle page');
        jQuery('#formModal').modal('show');
    });
    // open modal for edit page //
    jQuery('.btn-edit').click(function() {
        var id = $(this).data('id');
        jQuery('#myForm').trigger("reset");
        jQuery('#formModalLabel').text('Editer la page');
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: 'edit/' + id,
            dataType: 'json',
            success: function(data) {
                $("<input type='hidden' id='id' value='" + data.id + "' />").attr("name", "id").appendTo("#myForm");
                jQuery('#formModal input[name="slug"]').val(data.slug);
                jQuery('#formModal input[name="title"]').val(data.title);
                jQuery('#formModal').modal('show');
            }
        });
    });
    //delete alert danger
    $("#formModal input").focus(function() {
        $(".text-danger").html('');
    });
     // CREATE page
    $("#btn-save").click(function(e) {
        $.ajaxSetup({ 
            headers: { 'X-CSRF-TOKEN' : jQuery('meta[name="csrf-token"]').attr('content') 
            } 
        }); 
        e.preventDefault(); 
        var formData={ 
            title: jQuery('#title').val(), 
            slug: jQuery('#slug').val(), 
            id: jQuery('#id').val(), 
        }; 
        var state=jQuery('#btn-save').val(); 
        var type="POST" ; 
        var page_id=jQuery('#page-id').val(); 
        var ajaxurl='new' ; 
        $.ajax({ 
            type: type, 
            url: ajaxurl, 
            data: formData,
            dataType: 'json' , 
            success: function(data) { 
                var page='<tr id="page-' + data.id + '"><td>' + data.title + '</td><td>' + data.slug + '</td><td><button class="btn-edit" data-id="' + data.id + '"><i class="fa fa-pen" title="{{ __(" Éditer") }}"></i></button><button class="btn-suppr" data-id="' + data.id + '"><i class="fa fa-trash" title="{{ __(" Supprimer") }}"></i></button></td></tr>' ; 
                if (state=="add" ){ 
                    jQuery('#pages-list').append(page); 
                } 
                else { 
                    jQuery("#page" + page_id).replaceWith(page); 
                }
                jQuery('#myForm').trigger("reset"); 
                $(".text-danger").html(''); 
                jQuery('#formModal').modal('hide');
                location.reload(true); 
            }, 
            error: function(xhr) { 
                $('.error').html(''); 
                $.each(xhr.responseJSON.errors,
                function(key, value) { 
                    $('.' + key + '_error' ).append('<div class="alert alert-danger">' + value + '</div');
                }); 
            } 
        });
     }); 
     //DELETE 
     $('.btn-suppr').click(function() { 
        var id=($(this).data('id')); 
        var confirmation=confirm("Etes vous sur de vouloir effacer cette page?"); 
        if (confirmation) { 
            $.ajaxSetup({ 
                headers:{ 'X-CSRF-TOKEN' : jQuery('meta[name="csrf-token" ]').attr('content') } 
            }); 
            var type="DELETE" ; 
            var ajaxurl='delete/' + id; 
            $.ajax({ 
                type: type, 
                url: ajaxurl, 
                dataType: 'json' , 
                success: function() {
                    $("#pages-list tr#page-" + id).remove(); 
                    location.reload(true); 
                }, 
                error: function(xhr) {
                     } 
            }); 
        } 
    });

</script>
@endsection