<?php
    require_once 'bdd.php';
    require_once 'vendor/autoload.php';

    $query = $db->query('SELECT magazine.id, magazine.name, editeur.name AS edit_name FROM magazine INNER JOIN editeur ON editeur.id = magazine.edit_id;');
    $articles = $query->fetchAll();
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
    <a href="ajouter.php">Ajouter un article</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOM</th>
                <th>EDITEUR</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($articles as $key => $value) {
                    echo "  <tr>
                                <td>{$value['id']}</td>
                                <td>{$value['name']}</td>
                                <td>{$value['edit_name']}</td>
                                <td>
                                    <a href='details.php?id={$value['id']}' title='details' class='btn btn-secondary'>Details</a>
                                    <a href='editer.php?id={$value['id']}' title='Editer' class='btn btn-secondary'>Editer</a>
                                    <a href='delet.php?id={$value['id']}' title='supprimer' class='btn btn-secondary'>SUPPRIMER</a>
                                </td>
                            </tr>";
                    
                }
            ?>
            <tr>
                <td></td>
            </tr>
            
        </tbody>
    </table>
</body>
</html>