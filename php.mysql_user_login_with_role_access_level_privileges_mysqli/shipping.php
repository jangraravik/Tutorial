<?php

require_once("framework/config.php");
isLogin();
$pagetitle = "Shipping";


$status = FALSE;
if ( authorize($_SESSION["access_module"]["CHECKOUT"]["SHIPPING"]["create"]) || authorize($_SESSION["access_module"]["CHECKOUT"]["SHIPPING"]["edit"]) || authorize($_SESSION["access_module"]["CHECKOUT"]["SHIPPING"]["view"]) || 
authorize($_SESSION["access_module"]["CHECKOUT"]["SHIPPING"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include 'header_panel.php';
?>
<div class="row">
    <div class="col-lg-12">

        <?php if (authorize($_SESSION["access_module"]["CHECKOUT"]["SHIPPING"]["create"])) { ?>
            <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-plus"></i> ADD SHIPPING</button> 
        <?php } ?>
        <div style="height: 10px;">&nbsp;</div>

        <div class=" table-responsive">
            <table class="table table-striped table-hover ">
                <tbody><tr>
                        <th>#</th>
                        <th>Sample heading</th>
                        <th>Sample heading</th>
                        <th style="width: 280px;">Actions</th>
                    </tr>
                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>Sample content</td>
                            <td>Sample content</td>
                            <td>
                                <?php if (authorize($_SESSION["access_module"]["CHECKOUT"]["SHIPPING"]["edit"])) { ?>
                                    <button class="btn btn-sm btn-info" type="button"><i class="fa fa-edit"></i> EDIT</button> 
                                <?php } ?>
                                <?php if (authorize($_SESSION["access_module"]["CHECKOUT"]["SHIPPING"]["view"])) { ?>
                                    <button class="btn btn-sm btn-warning" type="button"><i class="fa fa-search-plus"></i> VIEW</button>
                                <?php } ?>
                                <?php if (authorize($_SESSION["access_module"]["CHECKOUT"]["SHIPPING"]["delete"])) { ?>
                                    <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash-o"></i> DELETE</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody></table>
        </div>

    </div>
</div>
<?php include 'footer.php'; ?>