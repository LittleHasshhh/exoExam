<?php

require_once 'vendor/autoload.php';
require_once 'bdd.php';

// Création de l'instance de Faker
$faker = Faker\Factory::create('fr_FR');

// Désactive la vérification des clés étrangères
$db->query('SET FOREIGN_KEY_CHECKS = 0');

// Vide la table "categories"
$db->query('TRUNCATE magazine');

// Vide la table "users"
$db->query('TRUNCATE editeur');

// active la vérification des clés étrangères
$db->query('SET FOREIGN_KEY_CHECKS = 1');


for ($i = 0; $i < 10; $i++) {
    $query = $db->prepare('INSERT INTO editeur (name) VALUES (:name)');
    $query->bindValue(':name', $faker->name);
    $query->execute();
}

for ($i=0; $i < 30; $i++) { 
    $new = $db->prepare('INSERT INTO magazine (name, descrip, price, image, edit_id) VALUES ( :name, :descrip, :price, :image, :edit_id)');
    $new->bindValue(':name', $faker->colorName);
    $new->bindValue(':descrip', $faker->realText(250));
    $new->bindValue(':price', rand(10,60));
    $new->bindValue(':image', '01.jpg');
    $new->bindValue(':edit_id', rand(1,10), PDO::PARAM_INT);
    $new->execute();
}
