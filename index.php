<?php 
require 'function.php';

if(!isset($_SESSION["login"])) {
    header('Location: login.php');
    exit;
}
$notfound = true;

$totalData = count(query("SELECT * FROM mahasiswa"));
$dataPerPage = 3;
$totalPage = ceil($totalData / $dataPerPage);
$activePage = isset($_GET["page"])? +$_GET["page"] : 1;
$initialData = ceil($dataPerPage * $activePage) - $dataPerPage;

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC LIMIT $initialData,$dataPerPage;");
if(count($mahasiswa)>0) {
    $notfound = false;
}
if(isset($_POST["keywoard"])) {
    $mahasiswa = search($_POST["keywoard"]);
    if(count($mahasiswa)>0) {
        $notfound = false;        
    } else {
        $notfound = true;
    }
} 

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
    <title>School App</title>
</head>
<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <h1 class="display-4">Happy School</h1>
            <p class="lead">A place to have fun. Say no to study</p>
        </div>
    </div>
    <div class="container">
        <a href="logout.php" class="btn btn-danger" style="position:absolute; top:15px; right:15px;">Logout</a>
        <div class="d-flex align-items-center mb-4" style="position:relative;">
            <h5 class="w-25 text-center" style="text-decoration:underline;">
                <a class="text-dark" href="addForm.php">Add New Student</a>
            </h5>
            <form method="post" class="w-75" style="position:relative;">
                <div class="md-form mt-0">
                    <input id="keywoard" class="form-control" name="keywoard" type="text" placeholder="Search" aria-label="Search">
                </div>
                <img id="loader" src="./assets/loader.jpg" alt="loader" style="height:35px;position:absolute;top:2px;right:0;">
            </form>
            <a class="btn btn-outline-secondary" href="print.php" target=”_blank” style="position:absolute;top:70px;right:-100px;">Print<i class="fas fa-print ml-2"></i></a>
        </div>
        <div id="dataTable" style="height:380px;">
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
        </div>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <?php if($activePage > 1):?>
                            <a class="page-link" href="?page=<?= $activePage - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        <?php endif?>
                    </li>
                    <?php for($i = 1; $i <= $totalPage; $i++) :?>
                        <?php if($i == $activePage):?>
                            <li class="page-item active"><a class="page-link" href="?page=<?= $i ?>"><?= $i?></a></li>
                        <?php else:?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i?></a></li>
                        <?php endif?>
                    <?php endfor?>
                    
                    <li class="page-item">
                        <?php if($activePage < $totalPage):?>
                            <a class="page-link" href="?page=<?= $activePage + 1 ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        <?php endif?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="./scripts/livesearch.js"></script>
</body>
</html>