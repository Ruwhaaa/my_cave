<?php
require("php/database/database.php");

function add($data)
{

    $conn = connexion();

    try {

        $query = $conn->prepare("
                INSERT INTO bottle_picture(picture)
                VALUES(:picture);");
        $query->bindValue(':picture', $data['picture']);
        $query->execute();

        $query = $conn->prepare("
                INSERT INTO wine(name, year, grapes, country, region, description, picture_id)
                VALUES(:name, :year, :grapes, :country, :region, :description, LAST_INSERTED_ID())
                ");
        $query->bindValue(':name', $data['name']);
        $query->bindValue(':year', $data['year']);
        $query->bindValue(':grapes', $data['grapes']);
        $query->bindValue(':country', $data['country']);
        $query->bindValue(':region', $data['region']);
        $query->bindValue(':description', $data['description']);
        return $query->execute();
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}

function read() {


   $conn = connexion();

    try {
        $query = $conn->prepare("SELECT * FROM wine INNER JOIN bottle_picture WHERE id_bottle = picture_id");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        return "Erreur : " . $e->getMessage();
    }
}

function update($data) {

    $conn = connexion();

    try {
        $query = $conn->prepare ("UPDATE wine SET name = :name, year = :year, grapes = :grapes, country = :country, region = :region, description = :description, picture = :picture
                WHERE id = :id");
        $query->bindValue(':id', $data['id'], PDO::PARAM_STR);
        $query->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $query->bindValue(':year', $data['year'], PDO::PARAM_STR);
        $query->bindValue(':grapes', $data['grapes'], PDO::PARAM_STR);
        $query->bindValue(':country', $data['country'], PDO::PARAM_STR);
        $query->bindValue(':region', $data['region'], PDO::PARAM_STR);
        $query->bindValue(':description', $data['description'], PDO::PARAM_STR);
        $query->bindValue(':picture', $data['picture'], PDO::PARAM_STR);
        return $query->execute();
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}

function delete($id) {

    $conn = connexion();

    try {
        $sql = "DELETE FROM wine WHERE id = :id";
        $query = $conn->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}

function login($data) {

    $conn = connexion();

    try {
        $query = $conn->prepare("SELECT pseudo, mdp FROM user WHERE pseudo = :pseudo");
        $query->bindValue(':pseudo', $data['pseudo']);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}

function signUp($data): string {
    $conn = connexion();

    try {
        $query = $conn->prepare("INSERT INTO user(pseudo, mdp) VALUES (:pseudo, :mdp)");
        $query->bindValue(':pseudo', $data['pseudo']);
        $query->bindValue(':mdp', $data['mdp']);
        $query->execute();
        return TRUE;
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}

