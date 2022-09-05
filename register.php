<?php include 'includes/database.php'; error_reporting(0);?>
<?php
if(isset($_POST['register'])){
        $fname = mysqli_real_escape_string($conn,$_POST['fullname']);
        $uname = mysqli_real_escape_string($conn,$_POST['username']);
        $pass = mysqli_real_escape_string($conn,$_POST['password1']);
        $pass2 = mysqli_real_escape_string($conn,$_POST['password2']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $phone = mysqli_real_escape_string($conn,$_POST['phone']);
        $address = mysqli_real_escape_string($conn,$_POST['address']);
        $birth_date = mysqli_real_escape_string($conn,$_POST['birth_date']);


        $sql = "SELECT * FROM `maternals` WHERE `username`='$uname'";
        $query = mysqli_query($conn,$sql);
        $result = mysqli_num_rows($query);
            if($result == 1){
            echo "<script>
            alert('Username Already Exists.');
            window.location.href='/';
        </script>";
            }elseif($pass != $pass2){
                echo "<script>
                alert('Passwords do not match');
                window.location.href='#';
            </script>";
            }else{
                $password = md5($pass);
                $register = "INSERT INTO `maternals`(fullname,username,password,email,phone,address,birth_date) 
                 VALUES('$fname','$uname','$password','$email','$phone','$address','$birth_date')";
                 $out = mysqli_query($conn,$register);
                 if ($out == TRUE){
                    echo "<script>
                    alert('Registration Succesfull! Please Login.');
                    window.location.href='index.php';
                </script>";                    
            }else{
                echo "<script>
                alert('Failed to register');
                window.location.href='#';
            </script>";                    }
                }
         }

?>
<!doctype html>
<html lang="en">

<head>
    <title>Register Here</title>
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
            <div class="m-auto col-5 bg-light rounded">
                <form action="" method="post">
                    <div class="form-group text-center text-info">
                        <h4>Maternals Registration Form</h4>
                    </div>
                    <div class="form-group p-0 m-0">
                        <label for="">Full Name</label>
                        <input type="text" name="fullname" id="" class="form-control" placeholder="fullname"
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group p-0 m-0">
                        <label for="">Username</label>
                        <input type="text" name="username" id="" class="form-control" placeholder="username"
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group row d-flex p-0 m-0">
                        <div class="col-6 m-0 p-0">
                            <label for="">Password</label>
                            <input type="password" name="password1" id="" class="form-control" placeholder="password"
                                aria-describedby="helpId">
                        </div>
                        <div class="col-6 m-0 p-0">
                            <label for="">Repeat Password</label>
                            <input type="password" name="password2" id="" class="form-control"
                                placeholder="repeat password" aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="form-group p-0 m-0">
                        <label for="">Phone Number</label>
                        <input type="text" name="phone" id="" class="form-control" placeholder="ie. 0769654545"
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group p-0 m-0">
                        <label for="">Email</label>
                        <input type="text" name="email" id="" class="form-control" placeholder="Email address"
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group row d-flex p-0 mb-1">
                        <div class="form-group m-auto col-5 p-0 m-0">
                            <label for="">Address</label>
                            <input type="text" name="address" id="" class="form-control" placeholder="Address"
                                aria-describedby="helpId">
                        </div>
                        <div class="form-group col-6 mr-1 p-0 m-0">
                            <label for="">Date of Birth</label>
                            <input type="date" name="birth_date" id="" class="form-control" placeholder="Address"
                                aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="text-center p-1">
                        <button type="submit" name="register" class="btn btn-success">Register</button>
                    </div>
                    <div class="text-center m-2">
                        <p>Already have an Account?<a href="index.php">Login Here</a> </p>
                    </div>
                </form>

            </div>
        </div>
    </div>

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