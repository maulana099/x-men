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

        {{-- task 2 --}}
        <hr/>
        <div class="container" id="view_detail">
            {{-- detail.blade.php --}}
        </div>
        {{-- end task 2 --}}

        {{-- task 3 --}}
        <hr/>
        <div class="container">
            <form action="{{route('xmen.index')}}" method="GET">
                @csrf
                <div class="row mb-3 mt-5">
                    <div class="col-md-10">
                        <h2>Task #3 Simulasi Jika Superhero Menikah</h2>
                    </div>
                    <div class="col-md-2 mt-1">
                        <button type="submit" class="btn btn-primary">Edit</button>
                        <a href="{{ route('xmen.index')}}" class="btn btn-danger">Hapus</a>
                    </div>
                </div>

                <table class="table table-bordered " class="width:100%">
                    <tbody>
                        <tr>
                            <td>Suami</td>
                            <td>
                                <select name="suami" class="form-control">
                                    @foreach ($hero as $lk)
                                    @if ($lk->jenis_kelamin === 'Laki-Laki')
                                    <option value="{{$lk->id}}">{{$lk->nama}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Istri</td>
                            <td>
                                <select name="istri" class="form-control">
                                    @foreach ($hero as $pr)
                                    @if ($pr->jenis_kelamin === 'Perempuan')
                                    <option value="{{$pr->id}}">{{$pr->nama}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <div class="col-md-10 mt-2">
                <h4>Anaknya Kemungkinan Akan Memiliki Skill Berikut:</h4>
            </div>
            <table class="table table-bordered">
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($skill as $row )
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$row->skill}}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        {{-- end task 3 --}}

        {{-- task 4 --}}
        <hr/>
        <div class="container">
            <div class="row mb-3 mt-6">
                <div class="col-md-10">
                    <h2>Task #4 Export data Excel dan PDF</h2>
                </div>
                <div class="col-md-2 mt-1">
                    <a href="{{route('export.excel')}}" type="button" class="btn btn-primary">EXCEL</a>
                    <a href="{{ route('export.pdf') }}" type="button" class="btn btn-success">PDF</a>
                </div>
            </div>
        </div>
        {{-- end task 4 --}}

        {{-- task 5 --}}
        <hr/>
        <div class="container mt-4">
            <div class="row mb-3">
                <div class="col-md-8">
                    <h1>Task #5 Daftar Skill</h1>
                </div>
                <div class="col-md-4 mt-3">
                    <input type="text" search-skill="search" class="form-control" placeholder="Search" />
                </div>
            </div>
            <table class="table table-bordered" id="table_data_index_skill" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Skill</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <div class="container mt-4" id="view_detail_skill">

        </div>
        {{-- end task 5 --}}

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


    <script>
        $(document).ready(function() {
            let columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'skill',
                name: 'skill'
            },
            {
                data: 'actions',
                name: 'actions'
            }]
            let ajaxOptions = {
                url: `{{ route('skill.index') }}`
            }

            let columnDefs = [];
            let table;
            table = $('#table_data_index_skill').loadTable(columns, [], ajaxOptions);
            table.on('draw', function() {
                KTMenu.createInstances();
            });

            KTUtil.onDOMContentLoaded(function() {
                const filterSearch = document.querySelector('[search-skill="search"]');
                filterSearch.addEventListener('keyup', function(e) {
                    table.search(e.target.value).draw();
                });
            });

        })
    </script>
    <script src="{{ asset('public/assets/custom/main.js') }}"></script>


</body>
</html>
