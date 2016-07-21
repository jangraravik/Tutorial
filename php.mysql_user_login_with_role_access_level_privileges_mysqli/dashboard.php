<?php

require_once("framework/config.php");
isLogin();
$pagetitle = "Dashboard";

include 'header_panel.php';
?>
<div class="row">
    <div class="col-lg-12">
        <h3>Business Modules</h3>
        <div class="well well-sm">
            <ul class="list-group">
                <?php foreach ($_SESSION["access_module"] as $key => $access) { ?>
                    <li class="list-group-item">
                        <?php echo $access["top_menu_name"]; ?>
                        <?php
                        echo '<ul>';
                        foreach ($access as $k => $val) {
                            if ($k != "top_menu_name") {
                                echo '<li><a href="' . ($val["page_name"]) . '">' . $val["menu_name"] . '</a></li>';
                                ?>
                                <?php } } echo '</ul>';
                        ?>
                    </li>
                    <?php } ?>
            </ul>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>