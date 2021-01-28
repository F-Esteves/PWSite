<?php
session_start();
require('reviewDB.php');
$jogo = getJogo($_POST["id_jogos"]);
$jogoNome = $jogo[0]["nome"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css"/>
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>GameReview</title>
<script>
	// Prevent dropdown menu from closing when click inside the form
	$(document).on("click", ".navbar-right .dropdown-menu", function(e){
		e.stopPropagation();
	});
</script>
</head>
<body>
<nav class="navbar navbar-default navbar-expand-lg navbar-light">
	<div class="navbar-header">
		<a class="navbar-brand" href="index.php">Game<b>Review</b></a>  		

	</div>
		<?php if(isset($_SESSION["username"])): ?>
            <div class="nav navbar-nav navbar-right">
               <a href="logout.php" class="navbar-brand"><strong>Logout</strong></a>
			</div>

		<?php endif; ?>	
</nav>
<?php if(isset($_SESSION["username"])): ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        <h1>Escrever Review para <?= $jogoNome?></h1>
            <form method="POST" action ="sendreview.php">
            <div class="form-group">
            <input type="number" class="form-control" name="score" placeholder="Score" min="1" max="5">
            </div>
            <div class="form-group">
            <label for="exampleFormControlTextarea1">Escreve o seu Review</label>
            <textarea class="form-control" name="review" rows="3"></textarea>
            </div>
            <input type="hidden" name="id_jogos" value="<?= $_POST['id_jogos']?>">
            <button type="submit" name="submeter" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-3">
        <h1>Reviews de <?= $jogoNome?></h2>
        <?php 
        $reviews = getReviews($_POST["id_jogos"]);
        foreach ($reviews as $review):
                echo $review["username"];
                echo "<br>";
                echo $review["score"];
                echo "<br>";
                echo $review["comentario"];
                echo "<br>";
                echo "<br>";
                    
                endforeach;?>
        </div>
</div>
</body>
<html>