<?php
$matkul = [
    [
        "nama" => "Algoritma dan Pemrograman",
        "sks" => 3,
        "nilai" => 85
    ],
    [
        "nama" => "Basis Data",
        "sks" => 3,
        "nilai" => 78
    ],
    [
        "nama" => "Matematika Diskrit",
        "sks" => 3,
        "nilai" => 55
    ],
    [
        "nama" => "Jaringan Komputer",
        "sks" => 2,
        "nilai" => 65
    ],
    [
        "nama" => "Pemrograman Web",
        "sks" => 4,
        "nilai" => 90
    ]
];

function hitungBobot($nilai) {
    if ($nilai >= 85) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 75) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 65) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}

$totalSKS = 0;
$totalNilai = 0;
$totalBobot = 0;
$totalSKSLulus = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Mata Kuliah</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f6f9;
        }

        h2, h3 {
            color: #243447;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin-bottom: 25px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #243447;
            color: white;
        }

        td.nama {
            text-align: left;
        }

        tr.mengulang {
            background-color: #ffcccc;
            color: #990000;
        }

        .hasil {
            background-color: white;
            padding: 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<h2>Daftar Nilai Mata Kuliah</h2>

<table>
    <tr>
        <th>No</th>
        <th>Nama Mata Kuliah</th>
        <th>SKS</th>
        <th>Nilai Angka</th>
        <th>Nilai Huruf</th>
        <th>Bobot</th>
        <th>Status</th>
    </tr>

    <?php foreach ($matkul as $index => $mk): ?>
        <?php
        $hasil = hitungBobot($mk["nilai"]);
        $huruf = $hasil["huruf"];
        $bobot = $hasil["bobot"];

        $status = ($bobot >= 2.0) ? "LULUS" : "MENGULANG";

        $totalSKS += $mk["sks"];
        $totalNilai += $mk["nilai"];
        $totalBobot += $mk["sks"] * $bobot;

        if ($status == "LULUS") {
            $totalSKSLulus += $mk["sks"];
        }

        $kelas = ($status == "MENGULANG") ? "mengulang" : "";
        ?>

        <tr class="<?= $kelas ?>">
            <td><?= $index + 1 ?></td>
            <td class="nama"><?= htmlspecialchars($mk["nama"]) ?></td>
            <td><?= $mk["sks"] ?></td>
            <td><?= $mk["nilai"] ?></td>
            <td><?= $huruf ?></td>
            <td><?= number_format($bobot, 1) ?></td>
            <td><?= $status ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
$ips = ($totalSKS > 0) ? $totalBobot / $totalSKS : 0;

$batasSKS = ($ips >= 3.00) ? 24 : 20;
?>

<h3>Hasil Perhitungan Semester</h3>

<div class="hasil">
    <p>Total mata kuliah: <?= count($matkul) ?></p>
    <p>Total SKS: <?= $totalSKS ?></p>
    <p>Total SKS lulus: <?= $totalSKSLulus ?></p>
    <p>Rata-rata nilai angka:
        <?= number_format($totalNilai / count($matkul), 2) ?>
    </p>
    <p>IPS:
        <strong><?= number_format($ips, 2) ?></strong>
    </p>
    <p>Batas maksimal SKS semester depan:
        <strong><?= $batasSKS ?> SKS</strong>
    </p>
</div>

</body>
</html>