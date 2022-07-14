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
            <form action="{{route('skill.update', $data->id )}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row mb-3 mt-5">
                    <div class="col-md-11">
                        <h2>Detail Skill: {{$data->skill}}</h2>
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
                            <td>{{$data->id}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>
                                <input name="skill" class="form-control" value="{{$data->skill}}">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Skill</th>
                        <th>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHero">
                                Tambah Hero
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($data->superhero as $key => $row)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$row->nama}}</td>
                        <td>
                            <form action="{{ route('xmen.destroy', $row->id)}}" method="post">
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

        <script src="{{ asset('public/assets/custom/plugins/plugins.bundle.js') }}"></script>
        <script src="{{ asset('public/assets/custom/scripts.bundle.js') }}"></script>
        <script src="{{ asset('public/assets/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{ asset('public/assets/custom/main.js') }}"></script>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="addHero" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Heroes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('xmen.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Heros</label>
                            <input type="text" name="nama" class="form-control" id="" placeholder="Wolverine">
                            <input type="hidden" name="skill_id" class="form-control" id="" placeholder="test" value="{{$data->id}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
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
</div>

</body>
</html>
