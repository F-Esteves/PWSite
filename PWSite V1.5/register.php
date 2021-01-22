<?php 
// Start the session
session_start();
require('reviewDB.php');

if (isset($_SESSION["username"])) { // Se existe uma sessão...
    header('Location: index.php');
    exit;
}

if (isset($_POST["btnRegister"])) {
    
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm_pwd"]) && isset($_POST["terms"]) ) { // Verifica se existe...
        if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["confirm_pwd"]) && !empty($_POST["terms"]) ) { // Verifica se a string não é vazia
            $username = clean_input($_POST["username"]);
            $password = clean_input($_POST["password"]);
            $confirmPwd = clean_input($_POST["confirm_pwd"]);
            $term = clean_input($_POST["terms"]);

            if ($term && !usernameExistsInDB($username)) { // Verifica se o utilizador não existe na db
               if ($password === $confirmPwd) {// Se as passwords inseridas forem iguais 
                    resgistUser($username, $password);

                    $_SESSION["username"] = $username;


                    header('Location: index.php?success');
                    exit;
               }  
                   
               
            }
        }
    }
}

header('Location: index.php');
exit;

function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}