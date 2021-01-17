<?php 
// Start the session
session_start();
require('reviewDB.php');

if (isset($_SESSION["user"])) { 
    header('Location: index.php');
    exit;
}

if (isset($_POST["btnLogin"])) {
    
    if (isset($_POST["username"]) && isset($_POST["password"]) { // Verifica se existe...
        if (!empty($_POST["username"]) && !empty($_POST["password"])) { // Verifica se a string não é vazia
            $user = clean_input($_POST["username"]);
            $password = clean_input($_POST["password"]);



            if (usernameExistsInDB($user)) { // Verifica se o utilizador existe na db
                $login = mysql_query("SELECT username FROM users WHERE username = '$username' AND password = '$password'");
 
                if ($login && mysql_num_rows($login) == 1) {
             
                    // o utilizador está correctamente validado
                    // guardamos as suas informações numa sessão
                    $_SESSION['username'] = mysql_result($login, 0, 1);


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