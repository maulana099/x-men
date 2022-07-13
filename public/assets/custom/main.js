

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


$.fn.deleteDataPost = function () {
    this.on('click', function (e) {
        let type = $(this).data('type');
        let url = $(this).data('url');
        let id = $(this).data('id');
        let _ = $(this);

        Swal.fire({
            icon: 'warning',
            title: _.data('message') || 'Anda yakin akan menghapus Data?',
            showCancelButton: true,
            confirmButtonText: `Ya`,
        }).then(({ isConfirmed }) => {
            if (isConfirmed) {
                loadingAlert();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        id: id,
                        _method: 'DELETE',
                    },
                    success: function () {
                        Swal.fire({
                            icon: 'success',
                            text: 'It was succesfully deleted',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            confirmButtonText: `Ya`,
                        }).then(({ isConfirmed }) => {
                            if (isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: `Please try again`
                        });
                    }
                });
            }
        });
    })
}
