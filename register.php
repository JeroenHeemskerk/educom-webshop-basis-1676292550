<?php
function showRegisterContent()
{
    // initate the variables 
    $name = $email = $password = $repeatPassword = '';
    $nameErr = $emailErr = $passwordErr = $repeatPasswordErr = '';
    $valid = false;

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // validate the 'POST' data
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }


        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } else {
            $password = test_input($_POST["password"]);
        }

        if (empty($_POST["repeatPassword"])) {
            $repeatPasswordErr = "Repeat your password";
        } else {
            $repeatPassword = test_input($_POST["repeatPassword"]);
            if (strcmp($repeatPassword, $password) != 0) {
                $repeatPasswordErr = "Passwords does not match";
            }
        }

        if (strcmp($nameErr, '') == 0 && strcmp($emailErr, '') == 0 && strcmp($passwordErr, '') == 0 && strcmp($repeatPasswordErr, '') == 0) {
            $valid = true;
        };
    }

    if (!$valid) { /* Show the next part only when $valid is false */
        echo '
        <div class="form-style-3">
          <form method="post" action="index.php">
            <fieldset>
              <legend>Fill out your information to register:</legend>
              <label for="name"><span class="required">Name*</span><input type="text" class="input-field" name="name" value="' . $name . '" /></label>
              <span class="error">' . $nameErr . '</span>
              <label for="email"><span class="required">Email*</span><input type="email" class="input-field" name="email" value="' . $email . '" /></label>
              <span class="error">' . $emailErr . '</span>
              <label for="password"><span class="required">Password*</span><input type="password" class="input-field" name="password" value="' . $password . '" /></label>
              <span class="error">' . $passwordErr . '</span>
              <label for="repeatPassword"><span class="required">Repeat Password*</span><input type="password" class="input-field" name="repeatPassword" value="' . $repeatPassword . '" /></label>
              <span class="error">' . $repeatPasswordErr . '</span>
            </fieldset>      
            <fieldset>              
              <label><input type="submit" value="Submit" /></label>
              <input type="hidden" name="page" value="register">                                                
              </fieldset>
          </form>
        </div>'
?> <?php } else { /* Show the next part only when $valid is true */
        echo '
        <p>Thank you for your reply!</p>

        <div>Name: ' . $name . '</div>
        <div>Email: ' . $email . ' </div>
        <div>Password: ' . $password . '</div>
        <div>Repeated password: ' . $repeatPassword . '</div>                
    </div> ';
    }
}
    ?>

