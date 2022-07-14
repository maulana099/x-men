

$.fn.loadTable = function (columns = [], columnDefs = [], ajaxOptions = {}, callbacks, options = {}) {
    return this.DataTable({
        pageLength: 10,
        ajax: ajaxOptions,
        processing: true,
        columns: columns,
        columnDefs: columnDefs,
        // dom: 'Bfrtip',
        // buttons: buttons,
        paging: false,
        ordering: false,
        info: false,
        fnDrawCallback: callbacks,
        ...options
    })

}


$('body').on('click', '.btn-delete', function (event) {
    event.preventDefault();

    var me = $(this),
    url = me.attr('href'),
    csrf_token = $('meta[name="csrf-token"]').attr('content');


    $.ajax({
        url: url,
        type: "POST",
        data: {
            '_method': 'DELETE',
            '_token': csrf_token
        },
        success: function (response) {
            $('#table_data_index').DataTable().ajax.reload();

        },
    });

});


$('body').on('click', '.btn-show', function(e){
    e.preventDefault()

    var me = $(this),
    url = me.attr('href')

    $.ajax({
        url: url,
        method: 'GET',
        dataType : 'html',
        success : function (response){
            $('#view_detail').html(response);
        }
    })
});

$('#btn-save').click(function (event) {
    event.preventDefault();

    var form = $('#modal-body form'),
        url = form.attr('action');

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    $.ajax({
        url : url,
        type: 'POST',
        data : form.serialize(),
        success: function (response) {
            window.location.reload();
        },
    })
});

$('body').on('click', '.btn-show-skill', function(e){
    // console.log('test')
    e.preventDefault()

    var me = $(this),
    url = me.attr('href')

    $.ajax({
        url: url,
        method: 'GET',
        dataType : 'html',
        success : function (response){
            $('#view_detail_skill').html(response);
        }
    })
});

