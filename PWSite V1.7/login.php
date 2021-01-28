<?php 
// Start the session
session_start();
require('reviewDB.php');

if (isset($_SESSION["username"])) { 
    header('Location: index.php');
    exit;
}

if (isset($_POST["btnLogin"])) {
    if (isset($_POST["username"]) && isset($_POST["password"])) { // Verifica se existe...
        if (!empty($_POST["username"]) && !empty($_POST["password"])) { // Verifica se a string não é vazia
            $username = clean_input($_POST["username"]);
            $password = clean_input($_POST["password"]);

            $user = getUserFromDB($username, $password);                

            
            if (isset($user)) { // Verifica se o utilizador existe na db
                
                // o utilizador está correctamente validado
                // guardamos as suas informações numa sessão

                $username = $user[0]["username"];
                $id = $user[0]["user_id"];
                $_SESSION['username'] = $username; // Guarda o username numa variavel de sessão
                $_SESSION["user_id"] = $id; 

                header('Location: index.php?success');
                exit;
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


