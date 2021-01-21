<?php 
    
    function estabelecerConexao()
  {
    $hostname = "localhost";
    $databasename = "gamereview";
    $username = "root";
    $password = "";
    
  
  
    try {
      $conn = new PDO("mysql:host=$hostname;dbname=$databasename", $username, $password); // conexão padrão para DB em MYSQL
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
  }
   
  
    function getFotos() 
    {
        $conexao = estabelecerConexao();
    
        $stmt = $conexao->query('SELECT * FROM fotos');
    
        $fotos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $fotos;
    }
  
  function usernameExistsInDB($username) {
    $conexao = estabelecerConexao();
    var_dump($conexao);
    $stmt = $conexao->prepare("SELECT username FROM users WHERE username=:username" );
    $stmt->execute( [ 'username' => $username ] );
    $username = $stmt->fetchColumn();
  
    // True se for String , $username pode ser false ou ter o nome do user 
    return is_string($username);
  }
  
  function resgistUser($username, $password) {
    $conexao = estabelecerConexao();
    $stmt = $conexao->prepare("INSERT INTO users( `username`, `password` ) VALUES (:username, :password )");
    $stmt->execute( [ 'username' => $username, 'password' => $password] );
  }

  function getUserFromDB($username, $password){
      $conexao = estabelecerConexao();
      $stmt = $conexao->prepare("SELECT username, password FROM users WHERE username = :username AND password = :password");
      $stmt->execute( [ 'username' => $username, 'password' => $password] );
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $result;
  }
  
  ?>