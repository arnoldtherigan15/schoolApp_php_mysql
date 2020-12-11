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
    $name = htmlspecialchars($data["name"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = upload();

    if(!$gambar) return false;

    $query = "INSERT INTO mahasiswa (name, nrp, email, jurusan, gambar)
    VALUES ('$name','$nrp','$email','$jurusan','$gambar');";
    mysqli_query($connection,$query);
    return mysqli_affected_rows($connection);
}

function upload() {
    $gambar = $_FILES["gambar"];
    $file_name = $gambar["name"];
    $file_size = $gambar["size"];
    $error = $gambar["error"];
    $tmp_name = $gambar["tmp_name"];
    if($error == 4) {
        echo "<script>
                alert('photo is required')
              </script>";
        return false;
    }
    $validExtention = ['jpg','png','jpeg'];
    $extentionName = explode('.',$file_name);
    $extentionName = strtolower(end($extentionName));
    // var_dump(in_array($extentionName,$validExtention));die;
    if(!in_array($extentionName,$validExtention)) {
        echo "<script>
                alert('image can only in jpg,png or jpeg')
              </script>";
        return false;
    }

    if($file_size > 1000000) {
        echo "<script>
                alert('please submit photo below 1mb')
              </script>";
        return false;
    }

    $newFileName = uniqid();
    $newFileName .= '.';
    $newFileName .= $extentionName;

    move_uploaded_file($tmp_name, 'assets/'. $newFileName);
    return $newFileName;
}

function deleteStudent($id) {
    global $connection;
    mysqli_query($connection, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($connection);
}

function editStudent($data) {
    global $connection;
    $id = $data["id"];
    $name = htmlspecialchars($data["name"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    

    if($_FILES["gambar"]["error"] == 4) {
        $gambar = $gambarLama;
    } else $gambar = upload();

    if(!$gambar) return false;
    
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

function register($data) {
    global $connection;
    $email = strtolower($data["email"]);
    $password = $data["password"];
    $password2 = $data["password2"];
    $user = query("SELECT * FROM users WHERE email = '$email'");
    
    if(!$user) {
        if($password === $password2) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (email, password)
            VALUES ('$email','$password');";
            mysqli_query($connection,$query);
            return mysqli_affected_rows($connection);
        } else {
            echo "<script>
                alert('password not matched');
              </script>";
            return false;
        }
    } else {
        echo "<script>
                alert('email is being used');
              </script>";
        return false;
    }

}

function login($data) {
    global $connection;
    $email = strtolower($data["email"]);
    $password = $data["password"];
    $user = query("SELECT * FROM users WHERE email = '$email'")[0];
    if($user) {
        if(password_verify($password, $user["password"])) {
            return 1;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
 ?>