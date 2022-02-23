@extends('back.layout')
@section('content')
<div class="container">
    @if(session()->has('info'))
    <div class="notification is-success">
        {{ session('info') }}
    </div>
    @endif
    <h1>liste des photos</h1>
    <form method="POST" enctype="multipart/form-data" id="upload_image_form" action="javascript:void(0)">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="file" name="photos[]" placeholder="Choose image" id="photo" multiple>
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                </div>
            </div>
        
        
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <select onchange="window.location.href = this.value">
        <option value="{{ route('admin.photo.list') }}" @unless($name) selected @endunless>Toutes catégories</option>
        @foreach($categories as $category)
        <option value="{{ route('admin.photo.category', $category->name) }}" {{ $name==$category->name ? 'selected' : '' }}>{{
            $category->name }}</option>
        @endforeach
    </select>
    <table class="table" id="photos-list" name="photos-list">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Catégories</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($photos as $photo)
            <tr id="photo-{{$photo->id}}">
                <td><img src="{{ asset('/images/photos/'.$photo->name.$photo->extension)}}" alt="" width="150"></td>
                <td>
                    <ul>
                    @foreach  ($photo->categories as $cat)
                        <li>{{$cat->name}}</li>
                    @endforeach
                    </ul>
                </td>
                <td><button class="btn-edit" data-id="{{$photo->id}}"><i class="fa fa-pen" title="{{ __(" Éditer")
                            }}"></i></button>
                    
                </td>
                <td><form action="{{ route('admin.photo.delete', $photo->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="button is-danger" type="submit">Supprimer</button>
                </form></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
    /*** GESTION DES photos ***/
    $(document).ready(function (e) {
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#upload_image_form').submit(function(e) {
        
            e.preventDefault();
            var formData = new FormData(this);
        
            $.ajax({
                type:'POST',
                url: 'new',
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                /*success: (data) => {
                    this.reset();
                    alert('Image has been uploaded successfully');
                },
                error: function(data){
                    console.log(data);
                }*/
            });
        });
    });
    //----- Open model CREATE -----//
   
     // CREATE photo
    $("upload_image_form").submit(function(e) {
        $.ajaxSetup({ 
            headers: { 'X-CSRF-TOKEN' : jQuery('meta[name="csrf-token"]').attr('content') 
            } 
        }); 
        e.preventDefault(); 
        var formData = new FormData(this);
        var type="POST" ; 
        var photo_id=jQuery('#photo-id').val(); 
        var ajaxurl='new' ; 
        
        $.ajax({ 
            type: type, 
            url: ajaxurl,
            data: formData, 
            cache:false,
            contentType: false,
            processData: false,
            success: function(data) { 
                var photo='<tr id="photo-' + data.id + '"><td>' + data.name + '</td><td>' + data.categories + '</td><td><button class="btn-edit" data-id="' + data.id + '"><i class="fa fa-pen" title="{{ __(" Éditer") }}"></i></button><button class="btn-suppr" data-id="' + data.id + '"><i class="fa fa-trash" title="{{ __(" Supprimer") }}"></i></button></td></tr>' ; 
                if (state=="add" ){ 
                    jQuery('#photos-list').append(photo); 
                } 
                else { 
                    jQuery("#photo" + photo_id).replaceWith(photo); 
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
        var confirmation=confirm("Etes vous sur de vouloir effacer cette photo?"); 
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
                    $("#photos-list tr#photo-" + id).remove(); 
                    location.reload(true); 
                }, 
                error: function(xhr) {
                     } 
            }); 
        } 
    });

</script>
@endsection