<?php
session_start();

require('reviewDB.php');
$jogos = getJogos();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GameReview</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <script>
    // Prevent dropdown menu from closing when click inside the form
    $(document).on("click", ".navbar-right .dropdown-menu", function(e) {
        e.stopPropagation();
    });
    </script>
</head>

<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Game<b>Review</b></a>
		</div>
		
            <?php if (isset($_SESSION["username"])): ?>
            <div class="nav navbar-nav navbar-right">
                <a href="logout.php" class="navbar-brand"><strong>Logout</strong></a>
            </div>
			<?php endif; ?>
			
            <?php if (!isset($_SESSION["username"])) { ?>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Login</a>
                    <ul class="dropdown-menu form-wrapper">
                        <li>
                            <form action="login.php" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" placeholder="Username"
                                        required="required">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                        required="required">
                                </div>
                                <input type="submit" name="btnLogin" class="btn btn-primary btn-block" value="Login">
                                <div class="form-footer">
                                    <a href="#">Forgot Your password?</a>
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>



                <li>
                    <a href="#" data-toggle="dropdown"
                        class="btn btn-primary dropdown-toggle get-started-btn mt-1 mb-1">Sign up</a>
                    <ul class="dropdown-menu form-wrapper">
                        <li>
                            <form action="register.php" method="post">
                                <p class="hint-text">Fill in this form to create your account!</p>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Username" name="username"
                                        required="required">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                        required="required">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirm Password"
                                        name="confirm_pwd" required="required">
                                </div>
                                <div class="form-group">
                                    <label class="checkbox-inline"><input type="checkbox" name="terms"
                                            required="required"> I accept the <a href="#">Terms &amp;
                                            Conditions</a></label>
                                </div>
                                <input type="submit" name="btnRegister" class="btn btn-primary btn-block"
                                    value="Sign up">
                            </form>
                        </li>
                    </ul>
                </li>

                <?php } // End if?>
            </ul>
        </div>
    </nav>
    <section>
        <form method="POST" e action="review.php">
			<div class="fotos">
				<?php if (!isset($_SESSION["username"])) { ?>
					<?php foreach ($jogos as $jogo): ?>
						<div class="foto">
							<button type="submit" name="id_jogos" value="<?=$jogo["id_jogos"]?>">
							<img src="<?php echo $jogo['url']; ?>"></button>
						</div>
					<?php endforeach;?>
				<?php } // End if?>
			</div>
        </form>
    </section>

    <section>
        <form method="POST" e action="review.php">
            <div class="fotos">
                <?php if (isset($_SESSION["username"])): ?>
					<?php foreach ($jogos as $jogo): ?>
						<div class="foto">
							<button type="submit" name="id_jogos" value="<?=$jogo["id_jogos"]?>">
							<img src="<?php echo $jogo['url']; ?>"></button>
						</div>
					<?php endforeach;?>
                <?php endif; ?>
            </div>
        </form>
    </section>
</body>


</html>