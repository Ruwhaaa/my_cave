<div class="container">
    <header>
        <h1><span class="my">MY</span><span class="cave">CAVE</span></h1>
        <nav>
            <ul>
                <li><a href="home">Home</a></li>
                <li><a href="admin">Admin</a></li>
                <li>
                    <form action="../../../index.php" method="post">
                        <label for="pseudo">
                            <input type="text" id="pseudo" name="pseudo" placeholder="pseudo">
                        </label>
                        <label for="mdp">
                            <input type="password" id="mdp" name="mdp" placeholder="mot de passe">
                        </label>
                        <input type="submit" value="Ce connecter">
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
