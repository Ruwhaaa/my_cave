<?php
require("php/models/dataManager.php");
$response = read();
$length = count($response);
?>

<main>
    <section id="cover">

    </section>
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
<section id="display">
    <?php for ($i = 0; $i < $length; $i++): ?>
    <div class="bottle">
        <div class="char">
            <h3><?php echo $response[$i]['name'] . ' ' .$response[$i]['year'] . '  -  ' . $response[$i]['grapes']?></h3>
            <h4><?php echo $response[$i]['region'] . '  -  ' .$response[$i]['country'] ?></h4>
            <p><?php echo $response[$i]['description'] ?></p>
        </div>
        <div class="wine">
            <img src="src/img/<?php echo $response[$i]['picture']?>" alt="bottle">
        </div>
    </div>
    <?php endfor; ?>
</section>
<?php require_once "footer.php"; ?>