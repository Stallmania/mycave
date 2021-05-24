<?php
session_start();
require_once('src/models/cave.php');

if (isset($_POST['save'])) {

    if($_FILES['image']['name'] == ''){
        $picture = 'generic.jpg';
    }else{
        $picture = $_FILES['image']['name'];
    }

    $bottleValues = [
        'name' => $_POST['name'],
        'year' => $_POST['year'],
        'grapes' => $_POST['grapes'],
        'country' => $_POST['country'],
        'region' => $_POST['region'],
        'description' => $_POST['description'],
        'picture' => $picture
    ];

    $res = createBottle($bottleValues);

    if($_FILES['image']['name'] != ''){
        move_uploaded_file($_FILES['image']['tmp_name'], './public/img/'.$picture);
    }

    if ($res) {

        header('Location: ./bottles_crud.php');
        exit;
    }
}
