<?php
session_start();
?>
<?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <ul>
            <?php foreach ($_SESSION['error'] as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php session_unset(); ?>
<?php endif; ?>