<?php
require_once "models/admin.php";
require_once "models/users.php";

if (isset($_POST['search']) && !empty($_POST['searchValue'])){
    $search = searchUsers($_POST['search'], $_POST['searchValue']);
}

require_once "views/form_users_list.php";

