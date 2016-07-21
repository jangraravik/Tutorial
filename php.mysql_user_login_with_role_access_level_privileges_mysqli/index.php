<?php
require_once("framework/config.php");
$pageTitle = 'Login';

if(isset($_POST['action']) && $_POST['action'] == 'Login'){
    //print_r($_POST);exit;
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); 
    $query = "SELECT * FROM system_users WHERE u_username = '".$username."' AND u_password = '".$password."'";
    $result = fetchNRow($db,$query);
    //print_r($result);
    if ($result === 1) {
        $userData = fetchAsocRow($db,$query);
        //print_r($userData);exit;
        $_SESSION["user_id"] = $userData["u_userid"];
        $_SESSION["rolecode"] = $userData["u_rolecode"];
        $_SESSION["username"] = $userData["u_username"];       
        set_privileges($_SESSION["rolecode"]);
        $_SESSION['msgs'] = msgsSet('Login Sucessfull','s');
        goLoad("dashboard.php");
    } else {
        $_SESSION['msgs'] = msgsSet('Invalid Login Details','e');
        goLoad("index.php");
    }    
}
include 'header.php';
?>
<div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal" name="contact_form" id="contact_form" method="post" action="">
            <fieldset>
                <div class="form-group">
                    <label class="col-lg-2 control-label" for="username"><span class="required">*</span>Username:</label>
                    <div class="col-lg-6">
                        <input type="text" value="" placeholder="User Name" id="username" class="form-control" name="username" required="" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label" for="password"><span class="required">*</span>Password:</label>
                    <div class="col-lg-6">
                        <input type="password" value="" placeholder="Password" id="password" class="form-control" name="password" required="" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6 col-lg-offset-2">
                        <input type="submit" class="btn btn-primary" name="action" value="Login">
                    </div>
                </div>
                <div style="height: 10px;">&nbsp;</div>
                <div class="form-group">
                    <div class="col-lg-6 col-lg-offset-2">
                       <div class="help-block">
                    <strong>Role == username/password</strong><br>
                    Super Admin == superadmin/superadmin<br>
                    Admin == admin/admin<br>
                    Staff == staff/staff<br>
                </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>