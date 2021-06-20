<?php

    require "config.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $response = array();
        $full_name = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = $_POST['password'];

        $query_cek_user = mysqli_query($connection, "SELECT * FROM user Where email = '$email' || phone = '$phone'");
        $cek_user_result = mysqli_fetch_array($query_cek_user);

        if ($cek_user_result) {

            $response['value'] = 0;
            $response['message'] = "Oops, Sorry data has been registered!";
            echo json_encode($response);
        }
        else {
            $query_insert_user = mysqli_query($connection, "INSERT INTO user VALUE('', '$full_name', '$email', '$phone', '$address', '$password', NOW(), 1)");
            if ($query_insert_user) {

                $response['value'] = 1;
                $response['message'] = "Yeay, Registration is successful. Please log in with your account";
                echo json_encode($response);
            }
            else {

                $response['value'] = 2;
                $response['message'] = "Oops, Registration failed";
                echo json_encode($response);
            }
        }
    }

?>