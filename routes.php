<?php
$page = ($_GET['page']??'login');

switch ($page) {
    case 'register':
        do_register();
        break;
    case 'login':
        do_login();
        break;

    case 'mail-validation':
        mail_validation();
        break;

    default:
       do_not_found();
        break;
}