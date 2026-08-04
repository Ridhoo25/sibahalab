<?php
require 'config.php';
require 'auth.php';

$id = (int)($_GET['id'] ?? 0);

$header = mysqli_fetch_array(mysqli_query(
    $conn,
    "SELECT * FROM sib_sbbk WHERE id='$id'"
));

if (!$header) {
    echo "<script>alert('SBBK tidak ditemukan');window.location='sbbk.php';</script>";
    exit;
}

$detail = mysqli_query(
    $conn,
    "SELECT sd.*, t.merek, t.jumlah, t.satuan, t.exp_date, t.laboratorium 
     FROM sib_sbbk_detail sd 
     JOIN sib_penerimaan t ON sd.id_bhp = t.id 
     WHERE sd.id_sbbk='$id'"
);

$detailRows = [];
while ($row = mysqli_fetch_array($detail)) {
    $detailRows[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lembaran SBBK Asli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        h3 {
            margin-bottom: 5px;
        }

        .info {
            margin-top: 15px;
            line-height: 1.8;
        }

        .info span {
            display: inline-block;
            width: 120px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid black;
            padding: 6px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        td {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .ttd {
            margin-top: 80px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .ttd div {
            width: 45%;
            text-align: center;
        }

        @media print {
            @page {
                size: A4;
                margin: 1cm;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <!-- KOP -->
    <div style="text-align:center; margin:0;">
    <img src="assets/img/kop.png" style="width:100%; height:auto; margin:0;">
    </div>

    <!-- JUDUL -->
    <h3 style="text-align:center; margin:5px 0 10px 0;">
    SURAT BUKTI BARANG KELUAR (SBBK)
    </h3>

    <!-- INFO -->
    <div class="info">
        <div><span>Nomor SBBK</span> : <?= htmlspecialchars($header['no_sbbk']); ?></div>
        <div><span>Tanggal</span> : <?= date('d-m-Y', strtotime($header['tanggal'])); ?></div>
        <div><span>Laboratorium</span> : <?= htmlspecialchars($header['laboratorium']); ?></div>
        
    </div>

    <!-- TABEL DETAIL -->
    <table>
        <tr>
            <th width="5%">No</th>
            <th width="25%">Nama BHP</th>
            <th width="15%">Merek</th>
            <th width="10%">Jumlah</th>
            <th width="10%">Satuan</th>
            <th width="15%">Exp Date</th>
            <th width="20%">Laboratorium</th>
        </tr>

        <?php
        $no = 1;
        foreach ($detailRows as $d) {
            $exp_date = date('d-m-Y', strtotime($d['exp_date']));
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td class="text-left"><?= htmlspecialchars($d['nama_bhp']); ?></td>
                <td><?= htmlspecialchars($d['merek']); ?></td>
                <td><?= htmlspecialchars($d['jumlah']); ?></td>
                <td><?= htmlspecialchars($d['satuan']); ?></td>
                <td><?= $exp_date; ?></td>
                <td><?= htmlspecialchars($d['laboratorium']); ?></td>
            </tr>
        <?php } ?>
    </table>

    <!-- CATATAN -->
        <div class="catatan" style="margin-top:5px; margin-bottom:5px;">
        <div>
            <strong>Catatan:</strong><br>
            <p> 1. Setiap barang yang diterima harap diperiksa</p>
            <p> 2. Barang yang sudah diterima tidak dapat dikembalikan</p>
            <p> 3. Setelah tanda tangan, barang dianggap diterima</p>
        </div>  
    </div>
<br><br>
    <!-- TANDA TANGAN -->
   <div class="ttd" style="margin-top:5px; display:flex; justify-content:space-between; width:100%;">
    
    <div style="text-align:center;">
        Menyerahkan,<br>
        Pejabat Pengelola Barang Milik Daerah
        <div style="height:50px;"></div>
        <?= htmlspecialchars($header['serah']); ?>
    </div>

    <div style="text-align:center;">
        Palangka Raya, <?= date('d-m-Y'); ?><br>
        Menerima,
        <div style="height:50px;"></div>
        <?= htmlspecialchars($header['penerima']); ?>
    </div>

</div>

<br><br>
<div style="border-bottom:1px solid #ccc; margin:8px 0;"></div>
<br><br><br><br>

    <!-- JUDUL -->
    <h3 style="text-align:center; margin:5px 0 10px 0;">
    SURAT BUKTI BARANG KELUAR (SBBK)
    </h3>

    <!-- INFO -->
    <div class="info">
        <div><span>Nomor SBBK</span> : <?= htmlspecialchars($header['no_sbbk']); ?></div>
        <div><span>Tanggal</span> : <?= date('d-m-Y', strtotime($header['tanggal'])); ?></div>
        <div><span>Laboratorium</span> : <?= htmlspecialchars($header['laboratorium']); ?></div>
        
    </div>

    <!-- TABEL DETAIL -->
    <table>
        <tr>
            <th width="5%">No</th>
            <th width="25%">Nama BHP</th>
            <th width="15%">Merek</th>
            <th width="10%">Jumlah</th>
            <th width="10%">Satuan</th>
            <th width="15%">Exp Date</th>
            <th width="20%">Laboratorium</th>
        </tr>

        <?php
        $no = 1;
        foreach ($detailRows as $d) {
            $exp_date = date('d-m-Y', strtotime($d['exp_date']));
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td class="text-left"><?= htmlspecialchars($d['nama_bhp']); ?></td>
                <td><?= htmlspecialchars($d['merek']); ?></td>
                <td><?= htmlspecialchars($d['jumlah']); ?></td>
                <td><?= htmlspecialchars($d['satuan']); ?></td>
                <td><?= $exp_date; ?></td>
                <td><?= htmlspecialchars($d['laboratorium']); ?></td>
            </tr>
        <?php } ?>
    </table>

 <!-- CATATAN -->
        <div class="catatan" style="margin-top:5px; margin-bottom:5px;">
        <div>
            <strong>Catatan:</strong><br>
            <p> 1. Setiap barang yang diterima harap diperiksa</p>
            <p> 2. Barang yang sudah diterima tidak dapat dikembalikan</p>
            <p> 3. Setelah tanda tangan, barang dianggap diterima</p>
        </div>  
    </div>
<br><br>
    <!-- TANDA TANGAN -->
   <div class="ttd" style="margin-top:5px; display:flex; justify-content:space-between; width:100%;">
    
    <div style="text-align:center;">
        Menyerahkan,<br>
        Pejabat Pengelola Barang Milik Daerah
        <div style="height:50px;"></div>
        <?= htmlspecialchars($header['serah']); ?>
    </div>

    <div style="text-align:center;">
        Palangka Raya, <?= date('d-m-Y'); ?><br>
        Menerima,
        <div style="height:50px;"></div>
        <?= htmlspecialchars($header['penerima']); ?>
    </div>

</div>  
</body>
</html>