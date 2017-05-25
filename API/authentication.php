<?php

require_once('dbwrapper.php');

define(PASSWORD_AUTHENTICATION, 0);
define(TOKEN_AUTHENTICATION, 1);

function get_credential($username, $credential_type) {
    $db_credentials = get_database_config();
    $connection = new mysqli_connect($db_credentials[0], $db_credentials[1], $db_credentials[2]);
    if ($connection->connect_error) {
        die("Connection failed: ".$connection->connect_errno);
    }

    if ($credential_type == PASSWORD_AUTHENTICATION) {
        $query = $connection->prepare('SELECT hash FROM authentication WHERE username = ?');
        $query->bind_param('s', $username);
        $query->execute();
        if ($query->field_count == 1) {
            $result = $query->fetch_array(MYSQLI_ASSOC);
            $query->free();
            return $result['hash'];
        }
    } else if ($credential_type == TOKEN_AUTHENTICATION) {
        $query = $connection->prepare('SELECT token FROM authentication WHERE username = ?');
        $query->bind_param('s', $username);
        $query->execute();
        if ($query->field_count == 1) {
            $result = $query->fetch_array(MYSQLI_ASSOC);
            $query->free();
            return $result['token'];
        }
    }
    return false;
}

function login($username, $password) {
    $stored_secret = get_credential($username, PASSWORD_AUTHENTICATION); //get from database
    if ($stored_secret && password_verify($password, $stored_secret)) {
        generate_token($username);
        store_token($username);
    } else {
        return false;
    }
}

function store_token($username) {

}

function generate_token($username) {
    return false;
}