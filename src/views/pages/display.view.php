
<?php use App\Views\Components\TableComponent; ?>
<?php $GLOBALS['title'] = 'Display'; ?>

<?php ob_start(); ?>
  <script type='module' src='<?= src("script/app.js") ?>'></script>
<?php $GLOBALS['script'] = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php $GLOBALS['style'] = ob_get_clean(); ?>

<?php ob_start(); ?>
    
<div class="row">
  <div class="col s12">
    <ul class="tabs">
      <li class="tab col s2"><a href="#queries">Query</a></li>
      <li class="tab col s2"><a href="#tags" id='toto'>Tag</a></li>
      <li class="tab col s2"><a href="#videos">Video</a></li>
      <li class="tab col s2"><a href="#channels">Channel</a></li>
      <li class="tab col s2"><a href="#comments">Comment</a></li>
    </ul>
  </div>
  <div id="queries" class="col s12"><!--Test 1-->
    <?php
      $queries  = App\Models\Query::all();
      echo new TableComponent(
          $queries->jsonSerialize(),
          App\Models\Query::colums(),
           $queries->count(),
        );
      ?>
  </div>
  <div id="tags" class="col s12"><!--Test 2-->
  <?php
      $tags  = App\Models\Tag::all();
      echo new TableComponent( 
          $tags->jsonSerialize(),
          App\Models\Tag::colums(),
          $tags->count(),
        ); 
      ?>
  </div>
  <div id="videos" class="col s12"><!--Test 3-->
  <?php
      $videos  = App\Models\Video::all();
      echo new TableComponent( 
          $videos->jsonSerialize(),
          App\Models\Video::colums(),
          $videos->count(),
        ); 
      ?>
  </div>
  <div id="channels" class="col s12"><!--Test 4-->
  <?php
      $channels  = App\Models\Channel::all();
      echo new TableComponent( 
          $channels->jsonSerialize(),
          App\Models\Channel::colums(),
          $channels->count(),
        ); 
      ?>
  </div>
  <div id="comments" class="col s12"><!--Test 5-->
  <?php
      $comments  = App\Models\Comment::all();
      echo new TableComponent( 
          $comments->jsonSerialize(),
          App\Models\Comment::colums(),
          $comments->count(),
        ); 
      ?>
  </div>
</div>        

<?php $GLOBALS['content'] = ob_get_clean(); ?>

<?=layout("app"); ?>  