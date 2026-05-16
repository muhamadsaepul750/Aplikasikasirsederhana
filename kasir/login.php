<?php
	@ob_start();
	session_start();
	if(isset($_POST['proses'])){
		require 'config.php';
			
		$user = strip_tags($_POST['user']);
		$pass = strip_tags($_POST['pass']);

		$sql = 'select member.*, login.user, login.pass
				from member inner join login on member.id_member = login.id_member
				where user =? and pass = md5(?)';
		$row = $config->prepare($sql);
		$row -> execute(array($user,$pass));
		$jum = $row -> rowCount();
		if($jum > 0){
			$hasil = $row -> fetch();
			$_SESSION['admin'] = $hasil;
			echo '<script>alert("Login Sukses");window.location="index.php"</script>';
		}else{
			echo '<script>alert("Login Gagal");history.go(-1);</script>';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login To Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            color: #fff;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 40px 50px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }
        .login-container h2 {
            margin-top: 0;
            margin-bottom: 30px;
            font-weight: 600;
            letter-spacing: 1px;
            font-size: 26px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 12px 20px;
            color: #fff;
            margin-bottom: 20px;
            height: auto;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .btn-login {
            background: linear-gradient(to right, #3a7bd5, #00d2ff); 
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #fff;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        .btn-login:hover {
            box-shadow: 0 8px 20px rgba(0, 210, 255, 0.4);
            transform: translateY(-2px);
            color: #fff;
        }
        .icon-user {
            font-size: 60px;
            margin-bottom: 15px;
            color: #00d2ff;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));
        }
    </style>
  </head>

  <body>
      <div class="login-container">
          <i class="fa fa-user-circle icon-user"></i>
          <h2>KASIR TOKO ATK</h2>
          <form method="POST">
            <input type="text" class="form-control" name="user" placeholder="User ID" autofocus required>
            <input type="password" class="form-control" name="pass" placeholder="Password" required>
            <button class="btn btn-login btn-block" name="proses" type="submit">
                <i class="fa fa-sign-in"></i> SIGN IN
            </button>
          </form>	  	
      </div>
  </body>
</html>

