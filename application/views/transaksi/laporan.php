<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_pdf; ?></title>
    <style>
        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <div style="text-align:center">
        <h3> Laporan Tanggal <?= $start_date; ?> s/d <?= $stop_date; ?></h3>
    </div>
    <table id="table">
        <thead>
            <tr>
                <th>Kode Tks</th>
                <th>Pelanggan</th>
                <th>Telp</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $kode_transaksi = ''; ?>
            <?php $gtotal = 0; ?>
            <?php foreach ($transaksi as $t) : ?>
                <?php $gtotal = $gtotal + $t['total']; ?>
                <?php if ($kode_transaksi != $t['kode_transaksi']) { ?>
                    <tr>
                        <td><?= $t['kode_transaksi']; ?></td>
                        <td><?= $t['namapelanggan']; ?></td>
                        <td><?= $t['telppelanggan']; ?></td>
                        <td><?= $t['namaproduk']; ?></td>
                        <td><?= number_format($t['hargaproduk'], 0, ',', '.'); ?></td>
                        <td><?= $t['jumlah']; ?></td>
                        <td><?= number_format($t["total"], 0, ',', '.'); ?></td>
                        <td><?= date_format(date_create($t['created_at']), "d/m/Y"); ?></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td></td>
                        <td><?= $t['namapelanggan']; ?></td>
                        <td><?= $t['telppelanggan']; ?></td>
                        <td><?= $t['namaproduk']; ?></td>
                        <td><?= number_format($t['hargaproduk'], 0, ',', '.'); ?></td>
                        <td><?= $t['jumlah']; ?></td>
                        <td><?= number_format($t["total"], 0, ',', '.'); ?></td>
                        <td><?= date_format(date_create($t['created_at']), "d/m/Y"); ?></td>
                    </tr>
                <?php } ?>
                <?php $kode_transaksi = $t['kode_transaksi']; ?>
            <?php endforeach; ?>
            <tr>
                <th colspan="6" style="text-align: right;">Total</th>
                <th><?= number_format($gtotal, 0, ',', '.'); ?></th>
                <th></th>
            </tr>
        </tbody>
    </table>
</body>

</html>