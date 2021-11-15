@extends('back.layout')
@section('content')
    <div class="container">
        <h1>Listes des pages</h1>
        <a class="btn btn-success" href="javascript:void(0)" id="createNewPage"> Ajouter une page</a>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="pageForm" name="pageForm" class="form-horizontal">
                    <input type="hidden" name="page_id" id="page_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nom</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Entrer le titre"
                                value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Slug</label>
                        <div class="col-sm-12">
                            <textarea id="slug" name="slug" required="" placeholder="Entrer le slug"
                                class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="enregistrer">Enregistrer la page
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(function () {
     
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('pages.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'slug', name: 'slug'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
     
    $('#createNewPage').click(function () {
        $('#saveBtn').val("create-page");
        $('#page_id').val('');
        $('#pageForm').trigger("reset");
        $('#modelHeading').html("Créer une nouvelle page");
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.editPage', function () {
      var page_id = $(this).data('id');
      $.get("{{ route('pages.index') }}" +'/' + page_id +'/edit', function (data) {
          $('#modelHeading').html("Editer la page");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#page_id').val(data.id);
          $('#title').val(data.name);
          $('#slug').val(data.detail);
      })
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Enregistrer..');
    
        $.ajax({
          data: $('#pageForm').serialize(),
          url: "{{ route('pages.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#pageForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Enregistrer les changements');
          }
      });
    });
    
    $('body').on('click', '.deletePage', function () {
     
        var page_id = $(this).data("id");
        confirm("êtes vous sur de vouloir effacer ccette page !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('pages.store') }}"+'/'+page_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
     
  });
</script>
@endsection