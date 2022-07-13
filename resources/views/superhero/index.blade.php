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
        <div class="container">
            <form action="{{route('xmen.update', $detail->id)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row mb-3 mt-5">
                    <div class="col-md-11">
                        <h2>Task #2 Detail Superhero: {{$detail->nama}}</h2>
                    </div>
                    <div class="col-md-1 mt-1">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
                @if(session()->get('success-hero'))
                <div class="alert alert-success">
                    {{ session()->get('success-hero') }}
                </div>
                <br />
                @endif
                <table class="table table-bordered " class="width:100%">
                    <tbody>
                        <tr>
                            <td>ID</td>
                            <td>{{$detail->id}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>
                                <input  name="nama" class="form-control" value="{{$detail->nama}}">
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>
                                <select name="jenis_kelamin" class="form-control">
                                    <option @if(old('jenis_kelamin')=='Laki-Laki' or $detail->jenis_kelamin=='Laki-Laki') selected @endif value="Laki-Laki">Laki-Laki</option>
                                    <option @if(old('jenis_kelamin')=='Perempuan' or $detail->jenis_kelamin=='Perempuan') selected @endif value="Perempuan">Perempuan</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <table class="table table-bordered">
                @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                    @elseif (session()->get('delete-skill'))
                    <div class="alert alert-success">
                        {{ session()->get('delete-skill') }}
                    </div>
                    <br />
                </div>
                @endif
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Skill</th>
                        <th>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSkilModal">
                                Tambah Skill
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($detail->skill as $row)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$row->skill}}</td>
                        <td>
                            <form action="{{ route('skill.destroy', $row->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addSkilModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Skill</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('skill.store')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Skill</label>
                                <input type="text" name="skill" class="form-control" id="" placeholder="Bisa Mengendalikan Angin dan Badai">
                                <input type="hidden" name="superhero_id" class="form-control" id="" placeholder="test" value="{{$detail->id}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="sumbit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end task 2 --}}

        {{-- task 3 --}}
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
            @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
                @elseif (session()->get('delete-skill'))
                <div class="alert alert-success">
                    {{ session()->get('delete-skill') }}
                </div><br />
                @endif
                <div class="col-md-10 mt-2">
                    <h3>Anaknya Kemungkinan Akan Memiliki Skill Berikut:</h3>
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
            <div class="container">
                <div class="row mb-3 mt-5">
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

                let callbacks = function(data) {
                    $('.deleteData').deleteDataPost();
                }

                let columnDefs = [];
                let table;
                table = $('#table_data_index').loadTable(columns, [], ajaxOptions, callbacks);
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
