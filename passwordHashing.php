<?php

$signupPwd = 'example';

$options = [
    'cost' => 12
];

$hashedPwd = password_hash($signupPwd, PASSWORD_BCRYPT, $options);

$loginPwd = 'example';

if (password_verify($loginPwd, $hashedPwd)) {
    echo 'Password is valid!';
    //Do some stuff
} else {
    echo 'Wrong password!';
    //Do some stuff
}