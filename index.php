<?php
include('./dbConnection.php');

include('./mainInclude/header.php');
?>
<div class="container-fluid remove-vid-marg">
  <div class="vid-parent">
    <video playsinline autoplay muted loop>
      <source src="video/b2.mp4" />
    </video>
    <div class="vid-overlay">
      <?php
$color = "white";  // Change this variable to any color you prefer
      echo '<p style="color: white; font-size: 30px; text-align: center;">مرحبا بكم في موقع التعليم العربية بالفرنسية</p>';
            echo '<p style="color: white; font-size: 30px; text-align: center;">Bienvenues sur le site d"apprentissage de l"arabe par le Francais</p>';

      

?>
        
        <?php
        if (!isset($_SESSION['is_login'])) {
          echo '<a class="btn btn-danger mt-3" href="#" data-toggle="modal" data-target="#stuRegModalCenter"><center>Cliquer Ici pour Commencer</a>';
        } else {
          echo '<a class="btn btn-primary mt-3" href="Student/studentProfile.php">My Profile</a>';
        }
        ?>
      </div>
    </div>

</div>

<div class="container-fluid bg-danger txt-banner">
  <div class="row bottom-banner">
    <div class="col-sm">
      <h5> <i class="fas fa-book-open mr-3"></i> 100+ cours en Ligne</h5>
    </div>
    <div class="col-sm">
      <h5><i class="fas fa-users mr-3"></i> Instructeurs experts
</h5>
    </div>
    <div class="col-sm">
      <h5><i class="fas fa-keyboard mr-3"></i> Accès à vie</h5>
    </div>
    <div class="col-sm">
      <h5><i class="fas fa-rupee-sign mr-3"></i> Remboursement Garantie*
</h5>
    </div>
  </div>
</div>

<div class="container mt-5">
  <h1 class="text-center">Nos Cours</h1>
  <div class="card-deck mt-4">
    <?php
    $sql = "SELECT * FROM course LIMIT 3";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $course_id = $row['course_id'];
        $stuLogEmail = $_SESSION['stuLogEmail'] ?? '';


        $checkOrderSql = "SELECT * FROM courseorder WHERE stu_email = '$stuLogEmail' AND course_id = '$course_id' AND status = 'success'";
        $orderResult = $conn->query($checkOrderSql);

        if ($orderResult->num_rows > 0) {
          $buttonText = "Open";
          $buttonLink = "student/watchcourse.php?course_id=$course_id";
          $buttonClass = "btn-success";
        } else {
          $buttonText = "Acheter";
          $buttonLink = "coursedetails.php?course_id=$course_id";
          $buttonClass = "btn-primary";
        }

        echo '
            <a href="coursedetails.php?course_id=' . $course_id . '" class="btn" style="text-align: left; padding:0px; margin:0px;">
              <div class="card">
                <img src="' . str_replace('..', '.', $row['course_img']) . '" class="card-img-top" alt="Guitar" />
                <div class="card-body">
                  <h5 class="card-title">' . $row['course_name'] . '</h5>
                  <p class="card-text">' . $row['course_desc'] . '</p>
                </div>
                <div class="card-footer">
                  <p class="card-text d-inline">Price: <small><del>&#8377 ' . $row['course_original_price'] . '</del></small> 
                  <span class="font-weight-bolder">&#8377 ' . $row['course_price'] . '<span></p> 
                  <a class="btn ' . $buttonClass . ' text-white font-weight-bolder float-right" href="' . $buttonLink . '">' . $buttonText . '</a>
                </div>
              </div>
            </a>';
      }
    }
    ?>
  </div>
  <div class="card-deck mt-4">
    <?php
    $sql = "SELECT * FROM course LIMIT 3,3";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $course_id = $row['course_id'];
        $stuLogEmail = $_SESSION['stuLogEmail'] ?? '';

        // Check if the course is already purchased by the logged-in user
        $checkOrderSql = "SELECT * FROM courseorder WHERE stu_email = '$stuLogEmail' AND course_id = '$course_id' AND status = 'success'";
        $orderResult = $conn->query($checkOrderSql);

        // Set button text and link based on purchase status
        if ($orderResult->num_rows > 0) {
          // If purchased, set to "Open" button with a link to the course page
          $buttonText = "Open";
          $buttonLink = "student/watchcourse.php?course_id=$course_id";
          $buttonClass = "btn-success"; // styling for "Open" button
        } else {
          // If not purchased, set to "Enroll" button with a link to course details
          $buttonText = "Enroll";
          $buttonLink = "coursedetails.php?course_id=$course_id";
          $buttonClass = "btn-primary"; // styling for "Enroll" button
        }

        echo '
              <a href="coursedetails.php?course_id=' . $course_id . '" class="btn" style="text-align: left; padding:0px; margin:0px;">
                <div class="card">
                  <img src="' . str_replace('..', '.', $row['course_img']) . '" class="card-img-top" alt="Course Image" />
                  <div class="card-body">
                    <h5 class="card-title">' . $row['course_name'] . '</h5>
                    <p class="card-text">' . $row['course_desc'] . '</p>
                  </div>
                  <div class="card-footer">
                    <p class="card-text d-inline">Price: <small><del>&#8377 ' . $row['course_original_price'] . '</del></small> 
                    <span class="font-weight-bolder">&#8377 ' . $row['course_price'] . '<span></p> 
                    <a class="btn ' . $buttonClass . ' text-white font-weight-bolder float-right" href="' . $buttonLink . '">' . $buttonText . '</a>
                  </div>
                </div>
              </a>';
      }
    }
    ?>
  </div>
  <div class="text-center m-2">
    <a class="btn btn-danger btn-sm" href="courses.php">Voir tout les cours</a>
  </div>
</div>

<?php

include('./contact.php');
?>


<div class="container-fluid mt-5" style="background-color: #4B7289" id="Feedback">
  <h1 class="text-center testyheading p-4">Temoignages des Etudiants </h1>
  </div>

<div class="container-fluid bg-danger">
  <div class="row text-white text-center p-1">
  </div>
</div>



<?php
include('./mainInclude/footer.php');

?>