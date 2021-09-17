<?php
require("php/database/database.php");

function add($data)
{

    $conn = connexion();

    try {

        $query = $conn->prepare("
                INSERT INTO wine_picture(picture)
                VALUES(:picture);");
        $query->bindValue(':picture', $data['picture']);
        $query->execute();
        $last_id = $conn->lastInsertId();

        $query_wine = $conn->prepare("
                INSERT INTO wine(nom, annee, cepage, pays, region, description, id_wine_picture)
                VALUES(:nom, :annee, :cepage, :pays, :region, :description, $last_id)
                ");
        $query_wine->bindValue(':nom', $data['nom']);
        $query_wine->bindValue(':annee', $data['annee']);
        $query_wine->bindValue(':cepage', $data['cepage']);
        $query_wine->bindValue(':pays', $data['pays']);
        $query_wine->bindValue(':region', $data['region']);
        $query_wine->bindValue(':description', $data['description']);
        return $query_wine->execute();
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}

function read() {


   $conn = connexion();

    try {
        $query = $conn->prepare("SELECT * FROM wine INNER JOIN wine_picture
        WHERE id_picture = id_wine_picture");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        return "Erreur : " . $e->getMessage();
    }
}

function update($data) {

    $conn = connexion();

    try {
        $query = $conn->prepare ("UPDATE wine SET nom = :nom, annee = :annee,
                cepage = :cepage, pays = :pays, region = :region, description = :description,
                id_wine_picture = :id_wine_picture
                WHERE id = :id");
        $query->bindValue(':id', $data['id']);
        $query->bindValue(':nom', $data['nom']);
        $query->bindValue(':annee', $data['annee']);
        $query->bindValue(':cepage', $data['cepage']);
        $query->bindValue(':pays', $data['pays']);
        $query->bindValue(':region', $data['region']);
        $query->bindValue(':description', $data['description']);
        $query->bindValue(':id_wine_picture', $data['id_wine_picture']);
        $query->execute();

        $query_wine = $conn->prepare ("UPDATE wine_picture SET picture = :picture
                WHERE id_picture = :id_picture");
        $query_wine->bindValue(':id_picture', $data['id_picture']);
        $query_wine->bindValue(':picture', $data['picture']);

        return $query_wine->execute();
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}

function delete($id) {

    $conn = connexion();

    try {
        $query = $conn->prepare("DELETE FROM wine WHERE id = :id");
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

function search($data) {


    $conn = connexion();
    $search = $data;

    try {
        $query = $conn->prepare("SELECT * FROM wine INNER JOIN wine_picture ON
        wine.id_wine_picture = wine_picture.id_picture WHERE wine.nom LIKE '%$search%'");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        return "Erreur : " . $e->getMessage();
    }
}

function role($data) {


    $conn = connexion();
    $search = $data;

    try {
        $query = $conn->prepare("SELECT * FROM user WHERE pseudo LIKE '%$data%'");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        return "Erreur : " . $e->getMessage();
    }
}


