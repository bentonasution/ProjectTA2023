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

    <h1>Data Buku</h1>

    <table id="customers">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Judul</th>
            <th scope="col">Pengarang</th>
            <th scope="col">Penerbit</th>
            <th scope="col">ISBN</th>
            <th scope="col">Kategori</th>
            <th scope="col">Tahun Terbit</th>
        </tr>
        @foreach ($data as $index => $row)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $row->judul }}</td>
        <td>{{ $row->pengarang }}</td>
        <td>{{ $row->penerbit }}</td>
        <td>{{ $row->isbn }}</td>
        <td>{{ $row->kategori->nama }}</td>
        <td>{{ $row->tahun }}</td>
    </tr>
    @endforeach
    </table>

</body>

</html>