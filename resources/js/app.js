require('./bootstrap');


$(document).ready(function() {

    $('#sidebarCollapse').on('click', function() {
        $('#sidebar, #content').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
});

$(document).on('click', '.ajax_load', function(evt) {
    if ($(this).is('a') || $(this).is('input[type="submit"]') || $(this).is('button[type="submit"]')) {
        evt.preventDefault();
    }
    var that = this;
    if ($(that).hasClass('disabled')) {
        return false;
    }
    if ($(that).data('beforeload')) {
        eval($(that).data('beforeload'));
    }
    $.get($(that).attr('href'), function(data) {
        if (data.callback) {
            eval(data.callback);
            if ($(that).data('afterload')) {
                eval($(that).data('afterload'));
            }
            return;
        }
        if ($(that).data('afterload')) {
            eval($(that).data('afterload'));
        }
        $('body').append(data);
    });
    if ($(this).is('a') || $(this).is('input[type="submit"]') || $(this).is('button[type="submit"]')) {
        return false;
    }
});

$(document).on('click', '.ajax_post', function(evt) {
    evt.preventDefault();
    if ($(this).hasClass('disabled')) {
        return false;
    }
    if ($(this).data('beforeload')) {
        eval($(this).data('beforeload'));
    }
    var post = JSON.parse($(this).data('post').replace(/'/g, '"'));
    $.each(post, function(k, v) {
        try {
            post[k] = window[v]();
        } catch (e) {}
    });
    post._token = $('meta[name="csrf-token"]').attr('content');
    $.post($(this).attr('href'), post, function(data) {
        if (data.callback) { eval(data.callback); return; }
        $('body').append(data);
    });
    return false;
});


$(document).on('click', '.drop-toggle', function(evt) {
    evt.preventDefault();
    $($(this).parents('.drop')[0]).toggleClass('dropped');
    return false;
});

$(document).on('submit', '.ajax-form', function(evt) {
    evt.preventDefault();
    var that = this;

    if ($(that).data('beforepost')) {
        eval($(that).data('beforepost'));
    }

    var post = new FormData(that);
    $(that).find('input, select, textarea, button').each(function() {
        if (!$(this).is(':disabled')) {
            $(this).addClass('auto-enable');
        }
        $(this).prop('disabled', true).removeClass('is-invalid').parent().find('.invalid-feedback').remove();
    });
    var url = $(that).prop('action');
    var method = $(that).data('method') ? $(that).data('method') : $(that).prop('method');
    if (method.toLowerCase() !== 'post') {
        url += '?' + new URLSearchParams(post).toString();
        post = null;
    }
    $.ajax({
        url: url,
        type: method,
        data: post,
        processData: false,
        contentType: false,
        complete: function(xhr, status) {
            $(that).find('input.auto-enable:not(.locked), select.auto-enable:not(.locked), textarea.auto-enable:not(.locked), button.auto-enable:not(.locked)').prop('disabled', false).removeClass('auto-enable');
            $(that).trigger('submit-complete');
        },
        success: function(data, status, xhr) {
            if ( /*data.success && */ data.callback) {
                eval(data.callback);
            }
        },
        error: function(xhr, status, error) {
            if (xhr.status === 403) {
                document.location.reload();
            } else if (xhr.status === 422) {
                /**
                 * Problème de validateur
                 */
                if (xhr.responseJSON !== undefined) {
                    var json = xhr.responseJSON;
                    for (var i in json.errors) {
                        var target = $('#' + i.replace(/\./g, '-'));
                        if (target.length === 0) {
                            target = $(that).find('[name="' + i.replace(/\./g, '-') + '"]');
                        }
                        if (target.data("message") !== undefined) {
                            target = $(target.data("message"));
                        }
                        target.addClass('is-invalid').parent().append('<div class="invalid-feedback">' + json.errors[i].join('<br>') + '</div>');
                    }
                }
            }
        }
    });
    return false;
});