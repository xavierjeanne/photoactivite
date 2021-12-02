@extends('back.layout')
@section('content')
<div class="container">
    <h1>liste des categories</h1>
    <button id="btn-add"><i class="fas fa-plus"></i> Ajouter une category</button>
    <table class="table" id="categories-list" name="categories-list">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr id="category-{{$category->id}}">
                <td>{{$category->name}}</td>
                <td>{{$category->code}}</td>
                <td><button class="btn-edit" data-id="{{$category->id}}"><i class="fa fa-pen" title="{{ __(" Éditer")
                            }}"></i></button>
                    <button class="btn-suppr" data-id="{{$category->id}}"><i class="fa fa-trash" title="{{ __(" Supprimer")
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
                <h4 class="modal-title" id="formModalLabel">Creer une nouvelle categorie</h4>
            </div>
            <div class="modal-body">
                <form id="myForm" name="myForm" class="form-horizontal" novalidate="">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Entrer le nom"
                            value="">
                        <span class="text-danger error-text name_error"></span>
                    </div>

                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Entrer le code"
                            value="">
                        <span class="text-danger error-text code_error"></span>
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
   
    /*** GESTION DES categories ***/
    
    //----- Open model CREATE -----//
    jQuery('#btn-add').click(function() {
        jQuery('#btn-save').val("add");
        jQuery('#myForm').trigger("reset");
        jQuery('#formModalLabel').text('Créer une nouvelle categorie');
        jQuery('#formModal').modal('show');
    });
    // open modal for edit category //
    jQuery('.btn-edit').click(function() {
        var id = $(this).data('id');
        jQuery('#myForm').trigger("reset");
        jQuery('#formModalLabel').text('Editer la category');
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
                jQuery('#formModal input[name="code"]').val(data.code);
                jQuery('#formModal input[name="name"]').val(data.name);
                jQuery('#formModal').modal('show');
            }
        });
    });
    //delete alert danger
    $("#formModal input").focus(function() {
        $(".text-danger").html('');
    });
     // CREATE category
    $("#btn-save").click(function(e) {
        $.ajaxSetup({ 
            headers: { 'X-CSRF-TOKEN' : jQuery('meta[name="csrf-token"]').attr('content') 
            } 
        }); 
        e.preventDefault(); 
        var formData={ 
            name: jQuery('#name').val(), 
            code: jQuery('#code').val(), 
            id: jQuery('#id').val(), 
        }; 
        var state=jQuery('#btn-save').val(); 
        var type="POST" ; 
        var category_id=jQuery('#category-id').val(); 
        var ajaxurl='new' ; 
        $.ajax({ 
            type: type, 
            url: ajaxurl, 
            data: formData,
            dataType: 'json' , 
            success: function(data) { 
                var category='<tr id="category-' + data.id + '"><td>' + data.name + '</td><td>' + data.code + '</td><td><button class="btn-edit" data-id="' + data.id + '"><i class="fa fa-pen" title="{{ __(" Éditer") }}"></i></button><button class="btn-suppr" data-id="' + data.id + '"><i class="fa fa-trash" title="{{ __(" Supprimer") }}"></i></button></td></tr>' ; 
                if (state=="add" ){ 
                    jQuery('#categories-list').append(category); 
                } 
                else { 
                    jQuery("#category" + category_id).replaceWith(category); 
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
                console.log(key);
                    $('.' + key + '_error' ).append('<div class="alert alert-danger">' + value + '</div');
                }); 
            } 
        });
     }); 
     //DELETE 
     $('.btn-suppr').click(function() { 
        var id=($(this).data('id')); 
        var confirmation=confirm("Etes vous sur de vouloir effacer cette category?"); 
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
                    $("#categories-list tr#category-" + id).remove(); 
                    location.reload(true); 
                }, 
                error: function(xhr) {
                     } 
            }); 
        } 
    });

</script>
@endsection