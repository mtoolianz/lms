<?php

$con = mysqli_connect('localhost','root','','library');
if(!$con) {
    die(mysqli_error($con));
}
