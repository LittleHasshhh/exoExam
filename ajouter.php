<?php

require_once 'bdd.php';
require_once 'vendor/autoload.php';

$title = null;
$desc = null;
$price = null;
$error = null;


if (!empty($_POST)) {
    
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $desc = htmlspecialchars(strip_tags($_POST['content']));
    $price = htmlspecialchars(strip_tags($_POST['price']));

    if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['price']) && !empty($_FILES['cover']) && $_FILES['cover']['error'] === 0){

        require_once 'funk.php';
        $upload = uploadPicture($_FILES['cover'], '../images/upload', $title, 1);
        
        if (empty($upload['error'])){
            dump($_POST);
            $fileName = $upload['filename'];

            $query = $db->prepare('INSERT INTO magazine (edit_id, name, descrip, price, image) VALUES (1, :name, :descrip, :price, :cover)');
            $query->bindValue(':name', $title);
            $query->bindValue(':descrip', $desc);
            $query->bindValue(':price', $price);
            $query->bindValue(':cover', $fileName);
            $query->execute();

            header('Location: index.php?successAdd=1');
        }else {
            $error = $upload['error'];
        }

    }else {
        $error = 'Tous les champs sont obligatoires';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">

        <?php if($error !== null): ?>
            <div>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <label for="title">Titre</label>
        <input type="text" value="<?php echo $title; ?>" id="title" name="title">

        <label for="content">Description</label>
        <textarea id="content" name="content" rows="3"><?php echo $desc; ?></textarea>

        <label for="cover">Image de couverture</label>
        <input type="file" id="cover" name="cover">

        <label for="price">prix</label>
        <input type="number" name="price" id="price" min="1" max="10000" value="<?php echo $price; ?>">
        
        <button>Ajouter</button>

    </form>
</body>
</html>