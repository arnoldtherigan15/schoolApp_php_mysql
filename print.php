<?php

require 'vendor/autoload.php';
require 'function.php';
$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");
$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/custom/temp/dir/path']);
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>NRP</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>';
    foreach($mahasiswa as $el) {
        $html .= '<tr>
            <td>'. $el["id"] .'</td>
            <td><img src="assets/'. $el["gambar"] .'" style="width:80px"></td>
            <td>'. $el["name"] .'</td>
            <td>'. $el["nrp"] .'</td>
            <td>'. $el["email"] .'</td>
            <td>'. $el["jurusan"] .'</td>
        </tr>';
    }
$html.='</table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('student_data',\Mpdf\Output\Destination::INLINE);
