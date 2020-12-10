<?php 
$connection = mysqli_connect("localhost","root","","phpdasar");

function query($query) {
    global $connection;
    $temp = mysqli_query($connection, $query);
    $result = [];
    while ($data = mysqli_fetch_assoc($temp)) {
        $result[] = $data;
    }
    return $result;
}

function addStudent($data) {
    global $connection;
    $name = $data["name"];
    $nrp = $data["nrp"];
    $email = $data["email"];
    $jurusan = $data["jurusan"];
    $gambar = $data["gambar"];
    $query = "INSERT INTO mahasiswa (name, nrp, email, jurusan, gambar)
    VALUES ('$name','$nrp','$email','$jurusan','$gambar');";
    mysqli_query($connection,$query);
    return mysqli_affected_rows($connection);
}

function deleteStudent($id) {
    global $connection;
    mysqli_query($connection, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($connection);
}

function editStudent($data) {
    global $connection;
    $id = $data["id"];
    $name = $data["name"];
    $nrp = $data["nrp"];
    $email = $data["email"];
    $jurusan = $data["jurusan"];
    $gambar = $data["gambar"];
    $query = "UPDATE mahasiswa 
    SET 
        name = '$name',
        nrp = '$nrp',
        email = '$email',
        jurusan = '$jurusan',
        gambar = '$gambar'
    WHERE
        id = '$id';";
    mysqli_query($connection,$query);
    return mysqli_affected_rows($connection);
}

function search($keywoard) {
    global $connection;
    $query = "SELECT * FROM mahasiswa
    WHERE 
        name LIKE '%$keywoard%' OR
        nrp LIKE '%$keywoard%' OR
        email LIKE '%$keywoard%' OR
        jurusan LIKE '%$keywoard%';
    ";
    return query($query);
}
 ?>