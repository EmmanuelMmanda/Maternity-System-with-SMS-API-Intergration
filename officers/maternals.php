<?php include '../includes/database.php'; ?>
<?php session_start();
if(isset($_SESSION['officer'])){
    $user = $_SESSION['officer'];
}else{
    echo "<script>
    alert('Invalid Session Please relogin');
    window.location.href='../admin.php';
</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Officer</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!--Librarys for search select chosen plugin-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
    <style>
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 90px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        z-index: 99;
        font-size: 18px;

    }

    @media (max-width: 767.98px) {
        .sidebar {
            top: 11.5rem;
            padding: 0;
        }
    }

    .navbar {
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
    }

    @media (min-width: 767.98px) {
        .navbar {
            top: 0;
            position: sticky;
            z-index: 999;
        }
    }

    .sidebar .nav-link {
        color: #333;
    }

    .sidebar .nav-link.active {
        color: #0d6efd;
    }
    </style>
</head>

<body>
    <?php include '../includes/officer_header.php' ?>
    <div class="container-fluid">
        <div class="row">
            <?php include '../includes/officer_nav.php' ?>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Maternals</li>
                    </ol>
                </nav>
                <h1 class="h2">Maternals</h1>
                <div class="container-fluid">
                    <div class="container">
                        <div class="w-75 m-auto col-6 text-info">
                            <h5 class="text-center">Select a Maternal to View Details</h5>
                            <hr>
                            <form action="" class="col-7 m-auto" method="post">
                                <select name="maternal" class="chosen form-group col-9" style="padding: 20px;">
                                    <?php
                                    $sql = "SELECT * FROM `maternals`";
                                    $query = mysqli_query($conn,$sql);
                                    $num_rows = mysqli_num_rows($query);
                                    if($num_rows>0){
                                        while($data = mysqli_fetch_assoc($query)){
                                            ?>
                                    <option value="<?php echo $data['username']; ?>"><?php echo $data['fullname']; ?>
                                    </option>
                                    <?php
                                        }
                                    }
                                ?>
                                </select>
                                <button type="submit" name="view-details" class="btn btn-primary btn-sm">View
                                    Details</button>
                            </form>
                        </div>

                    </div>
                </div>

                <?php
    if(isset($_POST['view-details'])){
        $queryname = $_POST['maternal'];
        $sql = "SELECT maternals.* , diagnosis.* FROM `maternals`,`diagnosis` WHERE username = '$queryname' && `maternal_uname`='$queryname'";
        $query = mysqli_query($conn,$sql);
        if($query==TRUE){
            if($data = mysqli_fetch_assoc($query)){
                $fullname = $data['fullname'];
                $phone = $data['phone'];
                $address = $data['address'];
                $birthdate = $data['birth_date'];
                $weight = $data['weight'];
                $blood = $data['blood_group'];
                $stage = $data['stage'];
                $remarks = $data['remarks'];
?>
                <div class="container">
                    <div class="card col-11 p-2 m-auto bg-light">
                        <div class="card-body p-2">
                            <div class="row mx-2">
                                <p> <u>Profile Information</u> </p>
                                <div class="col-6">
                                    <label for="">Full Name:</label>
                                    <p><?php echo $fullname; ?></p>
                                </div>
                                <div class="col-6">
                                    <label for="">Phone Number:</label>
                                    <p><?php echo $phone; ?></p>
                                </div>
                                <div class="col-6">
                                    <label for="">Address/Residency:</label>
                                    <p><?php echo $address; ?></p>
                                </div>
                                <div class="col-6">
                                    <label for="">Date of Birth:</label>
                                    <p><?php echo $birthdate; ?></p>
                                </div>
                                <hr>
                                <p> <u>Diagosis Information</u> </p>
                                <div class="col-6">
                                    <label for="">Weight:</label>
                                    <p><?php echo $weight; ?> kg</p>
                                </div>
                                <div class="col-6">
                                    <label for="">Blood Group:</label>
                                    <p><?php echo $blood; ?></p>
                                </div>
                                <div class="col-6">
                                    <label for="">Stage:</label>
                                    <p><?php echo $stage; ?></p>
                                </div>
                                <div class="col-6">
                                    <label for="">Remarks:</label>
                                    <p><?php echo $remarks; ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <?php
            }else{
                echo "<script>
                alert(' Error ! Please Add Diagnosis data into Maternals Record !!');
                window.location.href='diagnosis.php';
            </script>";
            }
        }
    }
    ?>
            </main>
        </div>
    </div>

    <script type="text/javascript">
    $(".chosen").chosen();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>

</body>

</html>