<?php include '../includes/database.php'; error_reporting(0);?>
<?php session_start();
if(isset($_SESSION['maternal'])){
    $user = $_SESSION['maternal'];
}else{
    echo "<script>
    alert('Invalid Seesion Please relogin');
    window.location.href='../';
</script>";
}
?>
<?php
   $sql = "SELECT * FROM `maternals` WHERE `username`='$user'";
   $query = mysqli_query($conn,$sql);
   $data = mysqli_fetch_assoc($query);
   if($query){
        $fullname= $data['fullname'];
        $phone = $data['phone'];
        $email = $data['email'];
        $address = $data['address'];
        $birthdate= $data['birth_date'];

   }else{
    echo "<script>
	alert('Failed to retrieve Maternal's Personal Records');
	window.location.href='';
</script>";
   } 
   // retrieve diagnosis data
   $sql = "SELECT * FROM `diagnosis` WHERE `maternal_uname`='$user' order by id DESC";
   $query = mysqli_query($conn,$sql);
   if($query){
        $weight=$diag_date=$blood ='';
        $data = mysqli_fetch_assoc($query);
        $weight= $data['weight'];
        $stage= $data['stage'];
        $diag_date = $data['diag_date'];
        $blood = $data['blood_group'];
        $remarks= $data['remarks'];

   }else{
    echo "<script>
	alert('Failed to retrieve Maternal's Personal Records');
	window.location.href='';
</script>";
   } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maternals | Medical Officer</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
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
    <?php include '../includes/header.php' ?>
    <div class="container-fluid">
        <div class="row">
            <?php include '../includes/maternals-nav.php' ?>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Diagnosis</li>
                    </ol>
                </nav>
                <h1 class="h2">Maternals Profile & Diagnosis Information.</h1>
                <div class="container">
                    <div class="card p-2  m-auto bg-light">
                        <div class="card-body p-2">
                            <div class="row mx-2 my-2 p-2">
                                <p> <u>Profile Information</u> </p>
                                <div class="col-6 my-2">
                                    <label for="">Full Name:</label>
                                    <td><?php echo $fullname; ?></td>
                                </div>
                                <div class="col-6 my-2">
                                    <label for="">Phone Number:</label>
                                    <td>255<?php echo $phone; ?></td>
                                </div>
                                <div class="col-6 my-2">
                                    <label for="">Address/Residency:</label>
                                    <td><?php echo $address; ?></td>
                                </div>
                                <div class="col-6 my-2">
                                    <label for="">Date of Birth:</label>
                                    <td><?php echo $birthdate; ?></td>
                                </div>
                                <hr>
                                <p> <u>Diagosis Information</u> </p>
                                <div class="col-6 my-2">
                                    <label for="">Weight:</label>
                                    <td><?php echo $weight; ?> kg</p>
                                </div>
                                <div class="col-6 my-2">
                                    <label for="">Blood Group:</label>
                                    <td><?php echo $blood; ?></td>
                                </div>
                                <div class="col-6 my-2">
                                    <label for="">Stage:</label>
                                    <td><?php echo $stage; ?></td>
                                </div>
                                <div class="col-6 my-2">
                                    <label for="">Doctor Remarks:</label>
                                    <td><?php echo $remarks; ?></td>
                                </div>
                                <hr>
                                <!--child ihhnformation is post natal stage-->
                                <p> <u>Childs Informations </u><small class="text-primary">*Available for Post Natal
                                        Maternals Only !!</small> </p>
                                <div class="table">
                                    <table class="table table-striped table-bordered rounded" border="1">
                                        <thead class="">
                                            <tr>
                                                <th>#</th>
                                                <th>Child Name</th>
                                                <th>Date Of Birth</th>
                                                <th>Gender</th>
                                                <th>Blood Group</th>
                                                <th>Weight</th>
                                                <th>Vaccinated</th>
                                                <th>Doctor Remarks</th>
                                            </tr>
                                        </thead>
                                        <?php 

                                                $sql = "select stage,maternal_uname from diagnosis WHERE `maternal_uname`='$user' order by id DESC";
                                                $query = mysqli_query($conn,$sql);
                                                $data =mysqli_fetch_assoc($query);
                                                if($data['stage']=='Post Natal'){
                                                    $sql = "SELECT * FROM `child` WHERE `maternal_uname`='$user'";
                                                    $query2 = mysqli_query($conn,$sql);
                                                    if($query2){
                                                        $num = 0;
                                                        while($data = mysqli_fetch_assoc($query2)){
                                                        $cname = $data['child_name'];
                                                        $birthdate = $data['birthdate'];
                                                        $gender = $data['gender'];
                                                        $vaccinated = $data['vaccinated'];
                                                        $blood = $data['blood_group'];
                                                        $weight = $data['weight'];
                                                        $remarks = $data['remarks'];
                                                        
                                                            ?>

                                        <tbody>
                                            <tr>
                                                <td><?php echo ++$num; ?></td>
                                                <td><?php echo $cname; ?></td>
                                                <td><?php echo $birthdate; ?></td>
                                                <td><?php echo $gender; ?></td>
                                                <td><?php echo $blood; ?></td>
                                                <td><?php echo $weight; ?>KG</p>
                                                <td><?php echo $vaccinated; ?></td>
                                                <td><?php echo $remarks; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php   } } }else{
                                            echo '<p class="text-danger text-center">Records vissible for Post Natal Maternals Only<p>';
                                        }
                                            ?>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>

</body>

</html>