<?php
require ("php/datamanager/datamanager.php");
$response = read();
$length = count($response);
?>

<table id="admin">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Year</th>
            <th>Grapes</th>
            <th>Country</th>
            <th>Region</th>
            <th>Description</th>
            <th>Picture</th>
        </tr>
    </thead>
    <?php if(isset($_GET['msg'])) : ?>
        <p><?php echo $_GET['msg']; ?></p>
    <?php endif; ?>
    <tbody>
        <tr>
            <form action="adminForm" method="POST" enctype="multipart/form-data">
                <td>

                </td>
                <td>
                    <label for="name">
                        <input type="text" name="name" id="name" required>
                    </label>
                </td>
                <td>
                    <label for="year">
                        <input type="text" name="year" id="year" required>
                    </label>
                </td>
                <td>
                    <label for="grapes">
                        <input type="text" name="grapes" id="grapes" required>
                    </label>
                </td>
                <td>
                    <label for="country">
                        <input type="text" name="country" id="country" required>
                    </label>
                </td>
                <td>
                    <label for="region">
                        <input type="text" name="region" id="region" required>
                    </label>
                </td>
                <td>
                    <label for="description">
                        <input type="text" name="description" required>
                    </label>
                </td>
                <td>
                    <label for="picture">
                        <input type="hidden" name="MAX_FILE_SIZE" value="4194304">
                        <input type="file" name="picture" id="picture" required>
                    </label>
                </td>
                <td>
                    <input type="submit" value="Ajouter">
                </td>
            </form>
        </tr>
    <?php for ($i = 0; $i < $length; $i++): ?>
    <tr>
        <form action="adminForm&id=<?php echo $response[$i]['id'] ?>" method="post" enctype="multipart/form-data">
        <?php foreach ($response[$i] as $key => $value): ?>
            <?php if ($key === 'picture'): ?>
                <td>
                    <img src="src/img/<?php echo $value ?>" alt="image">
                    <label for="picture">
                        <input type="text" name="image" required value="<?php echo $response[$i]['image']?>">
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
        </form>
        <td><a href="delete&id=<?php echo $response[$i]['id'] ?>">delete</a></td>
    </tr>
    <?php endfor; ?>
    </tbody>
</table>
