<?php 
require '../function.php';
$keywoard = $_GET["keywoard"];
$notfound = true;
$totalData = count(query("SELECT * FROM mahasiswa"));
$dataPerPage = 3;
$totalPage = ceil($totalData / $dataPerPage);
$activePage = isset($_GET["page"])? +$_GET["page"] : 1;
$initialData = ceil($dataPerPage * $activePage) - $dataPerPage;
$query = "SELECT * FROM mahasiswa
    WHERE 
        name LIKE '%$keywoard%' OR
        nrp LIKE '%$keywoard%' OR
        email LIKE '%$keywoard%' OR
        jurusan LIKE '%$keywoard%'
    LIMIT $initialData,$dataPerPage;
    ";
$mahasiswa = query($query);
// var_dump($mahasiswa);
if(count($mahasiswa)>0) {
    $notfound = false;
}
?>

<table class="table table-striped text-center">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
            <th scope="col">Name</th>
            <th scope="col">NRP</th>
            <th scope="col">Email</th>
            <th scope="col">Jurusan</th>
            <th scope="col">action</th>
        </tr>
    </thead>
    <tbody>
    <?php if(!$notfound):?>
        <?php foreach($mahasiswa as $person): ?>
            <tr>
                <th scope="row"><?= $person["id"]?></th>
                <td>
                    <img src="./assets/<?= $person["gambar"]?>" alt="avatar" class="img-thumbnail" style="width:100px">
                </td>
                <td><?= $person["name"]?></td>
                <td><?= $person["nrp"]?></td>
                <td><?= $person["email"]?></td>
                <td><?= $person["jurusan"]?></td>
                <td>
                    <a class="btn btn-outline-warning" 
                        href="edit.php?id=<?= $person['id']?>">Edit</a>
                    <a class="text-danger btn btn-outline-danger" href="delete.php?id=<?= $person['id']?>"
                        onclick="return confirm('are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach?>
        <?php else :?>
            <tr>
                <td colspan="7"><h4>No Data ...</h4></td>
            </tr>
                
        <?php endif ?>
    </tbody>
</table>