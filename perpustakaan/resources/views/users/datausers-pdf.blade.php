<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #3498db;
            color: white;
        }
    </style>
</head>

<body>

    <h1>Data Users</h1>

    <table id="customers">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Nomor</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
        </tr>
        @foreach ($data as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->kelas ?: '-' }}</td>
            <td>{{ $row->jurusan ? $row->jurusan->nama_prodi : '-' }}</td>
            <td>{{ $row->nohp }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->status}}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>