<?php include 'inc/header.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialisation des erreurs
    $nameErr = $emailErr = $bodyErr = '';

    // Sanitize + trim inputs
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $body = trim(filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    // Validation
    if (empty($name)) {
        $nameErr = 'Name is required';
    }

    if (empty($email)) {
        $emailErr = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = 'Invalid email format';
    }

    if (empty($body)) {
        $bodyErr = 'Feedback is required';
    }

    // Insertion si tout est valide
    if (empty($nameErr) && empty($emailErr) && empty($bodyErr)) {
        $stmt = mysqli_prepare($conn, "INSERT INTO feedback (name, email, body) VALUES (?, ?, ?)");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $body);
            if (mysqli_stmt_execute($stmt)) {
                header('Location: feedback.php');
                exit;
            } else {
                echo 'Error executing statement: ' . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo 'Error preparing statement: ' . mysqli_error($conn);
        }
    }
}



// $name = $email = $body = '';
// $nameErr = $emailErr = $bodyErr = '';


// // Form submit
// if (isset($_POST['submit'])) {


//     // Validate name
//     if (empty($_POST['name'])) {
//         $nameErr = 'Name is required';
//     } else {
//         $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//     }

//     // Validate email
//     if (empty($_POST['email'])) {
//         $emailErr = 'Email is required';
//     } else {
//         $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
//     }

//     // Validate feedback
//     if (empty($_POST['body'])) {
//         $bodyErr = 'Feedback is required';
//     } else {
//         $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//     }



//     if (empty($nameErr) && empty($emailErr) && empty($bodyErr)) {

//         // Add feedback to the db
//         $sql = "INSERT INTO feedback (name, email, body) VALUES('$name', '$email', '$body')";

//         if (mysqli_query($conn, $sql)) {
//             // Success
//             header('Location: feedback.php');
//         } else {
//             // Error
//             echo 'Error: ' . mysqli_error($conn);
//         }
//     }

// }

?> 




    <img src="/feedback-app/img/logo.png" class="w-25 mb-3" alt="">
    <h2>Feedback</h2>
    <p class="lead text-center">Leave feedback for Visual Artisan</p>
    <p><a class="text-info" href="http://www.visualartisan.fr">www.visualartisan.fr</a></p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="mt-4 w-75 mb-5">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null; ?>" id="name" name="name" placeholder="Enter your name">
        <div class="invalid-feedback">
        <?php echo $nameErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control  <?php echo $emailErr ? 'is-invalid' : null; ?>" id="email" name="email" placeholder="Enter your email">
        <div class="invalid-feedback">
        <?php echo $emailErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Feedback</label>
        <textarea class="form-control  <?php echo $bodyErr ? 'is-invalid' : null; ?>" id="body" name="body" placeholder="Enter your feedback"></textarea>
        <div class="invalid-feedback">
        <?php echo $bodyErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-primary w-100">
      </div>
    </form>

    <?php include 'inc/footer.php'; ?>
