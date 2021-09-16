<?php
require("php/database/dataManager.php");
if (isset($_GET['result'])) {
    $response = search($_GET['result']);
} else {
    $response = read();
}
$length = count($response);
?>

<main>
    <section id="cover">
    </section>
    <?php if (!isset($_SESSION['pseudo'])): ?>
    <section id="form">
        <h2>Inscription</h2>
        <form action="register" method="post">
            <label for="pseudo">
                <input type="text" id="pseudo" name="pseudo" placeholder="pseudo">
            </label>
            <label for="mdp">
                <input type="password" id="mdp" name="mdp" placeholder="mot de passe">
            </label>
            <label for="confirm_mdp">
                <input type="password" id="confirm_mdp" name="confirm_mdp" placeholder="confirm mot de passe">
            </label>
            <input type="submit" value="S'inscrire">
        </form>
    </section>
    <?php endif; ?>
    <h2>Nos Bouteilles</h2>
    <section id="searchbar">
        <form action="search&page=home" method="POST" id="add" enctype="multipart/form-data">
            <label for="search">
                <input type="text" name="search" id="search" placeholder="tappez ici la boutaille recherché" required>
            </label>
            <input type="submit" value="Rechercher">
        </form>
    </section>
<section id="display">
    <?php if ($length === 0): ?>
        <div class="no_result">
            <h3>Pas de résultat pour cette recherche !</h3>
        </div>
    <?php endif; ?>
    <?php for ($i = 0; $i < $length; $i++): ?>
    <div class="bottle">
        <div class="char">
            <h3><?php echo $response[$i]['nom'] . ' ' .$response[$i]['annee'] . '  -  ' . $response[$i]['cepage']?></h3>
            <h4><?php echo $response[$i]['region'] . '  -  ' .$response[$i]['pays'] ?></h4>
            <p><?php echo $response[$i]['description'] ?></p>
        </div>
        <div class="wine">
            <img src="src/img/<?php echo $response[$i]['picture']?>" alt="bottle">
        </div>
    </div>
    <?php endfor; ?>
</section>
</main>
<?php require_once "footer.php";

?>