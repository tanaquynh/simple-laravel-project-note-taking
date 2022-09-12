$(function () {
    const list = $.ajax({
        url: variable.route_get_notes,
        method: 'POST',
    }).done(function(data) {
        data.forEach(item => {
            $('#note-list').prepend(
               note(item)
            )
        });
    }).always(function () {
        $.unblockUI();
    });

    $(document).on('click', '.btn-note-delete', function (e) {
        e.preventDefault();

        const container = $(this).parent().parent().parent();
        $.ajax({
            method: 'DELETE',
            url: variable.route_delete_note.replace(':id', $(this).data('id')),
        }).done(function () {
            toastr.success('Note is deleted')
            container.hide()
        }).always(function () {
            $.unblockUI();
        })
    });

    $(document).on('click', '.btn-note-edit', function (e) {
        e.preventDefault();

        const card_container = $(this).parent().parent();
        $.ajax({
            method: 'GET',
            url: variable.route_note_detail.replace(':id', $(this).data('id')),
        }).done(function (data) {
            card_container.html(
                formEdit(data)
            )

            // Set event click for form edit
            $('#btn-note-save-' + data.id).click(function(e) {
                e.preventDefault();
                $.ajax({
                    method: 'PUT',
                    url: variable.route_edit_note.replace(':id', data.id),
                    data: {
                        title: $('#note-title-' + data.id).val(),
                        content: $('#note-content' + data.id).val(),
                    }
                }).done(function(data) {
                    toastr.success('Note is updated')
                    card_container.html(cardInner(data))
                }).always(function () {
                    $.unblockUI();
                })
            })
            
        }).always(function () {
            $.unblockUI();
        })

    });
    
    $('#btn-note-save').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: variable.route_create_note,
            method: 'POST',
            data: {
                title: $('#note-title').val(),
                content: $('#note-content').val(),
            }
        }).done(function (data) {
            toastr.success('Note is saved')
            $('#note-title').val('')
            $('#note-content').val('')
            $('#note-list').prepend(
                note(data)
            )
        }).always(function () {
            $.unblockUI();
        })
    });


    function note(data) {
        return '<div class="col-4">' +
        '<div class="card">' +
            cardInner(data)
        + '</div></div>'
    }

    function cardInner(data) {
        return ('<div class="card-header">' +
                '<h3 class="card-title">' + data.title + '</h3>' +
                '<div class="card-tools">' +
                '<div class="icheck-success d-inline">' +
                    '<input type="checkbox checkbox-completed">' +
                '</div> </div></div>' +
            '<div class="card-body">' +
                '<p class="text-muted">Last updated: <span>' + data.updated_at + '</span></p>' +
                '<p class="note-content">' + data.content + '</p>' +
            '</div>' +

            '<div class="card-footer">' +
                '<a class="btn btn-note-edit" data-id="' + data.id + '">' +
                    '<i class="fas fa-edit"></i>' +
                '</a>' +
                '<a class="btn btn-note-delete" data-id="' + data.id + '">' +
                    '<i class="fas fa-trash"></i>' +
                '</a>' + 
            '</div>')
    }

    function formEdit(value) {
        return ('<form id="frm-add-note-' + value.id + '">' +
            '<div class="card-body">' +
                '<div class="form-group">' +
                    '<input value="' + value.title + '" type="text" class="form-control form-control-border" id="note-title-' + value.id + '" name="title" placeholder="Note title ...">' +
                '</div>' +
                '<div class="form-group">' +
                    '<textarea value="' + value.content + '" class="form-control border-0" placeholder="Enter content ..." name="content" id="note-content-' + value.id + '">' + value.content + '</textarea>' +
                '</div>' +
            '</div>' +

            '<div class="card-footer">' +
                '<a class="btn" id="btn-note-save-' + value.id + '">' +
                    '<i class="fas fa-save"></i>' +
                '</a>' +
            '</div>' +
        '</form>')
    }
})
