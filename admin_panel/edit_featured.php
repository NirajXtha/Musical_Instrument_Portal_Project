<?php
include 'dbconfig.php';
    if($_GET['edit'] == 'Add'){
        // echo 'hello';
        $id = $_GET['pid'];
        $sql = mysqli_query($conn,"UPDATE product SET featured = 'Remove' WHERE pid = $id");
        if($sql){
            echo '<script>
                    alert("Successfuly Added!");
                    window.history.back();
                </script>';
        }
    }   
    if($_GET['edit'] == 'Remove'){

        $id = $_GET['pid'];
        $sql = mysqli_query($conn,"UPDATE product SET featured = 'Add' WHERE pid = $id");
        if($sql){
            echo '<script>
                    alert("Successfuly Removed!");
                    window.history.back();
                </script>';
        }
    }

?>