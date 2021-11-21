require('./bootstrap');
$(document).ready(function() {

    $('#sidebarCollapse').on('click', function() {
        $('#sidebar, #content').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
});

jQuery(document).ready(function($) {

    //----- Open model CREATE -----//
    jQuery('#btn-add').click(function() {
        jQuery('#btn-save').val("add");
        jQuery('#myForm').trigger("reset");
        jQuery('#formModalLabel').text('Créer une nouvelle page');
        jQuery('#formModal').modal('show');
    });
    jQuery('.btn-details').click(function() {
        jQuery('#myFormBlock #btn-save').val("add");
        jQuery('#myFormBlock').trigger("reset");
        jQuery('#formModalBlockLabel').text('Créer un nouvelle block');
        jQuery('#formModalBlock').modal('show');
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
    // CREATE
    $("#btn-save").click(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            title: jQuery('#title').val(),
            slug: jQuery('#slug').val(),
            id: jQuery('#id').val(),
        };
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var page_id = jQuery('#page-id').val();
        var ajaxurl = 'new';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function(data) {
                var page = '<tr id="page-' + data.id + '"><td>' + data.title + '</td><td>' + data.slug + '</td><td><button class="btn-edit" data-id="' + data.id + '"><i class="fa fa-pen" title="{{ __(" Éditer") }}"></i></button><button class="btn-suppr" data-id="' + data.id + '"><i class="fa fa-trash" title="{{ __(" Supprimer") }}"></i></button></td></tr>';
                if (state == "add") {
                    jQuery('#pages-list').append(page);
                } else {
                    jQuery("#page" + page_id).replaceWith(page);
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
    $('.btn-suppr').click(function() {

        var id = ($(this).data('id'));
        var confirmation = confirm("Etes vous sur de vouloir effacer cette page?");

        if (confirmation) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var type = "DELETE";
            var ajaxurl = 'delete/' + id;
            $.ajax({
                type: type,
                url: ajaxurl,
                dataType: 'json',
                success: function() {
                    $("#pages-list tr#page-" + id).remove();
                },
                error: function(xhr) {

                }
            });
        }
    });
});