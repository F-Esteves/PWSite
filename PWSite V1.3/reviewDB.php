<?php 
	
  function estabelerConexao()
{
   // Deviam estar num ficheiro de configuração
   $hostname = "localhost";
   $databasename = "PW_Site";
   $username = "PW_User";
   $password = "1234";
   
   try {
       $conexao = new PDO("mysql:host=$hostname;dbname=$databasename;charset=utf8mb4",
                      $username, $password);
   }
   catch (\PDOException $e) {
       echo $e->getMessage();
   }

   return $conexao;

    
}

function usernameExistsInDB($username) {
  $conexao = estabelerConexao();
  var_dump($conexao);
  $stmt = $conexao->prepare("SELECT username FROM users WHERE username=:username" );
  $stmt->execute( [ 'username' => $username ] );
  $username = $stmt->fetchColumn();

  // True se for String , $username pode ser false ou ter o nome do user 
  return is_string($username);
}

function resgistUser($username, $password) {
  $conexao = estabelerConexao();
  $stmt = $conexao->prepare("INSERT INTO username( `username`, `password` ) VALUES (:username, :password )");
  
  $stmt->execute( [ 'username' => $username, 'password' => $password] );
}

?>