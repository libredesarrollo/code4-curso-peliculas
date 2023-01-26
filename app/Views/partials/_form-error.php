<?php if (session('validation')) : ?>
    <div class="container mt-4">
        <?php foreach (session('validation')->getErrors() as $error) : ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif ?>