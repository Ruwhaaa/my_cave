<div class="container">
    <header>
        <h1><span class="my">MY</span><span class="cave">CAVE</span></h1>
        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <?php if (isset($_SESSION['pseudo'])): ?>
                    <li><a href="../../index.php">Admin</a></li>
                <?php endif; ?>
                <li>
                    <form action="<?php if (!isset($_SESSION['pseudo'])) echo 'login'?>" method="post">
                        <label for="pseudo">
                            <input type="text" id="pseudo" name="pseudo" placeholder="pseudo">
                        </label>
                        <label for="mdp">
                            <input type="password" id="mdp" name="mdp" placeholder="mot de passe">
                        </label>
                        <?php if (!isset($_SESSION['pseudo'])): ?>
                            <input type="submit" value="Ce connecter">
                        <?php endif; ?>
                        <?php if (isset($_SESSION['pseudo'])): ?>
                            <a href="../../index.php">Ce déconnecter</a>
                        <?php endif; ?>
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <?php if(isset($_GET['msg']) && $_GET['error'] === 'false') : ?>
        <div class="message_green"><?php echo $_GET['msg']; ?></div>
    <?php endif; ?>
    <?php if(isset($_GET['msg']) && $_GET['error'] === 'true') : ?>
        <div class="message_red"><?php echo $_GET['msg']; ?></div>
    <?php endif; ?>
</div>
