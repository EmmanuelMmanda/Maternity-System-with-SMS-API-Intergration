<?php include 'includes/database.php';
session_start() ;?>
<?php
if(isset($_POST['login'])){
        $uname = mysqli_real_escape_string($conn,$_POST['username']);
        $pass = mysqli_real_escape_string($conn,$_POST['password']);
        $password = md5($pass);
        $sql = "SELECT * FROM `maternals` WHERE `username`='$uname' AND `password`='$password'";
        $query = mysqli_query($conn,$sql);
        $result = mysqli_num_rows($query);
        if($result == 1){
        $_SESSION['maternal'] = $uname;
            echo "<script>
            alert('You have succesfully logged in..');
            window.location.href='maternals/';
        </script>";
        }
        else{
            echo "<script>
            alert('Invalid Login Credentials');
        </script>";
        }
    }

?>
<!doctype html>
<html lang="en">

<head>
    <title>Login Now</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="container mt-5">
            <div class="m-auto col-4 mx-5 bg-light rounded p-3 ">
            <div class="text-center">
                        <img src="images/Maternity.jpg" alt="" width="80px" height="80px" class="rounded-circle p-0 m-0">
                    </div>
                <form action="" method="post">
                    <div class="form-group text-center text-info">
                        <h4>Maternals - Login</h4>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" id="" class="form-control" placeholder="Enter your username" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="" class="form-control" placeholder="Enter your password" aria-describedby="helpId">
                    </div>
                    <div class="text-center">
                        <button type="submit" name="login" class="btn btn-success">Login</button>
                    </div>
                    <div class="text-center m-2">
                        <p>Dont have an Account?<a href="register.php">Register Here</a> </p>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>