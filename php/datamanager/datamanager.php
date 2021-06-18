<?php
require ("php/database/database.php");

function add($data) {


    $conn = connexion();

    try {
        $query = $conn->prepare("
                INSERT INTO wine(name, year, grapes, country, region, description, picture)
                VALUES(:name, :year, :grapes, :country, :region, :description, :picture)
                ");
        $query->bindValue(':name', $data['name']);
        $query->bindValue(':year', $data['year']);
        $query->bindValue(':grapes', $data['grapes']);
        $query->bindValue(':country', $data['country']);
        $query->bindValue(':region', $data['region']);
        $query->bindValue(':description', $data['description']);
        $query->bindValue(':picture', $data['picture']);
    return $query->execute();
    } catch(PDOException $e){
        return "Erreur : " . $e->getMessage();
    }
}

function read(): ?array
{

   $conn = connexion();

    try {
        $query = $conn->prepare("SELECT * FROM wine");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
        return NULL;
    }
}

function update($data): ?bool {

    $conn = connexion();

    try {
        $sql = "UPDATE wine SET name = :name, year = :year, grapes = :grapes, country = :country, region = :region, description = :description, picture = :picture
                WHERE id = :id";
        $query = $conn->prepare($sql);
        $query->bindValue(':id', $data['id'], PDO::PARAM_STR);
        $query->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $query->bindValue(':year', $data['year'], PDO::PARAM_STR);
        $query->bindValue(':grapes', $data['grapes'], PDO::PARAM_STR);
        $query->bindValue(':country', $data['country'], PDO::PARAM_STR);
        $query->bindValue(':region', $data['region'], PDO::PARAM_STR);
        $query->bindValue(':description', $data['description'], PDO::PARAM_STR);
        $query->bindValue(':picture', $data['picture'], PDO::PARAM_STR);
        return TRUE;
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

