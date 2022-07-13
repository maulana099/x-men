<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
</head>

<style>
    table, th, td {
  border: 1px solid;
  padding: 10px;
}
</style>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Hero</th>
                <th>Jenis Kelamin</th>
                <th>Skill</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($data as $row)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$row->nama}}</td>
                <td>{{$row->jenis_kelamin}}</td>
                @foreach ($row->skill as $item)
                    <td>{{$item->skill}}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
