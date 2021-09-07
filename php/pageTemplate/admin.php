<?php
if (!isset($_SESSION['pseudo'])) {
    $msg_error = "oups tu n'as pas le droit d'aller ici";
    header("Location: home?msg=$msg_error&error=true");
}
require_once("php/models/dataManager.php");
$response = read();
$length = count($response);
?>
<main>
    <section id="display">
        <form action="../../index.php" method="POST" id="add" enctype="multipart/form-data" class="card">
                <label for="name">
                    <input type="text" name="name" id="name" placeholder="name" required>
                </label>
                <label for="year">
                    <input type="text" name="year" id="year" placeholder="year" required>
                </label>
                <label for="grapes">
                    <input type="text" name="grapes" id="grapes" placeholder="grapes" required>
                </label>
                <label for="country">
                    <input type="text" name="country" id="country" placeholder="country" required>
                </label>
                <label for="region">
                    <input type="text" name="region" id="region" placeholder="region" required>
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
            <form action="adminForm&id=<?php echo $response[$i]['id'] ?>" method="post" enctype="multipart/form-data" class="card">
                <div class="between">
                    <div class="input">
                        <?php foreach ($response[$i] as $key => $value): ?>
                            <?php if ($key === 'id'): ?>
                                <div class="space">
                                    <h4><?php echo $key ?></h4>
                                    <p><?php echo $value; ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if ($key !== 'picture' && $key !== 'id'): ?>
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
                        <button type="submit" value="update">update</button>
                        <button><a href="delete&id=<?php echo $response[$i]['id'] ?>">delete</a></button>
                    </div>
                </div>
            </form>
    <?php endfor; ?>
    </section>
</main>
