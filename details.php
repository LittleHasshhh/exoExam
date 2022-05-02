<?php
require_once 'bdd.php';
require_once 'vendor/autoload.php';

$id = htmlspecialchars(strip_tags($_GET['id']));

$query = $db->prepare('SELECT magazine.image, magazine.price, magazine.descrip, magazine.id, magazine.name, editeur.name AS edit_name FROM magazine INNER JOIN editeur ON editeur.id = magazine.edit_id WHERE magazine.edit_id = :id');
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();
$element = $query->fetch();
dump($element['image']);


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
    <table border>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOM</th>
                <th>EDITEUR</th>
                <th>DESCRIPTION</th>
                <th>PRIX</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $element['id']?></td>
                <td><?php echo $element['name']?></td>
                <td><?php echo $element['edit_name']?></td>
                <td><?php echo $element['descrip']?></td>
                <td><?php echo $element['price']?></td>
            </tr>
        </tbody>
    </table>
    <?php echo "<img src='img/{$element['image']}' width='250px'>";
    ?>
</body>
</html>