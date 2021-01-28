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
      
    } catch(PDOException $e) {
    }
    return $conn;
  }
   

    function getJogos() {

      $conexao = estabelecerConexao();

      $stmt = $conexao->query('SELECT * FROM jogos');
  
      $jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
      return $jogos;
  
  }

  function getJogo($idjogo) {

    $conexao = estabelecerConexao();

    $stmt = $conexao->query("SELECT * FROM jogos where id_jogos = $idjogo");

    $jogo = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $jogo;

}

  function getReviews($idjogo){
    $conexao = estabelecerConexao();

      $stmt = $conexao->query("SELECT username, score, comentario FROM review a NATURAL JOIN jogos b NATURAL JOIN users c WHERE a.id_jogos = $idjogo");
  
      $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
      return $reviews;
  }
  
  function usernameExistsInDB($username) {
    $conexao = estabelecerConexao();
    $stmt = $conexao->prepare("SELECT username FROM users WHERE username=:username" );
    $stmt->execute( [ 'username' => $username ] );
    $username = $stmt->fetchColumn();
  
    // True se for String , $username pode ser false ou ter o nome do user 
    return is_string($username);
  }
  
  function resgistUser($username, $password) {
    $phash = password_hash($password, PASSWORD_DEFAULT);
    $conexao = estabelecerConexao();
    $stmt = $conexao->prepare("INSERT INTO users( `username`, `password` ) VALUES (:username, :password )");
    $stmt->execute( [ 'username' => $username, 'password' => $phash] );
  }

  function sendReview($id_jogos, $user_id, $score, $comentario) {
    $conexao = estabelecerConexao();
    $stmt = $conexao->prepare("INSERT INTO review( `id_jogos`, `user_id`, `score`, `comentario` ) VALUES (:id_jogos, :user_id, :score, :comentario )");
    $stmt->execute( [ 'id_jogos' => $id_jogos, 'user_id' => $user_id, 'score' => $score, 'comentario' => $comentario] );
  }

  function getUserByName($username){
    $conexao = estabelecerConexao();
    $stmt = $conexao->prepare("SELECT username, password, user_id FROM users WHERE username = :username");
    $stmt->execute( [ 'username' => $username ] );
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }


  function getUserFromDB($username, $password){
      $conexao = estabelecerConexao();
      
      $user = getUserByName($username);
      
      if (count($user) !== 0) {
        $dbPassword = $user[0]["password"];

        if (password_verify($password, $dbPassword)) {
          $stmt = $conexao->prepare("SELECT username, password, user_id FROM users WHERE username = :username AND password = :password");
          $stmt->execute( [ 'username' => $username, 'password' => $dbPassword] );
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
        }
      }
      return;
    }
  
  ?>