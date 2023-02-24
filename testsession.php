<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>

<body>

    <?php
    // Set session variables
    $_SESSION["favcolor"] = "green";
    $_SESSION["favanimal"] = "raccoon";
    echo "Session variables are set. <br>";
    echo "Favorite color is " . $_SESSION["favcolor"] . ".<br>";
    ?>

</body>

</html>