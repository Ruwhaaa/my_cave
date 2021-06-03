<h2>Home</h2>
<?php
$response = read();
$length = count($response);

for ($i = 0; $i < $length; $i++): ?>
    <div class="bottle">
        <?php foreach ($response[$i] as $key => $value): ?>
            <?php if ($key === 'image'): ?>
            <img src="src/img/<?php echo $value ?>" alt="image">
            <?php endif; ?>
            <?php if ($key !== 'image'): ?>
            <div class="display">
                <?php echo $value; ?>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endfor; ?>