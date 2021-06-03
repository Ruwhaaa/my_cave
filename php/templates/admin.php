<?php
require ("php/datamanager/datamanager.php");
$response = read();
$length = count($response);
?>

<table id="admin">
    <thead>
        <tr>
            <th>Id</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Date</th>
            <th>Auteur</th>
            <th>Prix</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <form action="adminForm" method="post">
                <td>

                </td>
                <td>
                    <label for="title">
                        <input type="text" name="title" required>
                    </label>
                </td>
                <td>
                    <label for="description">
                        <input type="text" name="description" required>
                    </label>
                </td>
                <td>
                    <label for="annee">
                        <input type="text" name="annee" required>
                    </label>
                </td>
                <td>
                    <label for="auteur">
                        <input type="text" name="auteur" required>
                    </label>
                </td>
                <td>
                    <label for="prix">
                        <input type="text" name="prix" required>
                    </label>
                </td>
                <td>
                    <label for="image">
                        <input type="text" name="image" required>
                    </label>
                </td>
                <td>
                    <input type="submit" value="Ajouter">
                </td>
            </form>
        </tr>
    <?php for ($i = 0; $i < $length; $i++): ?>
    <tr>
        <form action="updateform&id=<?php echo $response[$i]['id'] ?>" method="post">
        <?php foreach ($response[$i] as $key => $value): ?>
            <?php if ($key === 'image'): ?>
                <td>
                    <img src="src/img/<?php echo $value ?>" alt="image">
                    <label for="image">
                        <input type="text" name="image" required value="<?php echo $response[$i]['image']?>">
                    </label>
                </td>
            <?php endif; ?>
            <?php if ($key === 'id'): ?>
                <td>
                    <?php echo $value; ?>
                </td>
            <?php endif; ?>
            <?php if ($key !== 'image' && $key !== 'id'): ?>
                <td>
                    <label for="<?php echo $key ?>">
                        <input type="text" name="<?php echo $key ?>" required value="<?php echo $value ?>">
                    </label>
                </td>
            <?php endif; ?>
        <?php endforeach; ?>
        <td><input type="submit" value="update"></td>
        </form>
        <td><a href="delete&id=<?php echo $response[$i]['id'] ?>">delete</a></td>
    </tr>
    <?php endfor; ?>
    </tbody>
</table>
