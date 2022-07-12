<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>XMEN - SUPERHERO</title>

    <link rel="canonical" href="">

    <link href="{{ asset('public/assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/assets/custom/style.css')}}" rel="stylesheet">

</head>
<body class="py-4">
    <main>
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-8">
                    <h1>Task #1 Daftar Superhero</h1>
                </div>
                <div class="col-md-4 mt-3">
                    <input type="text" search-superhero="search" class="form-control" placeholder="Search" />
                </div>
            </div>
            <table class="table table-bordered" id="table_data_index" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </main>

    <script src="{{ asset('public/assets/custom/plugins/plugins.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/custom/scripts.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/custom/datatables/datatables.bundle.js') }}"></script>


    <script>
        $(document).ready(function() {
            let columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'jenis_kelamin',
                name: 'jenis_kelamin'
            },
            {
                data: 'actions',
                name: 'actions'
            }]
            let ajaxOptions = {
                url: `{{ $url }}`
            }

            let columnDefs = [];
            let table;
            table = $('#table_data_index').loadTable(columns, [], ajaxOptions);
            table.on('draw', function() {
                KTMenu.createInstances();
            });

            KTUtil.onDOMContentLoaded(function() {
                const filterSearch = document.querySelector('[search-superhero="search"]');
                filterSearch.addEventListener('keyup', function(e) {
                    table.search(e.target.value).draw();
                });
            });

        })
    </script>

    <script src="{{ asset('public/assets/custom/main.js') }}"></script>

</body>
</html>
