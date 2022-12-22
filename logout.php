<?php

session_start();

unset($_SESSION['id']);
unset($_SESSION['role']);
unset($_SESSION['name']);
header("location: ./");
