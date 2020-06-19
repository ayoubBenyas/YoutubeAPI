<?php $GLOBALS['title'] = '404 - Page Not Found'; ?>

<?php ob_start(); ?>
  <link rel="stylesheet" href="<?= src('style/404.css') ?>" />
<?php $GLOBALS['style'] = ob_get_clean(); ?>

<?=  $GLOBALS['script'] = null; ?>
<?php ob_start(); ?>

  <div class="error-page">
    <h2 >404</h2>
    <h1 >Page Not Found</h1>
    <?php
    
      $_SERVER["REQUEST_METHOD"].">".trim(substr($_SERVER["REDIRECT_URL"] ,12),"/")
    ?>
    <h3 > <?php echo $_SERVER["REQUEST_METHOD"] ?> </h3>
    <h1 > <?php echo substr($_SERVER["REDIRECT_URL"] ,12) ?> </h1>
  </div>
<?php $GLOBALS['content'] = ob_get_clean(); ?>

<?= layout("app"); ?>
