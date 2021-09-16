<?php
if ($_SESSION['role'] === null) {
    $msg_error = "oups tu n'as pas le droit d'aller ici";
    header("Location: home?msg=$msg_error&error=true");
}
require_once("php/database/dataManager.php");
if (isset($_GET['result'])) {
    $response = search($_GET['result']);
} else {
    $response = read();
}
$length = count($response);

?>
<main>
    <h2>Bienvenue dans l'interface Admin</h2>
    <section id="searchbar">
        <?php var_dump($_SESSION) ?>
        <form action="search&page=admin" method="POST" id="add" enctype="multipart/form-data">
            <label for="search">
                <input type="text" name="search" id="search" placeholder="tappez ici la boutaille recherché" required>
            </label>
            <input type="submit" value="Rechercher">
        </form>
    </section>
    <section id="display">
        <form action="adminForm" method="POST" id="add" enctype="multipart/form-data" class="card">
            <h2>Ajouter une Bouteille</h2>
                <label for="name">
                    <input type="text" name="nom" id="name" placeholder="nom" required>
                </label>
                <label for="year">
                    <input type="text" name="annee" id="year" placeholder="année" required>
                </label>
                <label for="grapes">
                    <input type="text" name="cepage" id="grapes" placeholder="cépage" required>
                </label>
                <label for="country">
                    <input type="text" name="pays" id="country" placeholder="pays" required>
                </label>
                <label for="region">
                    <input type="text" name="region" id="region" placeholder="région" required>
                </label>
                <label for="description">
                    <input type="text" name="description" id="description" placeholder="description" required>
                </label>
                <div class="bottom">
                    <label for="picture">
                        <input type="hidden" name="MAX_FILE_SIZE" value="4194304">
                        <input type="file" name="picture" placeholder="choisir une image" required>
                    </label>
                    <input type="submit" value="Ajouter">
                </div>
        </form>
    <?php for ($i = 0; $i < $length; $i++): ?>
            <form action="adminForm&id=<?php echo $response[$i]['id']?>&id_picture=<?php echo $response[$i]['id_picture']?>&id_wine_picture=<?php echo $response[$i]['id_wine_picture']?>" method="post" enctype="multipart/form-data" class="card">
                <div class="between">
                    <div class="input">
                        <?php foreach ($response[$i] as $key => $value): ?>
                            <?php if ($key === 'id'): ?>
                                <div class="space">
                                    <h4><?php echo $key ?></h4>
                                    <p><?php echo $value; ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if ($key !== 'picture' && $key !== 'id' && $key !== 'id_wine_picture' && $key !== 'id_picture'): ?>
                                <div class="space">
                                    <h4><?php echo $key ?></h4>
                                    <label for="<?php echo $key ?>">
                                        <input type="text" name="<?php echo $key ?>" required value="<?php echo $value ?>">
                                    </label>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="picture">
                        <img src="src/img/<?php echo $value ?>" alt="picture">
                    </div>
                </div>
                <div class="bottom">
                    <label for="picture" class="file">
                        <input type="file" name="picture">
                        <input type="hidden" name="MAX_FILE_SIZE" value="4194304">
                        <input type="hidden" name="picture_db" value="<?php echo $value ?>">
                    </label>
                    <div class="button">
                        <button type="submit" value="update">modifier</button>
                        <button><a href="delete&id=<?php echo $response[$i]['id'] ?>">supprimer</a></button>
                    </div>
                </div>
            </form>
    <?php endfor; ?>
    </section>
</main>
