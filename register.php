<?php
function showRegisterContent()
{
    // initate the variables 
    $name = $email = $password = $confirmPassword = '';
    $nameErr = $emailErr = $passwordErr = $confirmPasswordErr = '';
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

        if (empty($_POST["confirmPassword"])) {
            $confirmPasswordErr = "Please repeat your password";
        } else {
            $confirmPassword = test_input($_POST["confirmPassword"]);
            if (strcmp($confirmPassword, $password) != 0) {
                $confirmPasswordErr = "Passwords does not match";
            }
        }

        if ($name !== "" && $email !== "" && $password !== "" && $confirmPassword !== "" && $nameErr === "" && $emailErr === "" && $passwordErr === "" && $confirmPasswordErr === "") {
            $users_file = fopen("./users/users.txt", "r");
            while (!feof($users_file)) {
                $user = fgets($users_file);
                if (stripos(
                    $user,
                    $email
                ) !== false) {
                    $emailErr = "An account with this email is already in use";
                }
            }
            fclose($users_file);

            if ($emailErr === "") {
                $valid = true;

                $users_file = fopen("./users/users.txt", "a");
                $new_user = "$email|$name|$password\n";
                fwrite(
                    $users_file,
                    $new_user
                );
                fclose($users_file);
            }
        }
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
              <label for="confirmPassword"><span class="required">Confirm Password*</span><input type="password" class="input-field" name="confirmPassword" value="' . $confirmPassword . '" /></label>
              <span class="error">' . $confirmPasswordErr . '</span>
            </fieldset>      
            <fieldset>              
              <label><input type="submit" value="Submit" /></label>
              <input type="hidden" name="page" value="register">                                                
              </fieldset>
          </form>
        </div>'
?> <?php } else { /* Show the next part only when $valid is true */
        echo '
        <p>Your registration is complete!</p>
        <p>Account info: </p>
        <div>Name: ' . $name . '</div>
        <div>Email: ' . $email . ' </div>                     
    </div> ';
    }
}
    ?>

