<?php
    session_start();
    include 'config.php';
    $uname = $_POST['uname'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `login_tbl` WHERE uname='$uname' AND password='$password'";
    $result = $mysqli->query($sql);
    // echo "SELECT * FROM `register` WHERE uname='$uname' AND password='$password'";
    // exit();
    function giveUserUrl(){
        $str = rand();
        $_SESSION['token'] = md5($str);
        echo "http://localhost/api3/index.php?token=",$_SESSION['token'];
    }
    while($row = $result->fetch_assoc()){
        if(mysqli_num_rows($result) > 0){
            echo gettype($row['uname']);
            // echo $row['uname'];
            if(($row['uname'] == $uname) && ($row['password'] == $password)){
                // echo '
                // <script>
                // alert("successfully loged-in");
                // window.location.href = "index.php";
                // </script>
                // ';
                echo "Please paste below url to get to the user page.";
                echo "<br>";
                echo giveUserUrl();
                exit;
                
            }
            else{
                echo "no";
            }
        }
        else{
            echo "not found";
        }
    }
    // echo "$result";

    exit();
    // if($result != NULL){
    //     echo '
    //     <script>
    //     alert("successfully loged-in");
    //     window.location.href = "index.php";
    //     </script>
    //     ';
    // }
    // else
    // {
    //     echo '
    //     <script>
    //     alert("username or password may be incorrecct");
    //     window.location.href = "login.html";
    //     </script>
    //     ';
    // }
?>