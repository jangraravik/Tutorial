<?php

function isLogin(){
    if(!isset($_SESSION['user_id'])) {
        goLoad("index.php");
    }
}

function set_privileges($userRole) {
    global $db;
    $query = "SELECT * FROM role_rights WHERE rr_rolecode = '".$userRole."' ORDER BY rr_modulecode ASC";
    //echo $query;exit;
    $userRights = array();
    $userRights = fetchAsoc($db,$query);
    //print_r($userRights);exit;

    $query = "SELECT mod_modulegroupcode, mod_modulegroupname, mod_modulepagename,  mod_modulecode, mod_modulename FROM module WHERE 1 ORDER BY mod_modulegrouporder ASC, mod_moduleorder ASC";
    $allModules = array();
    $allModules = fetchAsoc($db,$query);
    //print_r($allModules);exit;
    $_SESSION["access_module"] = set_access($allModules, $userRights);
}


function set_access($allModules, $userRights) {
    $data = array();
    for ($i = 0, $c = count($allModules); $i < $c; $i++) {
        $row = array();
        for ($j = 0, $c2 = count($userRights); $j < $c2; $j++) {
            if ($userRights[$j]["rr_modulecode"] == $allModules[$i]["mod_modulecode"]) {
                if (authorize($userRights[$j]["rr_create"]) || authorize($userRights[$j]["rr_edit"]) || authorize($userRights[$j]["rr_delete"]) || authorize($userRights[$j]["rr_view"])
                ) {
                    $row["menu"] = $allModules[$i]["mod_modulegroupcode"];
                    $row["menu_name"] = $allModules[$i]["mod_modulename"];
                    $row["page_name"] = $allModules[$i]["mod_modulepagename"];
                    $row["create"] = $userRights[$j]["rr_create"];
                    $row["edit"] = $userRights[$j]["rr_edit"];
                    $row["delete"] = $userRights[$j]["rr_delete"];
                    $row["view"] = $userRights[$j]["rr_view"];
                    $data[$allModules[$i]["mod_modulegroupcode"]][$userRights[$j]["rr_modulecode"]] = $row;
                    $data[$allModules[$i]["mod_modulegroupcode"]]["top_menu_name"] = $allModules[$i]["mod_modulegroupname"];
                }
            }
        }
    }
return $data;
}

function authorize($module) {
    return ($module === "yes") ? TRUE : FALSE;
}