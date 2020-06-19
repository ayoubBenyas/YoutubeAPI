<?php 
  use App\Views\Components\TableComponent;
  $analyzer  = new App\Services\Analyzer();
?>
<?php $GLOBALS['title'] = 'Analyse'; ?>

<?php ob_start(); ?>
  <script type='module' src='<?= src("script/app.js") ?>'></script>
<?php $GLOBALS['script'] = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php $GLOBALS['style'] = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="container">
 

  <ul class="collapsible">
    <li class="collapsible-header"><h4 >Queries analyser</h4></li>
    <li>
      <div class="collapsible-header"><i class="material-icons">whatshot</i>id and title of the most liked video for each request</div>
      <div class="collapsible-body">
      <?php
        $analyzer->qury1();
        echo new TableComponent(
            $analyzer->getItems(),
            $analyzer->getColumns(),
          );
      ?>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">whatshot</i>id and title of the most liked video for each request</div>
      <div class="collapsible-body">
      <?php
        $analyzer->qury2();
        echo new TableComponent(
            $analyzer->getItems(),
            $analyzer->getColumns(),
          );
      ?>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">whatshot</i>Number of videos were uploaded for each request and year</div>
      <div class="collapsible-body">
      <?php
        $analyzer->qury3();
        echo new TableComponent(
            $analyzer->getItems(),
            $analyzer->getColumns(),
          );
      ?>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">whatshot</i>Total comments for each video and total users who wrote these comments</div>
      <div class="collapsible-body">
      <?php
        $analyzer->qury4();
        echo new TableComponent(
            $analyzer->getItems(),
            $analyzer->getColumns(),
          );
      ?>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">whatshot</i>id and title of the most liked video about a specified query</div>
      <div class="collapsible-body">
        <a href="#modal1" class=" modal-trigger waves-effect waves-light btn">Select Query</a>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">whatshot</i>The video that received the maximum of comments for each request</div>
      <div class="collapsible-body">
          <span>Lorem ipsum dolor sit amet.</span>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">whatshot</i>User who wrote the most liked comment about the most loved video for each request</div>
      <div class="collapsible-body">
          <span>Lorem ipsum dolor sit amet.</span>
      </div>
    </li>
  </ul>
</div>


<!-- Modal Structure -->
<div id="modal1" class="modal">
  <div class="modal-content">
    <h4>Queries analyser</h4>
    <p>id and title of the most liked video about a specified query?</p>
    <form methode="post" id='modalF'> 
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Query ?</label>
        <input type="text" class="form-control" placeholder="Query ?" default="PROGRAMMING" id="word" autofocus>
      </div>
      <button   name='request5' type="submit" class="waves-effect waves-light btn"  >Get The Video</button>
    </form>
    <p class="flow-text">
    <?php
        $analyzer->qury5('PROGRAMMING');
        echo new TableComponent(
            $analyzer->getItems(),
            $analyzer->getColumns(),
          );
      ?>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok</a>
  </div>
</div>



<div class="row" id="myContainer0" style="width: 90%; margin-left: 5%">
  <table class="table highlight" id="table">
  </table>
</div>

<?php $GLOBALS['content'] = ob_get_clean(); ?>

<?= layout("app"); ?>



