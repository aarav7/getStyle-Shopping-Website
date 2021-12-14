<?php
    session_start();
    $con= mysqli_connect("localhost", "root", "", "getStyle");
    if(!$con){
        echo "Connection Failed";
    }
    else{
        $result = mysqli_query($con, "SELECT *FROM products");
        if(mysqli_num_rows($result)>0){
        
            $mul_array=mysqli_fetch_all($result, MYSQLI_ASSOC);
            $json=json_encode($mul_array);
            echo "<pre>";
            print_r(array_column($mul_array,'prod_name'));
            echo "</pre>";
        }
    }
?>