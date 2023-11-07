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

    <h1>Data Transaksi</h1>

    <table id="customers">
        <tr>
            <th scope="col">No</th>
            <th scope="col">NP</th>
            <th scope="col">Nama</th>
            <th scope="col">Buku</th>
            <th scope="col">Tgl Pinjam</th>
            <th scope="col">Tempo</th>
            <th scope="col">Tgl Kembali</th>
            <th scope="col">Denda</th>
            <th scope="col">Status</th>
        </tr>
        @foreach ($data as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>NP{{ $row->users->id }}</td>
            <td>{{ $row->users->nama }}</td>
            <td>{{ $row->buku->judul }}</td>
            <td>{{ $row->tglpinjam }}</td>
            <td>{{ $row->tempo }}</td>
            <td>{{ $row->tglkembali }}</td>
            <td>{{ $row->denda }}</td>
            <td>{{ $row->status }}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>