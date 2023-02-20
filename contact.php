<!DOCTYPE html>
<html lang=en>

<head>
  <title>CONTACT</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/x-icon" href="C:\xampp\htdocs\educom-webshop-basis\favicon.ico">
</head>

<body>
  <?php
  // initate the variables 
  $name = $email = $phone = $salutation = $contactOption = $message = '';
  $nameErr = $emailErr = $phoneErr = $contactOptionErr = $messageErr = '';
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
    if (empty($_POST["phone"])) {
      $phoneErr = "Phone is required";
    } else {
      $phone = test_input($_POST["phone"]);
    }
    if (empty($_POST["salutation"])) {
      $salutation = "";
    } else {
      $salutation = test_input($_POST["salutation"]);
    }

    if (!empty($_POST["contactOption"]) && isset($contactOption)) {
      $contactOption = test_input($_POST["contactOption"]);
    } else {
      $contactOptionErr = "Contact option is required";
    }
    if (empty($_POST["message"])) {
      $messageErr = "Message is required";
    } else {
      $message = test_input($_POST["message"]);
    }

    if (strcmp($nameErr, '') == 0 && strcmp($emailErr, '') == 0 && strcmp($phoneErr, '') == 0 && strcmp($contactOptionErr, '') == 0 && strcmp($messageErr, '') == 0) {
      $valid = true;
    };
  }

  ?>

  <div id="page-container">
    <div id="content-wrap">
      <div class="top">
        <header>
          <h1>CONTACT</h1>
        </header>
        <br>
        <nav>
          <ul class="menu">
            <a href="index.php">
              <li>HOME</li>
            </a>
            <a href="about.php">
              <li>ABOUT</li>
            </a>
            <a href="contact.php">
              <li>CONTACT</li>
            </a>
          </ul>
        </nav>
      </div>
      <?php if (!$valid) { /* Show the next part only when $valid is false */ ?>

        <div class="form-style-3">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <fieldset>
              <legend>Personal</legend>
              <label for="name"><span>Name <span class="required">*</span></span><input type="text" class="input-field" name="name" value="<?php echo $name; ?>" /></label>
              <span class="error"><?php echo $nameErr ?></span>
              <label for="email"><span>Email <span class="required">*</span></span><input type="email" class="input-field" name="email" value="<?php echo $email; ?>" /></label>
              <span class="error"><?php echo $emailErr ?></span>
              <label for="phone"><span>Phone <span class="required">*</span></span><input type="text" class="input-field" name="phone" value="<?php echo $phone; ?>" /></label>
              <span class="error"><?php echo $phoneErr ?></span>
              <label for="salutation"><span>How can we address you?</span><select name="salutation" class="select-field">
                  <option <?php if ($salutation == "Mrs") {
                            echo "selected";
                          } ?> value="Mrs">Mrs</option>
                  <option <?php if ($salutation == "Ms") {
                            echo "selected";
                          } ?> value="Ms">Ms</option>
                  <option <?php if ($salutation == "Mx") {
                            echo "selected";
                          } ?> value="Mx">Mx</option>
                  <option <?php if ($salutation == "Mr") {
                            echo "selected";
                          } ?> value="Mr">Mr</option>
                </select></label>
            </fieldset>
            <fieldset>
              <legend>Preferred contact option *:</legend>
              <label for="email"><span>email</span><input <?php if ($contactOption == "email") {
                                                            echo "checked";
                                                          } ?> type="radio" id="email" name="contactOption" class="required" value="email"></label><br>
              <label for="phone"><span>phone</span><input <?php if ($contactOption == "phone") {
                                                            echo "checked";
                                                          } ?> type="radio" id="phone" name="contactOption" class="required" value="phone"></label><br>
              <span class="error"><?php echo $contactOptionErr ?></span>
            </fieldset>
            <fieldset>
              <legend>How can I help you?</legend>
              <label for="message"><span>Message <span class="required">*</span></span><textarea name="message" class="textarea-field"><?php echo $message; ?></textarea></label>
              <span class="error"><?php echo $messageErr ?></span>
              <p></p>
              <label><input type="submit" value="Submit" /></label>
            </fieldset>
          </form>
        </div>

      <?php } else { /* Show the next part only when $valid is true */ ?>

        <p>Thank you for your reply!</p>

        <div>Name: <?php echo $salutation, " ", $name; ?></div>
        <div>Email: <?php echo $email; ?> </div>
        <div>Phone: <?php echo $phone; ?></div>
        <div>Preferred Contact Option: <?php echo $contactOption; ?> </div>
        <div>Message: <?php echo $message; ?></div>


      <?php } /* End of conditional showing */ ?>
    </div>
    <footer>
      <p>&copy; <script>
          document.write(new Date().getFullYear())
        </script> Lydia van Gammeren All Rights Reserved</p>
    </footer>
  </div>
</body>

</html>