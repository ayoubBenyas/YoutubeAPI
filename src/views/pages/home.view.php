<?php $GLOBALS['title'] = "Home"; ?>

<?php ob_start(); ?>
  <script src="<?= asset('js/jquery-ui.min.js') ?>"></script>
  
  <script type='text/javascript' src='<?= src("script/autoComplete.js") ?>'></script>
  <script type='module' src='<?= src("script/app.js") ?>'></script>
  
<?php $GLOBALS['script'] = ob_get_clean(); ?>

<?php ob_start(); ?>
  <link rel="stylesheet" href="<?= asset('css/jquery-ui.min.css') ?>" />
<?php $GLOBALS['style'] = ob_get_clean(); ?>

<?php ob_start(); ?>

  <div class="container">
    <div id="content2">
      <form id="search-form"  method="GET">
        <div class="row">
          
          <div class="col s12 l10">
            <div class="input-field col s12">
              <i class="material-icons prefix">youtube_searched_for</i>
              <input type="text" name="q" id="search-input" class="autocomplete" value="Programming" autofocus require>
              <label for="autocomplete-input">Search</label>
            </div>
          </div>
          
          <div class="input-field col s2 ">
            <input id="maxResults" name="maxResults" type="number" class="validate" min="1" max="50" maxlength="2" value="20" require>
            <label for="maxResults">Max</label>
          </div>

          
          <div class="input-field col s5 l3">
            <input type="date" name="publishedAfter" id="publishedAfter" title="published After"  value="2000-01-01"  required >
          </div>
          
          <div class="input-field col s5 l3">
            <input type="date" name="publishedBefore" id="publishedBefore" title="published Before"  value="2018-01-01" >
          </div>

          <div class="input-field col s9 l4">
            <input type="submit" value="Get Search" name="submit" id="getSearch" class="btn teal" style="width:100%; height:40pt;" >
          </div>

          <div class="switch col s3 l2 ">
            <label class="center">
              off
              <input type="checkbox" id="affect-db">
              <span class="lever"></span>
              on
            </label>
          </div>

        </div>            
      </form>
      
      <br>
      <div class="progress center" id="searchProgress" hidde>
        <div class="indeterminate" ></div>
      </div>
            
      <div class="row" id="myContainer">
      </div>

    </div>
  </div>
  
<?php  $GLOBALS['content'] = ob_get_clean(); ?>

<?= layout("app"); ?>