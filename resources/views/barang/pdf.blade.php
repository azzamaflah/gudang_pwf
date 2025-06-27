<!DOCTYPE html>
<html>

<head>
    <title>Data Barang</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Data Barang</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Rak</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
                <tr>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $barang->rak->kode_rak ?? '-' }}</td>
                    <td>{{ $barang->stok }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
