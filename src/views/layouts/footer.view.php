<?=  "<span class='new foot badge orange notif' data-badge-caption=/".trim(substr($_SERVER["REQUEST_URI"] ,12),"/").">".$_SERVER["REQUEST_METHOD"]."</span>"; ?> 
<div class="fixed-action-btn">
    <a class="btn-floating btn-large red " href="#header">
        <i class="large material-icons">keyboard_arrow_up</i>
    </a>
</div>