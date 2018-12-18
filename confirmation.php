<?php
    
    session_start();
    
    $user_id = $_GET['id'];
    $token = $_GET['token'];
    
    require "bdd/database.php";
    require "include/functions.php";
    
    $user = recupereUtilisateur($user_id);

    if($user && $user->confirmation_cle == $token )
    {
        updateUtilisateur($user_id);
        $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
        $_SESSION['auth'] = $user;
        header('Location: login.php');
    }
    else
    {
        $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
        header('Location: creation_compte.php');
    }
?>