<?php
require ("php/database/database.php");

function add(string $title, string $description, string $annee, string $auteur, float $prix, string $image) {

    $conn = connexion();

    try {
        $query = $conn->prepare("INSERT INTO books (title, description, annee, auteur, prix, image)
                VALUES (:title, :description, :annee, :auteur, :prix, :image)");
        $query->bindValue(':title',$title);
        $query->bindValue(':description',$description);
        $query->bindValue(':annee',$annee);
        $query->bindValue(':auteur',$auteur);
        $query->bindValue(':prix',$prix);
        $query->bindValue(':image',$image);
        $query->execute();

    } catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
        return NULL;
    }
}

function read(): ?array
{

   $conn = connexion();

    try {
        $query = $conn->prepare("SELECT * FROM books");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
        return NULL;
    }
}

function update($id, string $title, string $description, string $annee, string $auteur, float $prix, string $image): ?bool {

    $conn = connexion();

    try {
        $sql = "UPDATE books SET title = :title, description = :description, annee = :annee, auteur = :auteur, prix = :prix, image = :image
                WHERE id = :id";
        $query = $conn->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':annee', $annee, PDO::PARAM_STR);
        $query->bindParam(':auteur', $auteur, PDO::PARAM_STR);
        $query->bindParam(':prix', $prix);
        $query->bindParam(':image', $image, PDO::PARAM_STR);
        return $query->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return NULL;
    }
}

function delete($id) {

    $conn = connexion();

    try {
        $sql = "DELETE FROM books WHERE id = :id";
        $query = $conn->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return NULL;
    }
}

