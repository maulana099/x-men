

$.fn.loadTable = function (columns = [], columnDefs = [], ajaxOptions = {}, options = {}) {
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
        ...options
    })


}
