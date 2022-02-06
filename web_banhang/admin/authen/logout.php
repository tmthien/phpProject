<?php

    // setcookie('login', 'true', time()-7*24*60*60, '/');

    // header('Location: login.php');
    // die();
    //=========================================================

    // require_once('../../utils/utility.php');
    // require_once('../../database/dbhelper.php');

    // $token = getCookie('token');
    // setcookie('token', '', time() -100, '/');
    // $

    //=========================================================
    session_start();

    
        $token = '';
    
        if (isset($_COOKIE['token'])) {
        	require_once ('../../database/dbhelper.php');
        	require_once ('../../utils/utility.php');
        
        	$token = $_COOKIE['token'];
        	$sql   = "update user set tokens = null where token = '$token'";
        	execute($sql);
        }
        
        setcookie('token', '', time()-7*24*60*60, '/');
        
        header('Location: login.php');
        session_destroy();