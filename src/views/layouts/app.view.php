

<!DOCTYPE html>
<html >

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="<?= asset('favicon.png') ?>" />
  <script src="<?= asset('js/jquery-3.2.1.min.js')?>" ></script>
  <script src="<?= asset('js/jquery.min.js') ?>" ></script>
  
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="<?= asset('css/materialize.min.css') ?>">
  
  <!-- Compiled and minified JavaScript -->
  <script src="<?= asset('js/materialize.min.js') ?>"></script>
  
  <!-- Icon -->
  <link href="<?= asset('css/icon.css') ?>" rel="stylesheet">
  

  <script type='text/javascript' src='<?= src("script/main.js") ?>'></script>
  <?= $GLOBALS['style'] ?>
  <link rel='stylesheet' type='text/css' href='<?= src("style/main.css") ?>'>
  <?= $GLOBALS['script'] ?>

  <title><?= $GLOBALS['title'] ?> | YTB-API-v3</title>
</head>

<body>
  <?= layout("header"); ?>
  
  <section style=" margin-top: 50px;">
    <?= $GLOBALS['content']; ?>
  </section>


  <?= layout("footer"); ?>

</body>

</html>