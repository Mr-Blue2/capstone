
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="../assets/css/sidenav.css">
        
        <!-- Bootstrap CSS -->
      <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
      
      
    </head>

    <body id="body-pd"> 
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
            <div class="header__img">
                <img src="">
            </div>
        </header> 

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a class="nav__logo">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">BUPC A.S.S</span>
                    </a>
                    <div class="nav__list">

                      
                        <a href="index.php" class="nav__link">
                            <i class='bx bxs-home nav__icon' ></i>
                            <span class="nav__name">Home</span>
                        </a>

                        <a href="appointments.php" class="nav__link">
                           <i class='bx bxs-calendar-edit' ></i>
                            <span class="nav__name">Appointments</span>
                        </a>
                         
                        <a href="request.php" class="nav__link">
                        <i class='bx bx-add-to-queue'></i>
                            <span class="nav__name">Request</span>
                        </a>

                       
                        <a href="report.php" class="nav__link">
                           
                            <i class='bx bx-archive-in'></i>
                            <span class="nav__name">Report</span>
                        </a>
                        
                        <a href="users.php" class="nav__link">
                           <i class='bx bx-user'></i>
                            <span class="nav__name">Student</span>
                        </a>

                        <a href="faculty.php" class="nav__link">
                           <i class='bx bxs-user-circle' ></i>
                            <span class="nav__name">Faculty</span>
                        </a>

                        <a href="do.php" class="nav__link">
                            <i class='bx bx-buildings'></i>
                            <span class="nav__name">Department and Offices</span>
                        </a>
                        <a href="course.php" class="nav__link">
                           <i class='bx bx-book-reader'></i>
                            <span class="nav__name">Course</span>
                        </a>

                       
                    </div>
                </div>
                <a href="../includes/logout.inc.php" class="nav__logout">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>

                <!-- <a href="profile.php" class="nav__logout">
                    <span class="nav__name">Log Out</span>
                </a> -->
            </nav>
        </div>



 <!--===== MAIN JS =====-->
        <script src="../assets/js/sidenav.js"></script>
      

     
        
    </body>
</html>
