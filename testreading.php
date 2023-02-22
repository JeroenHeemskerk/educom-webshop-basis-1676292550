<?php
$myfile = fopen("Users/users.txt", "r") or die("Unable to open file!");
echo fread($myfile, filesize("Users/users.txt"));
fclose($myfile);
