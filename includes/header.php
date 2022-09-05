<nav class="navbar navbar-light bg-warning p-3 ">
    <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
        <a class="navbar-brand" href="#">
            <h5> Martenity System
            </h5>
        </a>
        <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse"
            data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
        <div class="dropdown  mr-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-expanded="false">
                <img src="../images/Maternity.jpg" height="26px" width="26px" class="rounded-circle">
                Hello,<?php echo $user;?>
            </button>
            <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="../maternals/notifications.php"><i class="bi bi-bell"></i> Notifications</a></li>
                <li><a class="dropdown-item" href="../includes/logout.php">Sign out</a></li>
            </ul>
        </div>
    </div>
</nav>