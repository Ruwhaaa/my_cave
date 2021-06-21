<?php
require ("php/datamanager/datamanager.php");
$response = read();
$length = count($response);
?>
<main>
<?php if(isset($_GET['msg'])) : ?>
    <p><?php echo $_GET['msg']; ?></p>
<?php endif; ?>
<form action="adminForm" method="POST" id="add" enctype="multipart/form-data">
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
        <label for="picture">
            <input type="hidden" name="MAX_FILE_SIZE" value="4194304">
            <input type="file" name="picture" id="picture" placeholder="choisir une image" required>
        </label>
        <input type="submit" value="Ajouter">
</form>
    <?php for ($i = 0; $i < $length; $i++): ?>
    <tr>
        <form action="adminForm&id=<?php echo $response[$i]['id'] ?>" method="post" enctype="multipart/form-data">
        <?php foreach ($response[$i] as $key => $value): ?>
            <?php if ($key === 'picture'): ?>
                <td>
                    <img src="src/img/<?php echo $value ?>" alt="picture">
                    <label for="picture">
                        <input type="file" name="picture" required value="<?php echo $response[$i]['image']?>">
                        <input type="hidden" name="MAX_FILE_SIZE" value="4194304">
                    </label>
                </td>
            <?php endif; ?>
            <?php if ($key === 'id'): ?>
                <td>
                    <?php echo $value; ?>
                </td>
            <?php endif; ?>
            <?php if ($key !== 'picture' && $key !== 'id'): ?>
                <td>
                    <label for="<?php echo $key ?>">
                        <input type="text" name="<?php echo $key ?>" required value="<?php echo $value ?>">
                    </label>
                </td>
            <?php endif; ?>
        <?php endforeach; ?>
        <td><input type="submit" value="update"></td>
            <td><a href="delete&id=<?php echo $response[$i]['id'] ?>">delete</a></td>
        </form>
    </tr>
    <?php endfor; ?>
</main>
