<?php

    require "config.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $response = array();
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query_cek_user = mysqli_query($connection, "SELECT * FROM user Where email = '$email'");
        $cek_user_result = mysqli_fetch_array($query_cek_user);

        if ($cek_user_result) {

            $query_login = mysqli_query($connection, "SELECT * FROM user Where email = '$email' && '$password'");
            if ($query_login) {

                $response['value'] = 1;
                $response['message'] = "Yeay, Login is successful";
                $response['user_id'] = $cek_user_result['id_user'];
                $response['name'] = $cek_user_result['name'];
                $response['email'] = $cek_user_result['email'];
                $response['phone'] = $cek_user_result['phone'];
                $response['address'] = $cek_user_result['address'];
                $response['created_at'] = $cek_user_result['created_at'];
                $response['message'] = "Yeay, Login is successful";
                echo json_encode($response);
            } else {

                $response['value'] = 2;
                $response['message'] = "Oops, Login failed";
                echo json_encode($response);
            }
        } else {
  
                $response['value'] = 2;
                $response['message'] = "Oops, data is not registered !";
                echo json_encode($response);
        }
    }

?>