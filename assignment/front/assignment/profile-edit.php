<?php
session_start();
include_once 'config.php';
$user=[];

$query = "select * from user where userName ='".$_SESSION["username"]."'";
$result = $mysqli->query($query);
if($result->num_rows > 0){
    $data=[];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[]=$row;
    }
    $user=$data[0];
}

if(isPost()){
    $email = $_POST['email'];
    $userName = $_POST['userName'];
    $userID = $_POST['userID'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "邮箱格式不对：" .$email;
        die();
    }

    $query = "select * from user where userName ='".$userName."' and userID <>".$userID;
    $result = $mysqli->query($query);
    if($result->num_rows > 0){
        echo "已经存在此用户：" .$userName;
        die();
    }

    $query = "select * from user where email ='".$email."' and userID <>".$userID;
    $result = $mysqli->query($query);
    if($result->num_rows > 0){
        echo "已经存在此邮箱：" .$email;
        die();
    }

    $query = "update `user` set userName='".$userName."',email='".$email."' where userID=".$userID;
    if ($mysqli->query($query)) {
        echo "更新成功";
    } else {
        // Execution failed
        echo "更新失败！";
    }
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="./headerfooterstyle.css">
    <link rel="stylesheet" href="./profile.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap">

    <title>User Update</title>
</head>
<body>
<?php
include_once 'nav.php';
?>
<!---------------------------------------------------- END OF NAVBAR ---------------------------------------->

<!----------------------------------------------- PAGE CONTENT START HERE ----------------------------------->
<main class="bg-image">
    <div class="profile_border">
        <div class="form-box login">
            <h2>Edit Profile</h2>
            <form action="profile-edit.php" method="post" class="form-container">
                <input type="hidden"  id="userID" name="userID" value="<?php echo $user['userID']?>">

                <div class="form-group">
                    <label for="name">*Username:</label>
                    <input type="text"  id="name" name="userName" value="<?php echo $user['userName']?>">
                </div>
                <div class="form-group">
                    <label for="email">*Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $user['email']?>">
                  </div>

                  <div class="form-group">
                    <label for="phone">*Phone:</label>
                    <input type="text" id="phone" name="phone" value="">
                  </div>
                
                  <div class="form-group">
                    <label for="password">*Password:</label>
                    <input type="password" id="password" name="password" value="">
                  </div>
                
                  <div class="form-group">
                    <label for="birthday">Birthday:</label>
                    <input type="date" id="birthday" name="birthday">
                  </div>
                
                  <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" >
                  </div>
                
                  <div class="form-group">
                    <label for="payment">Payment:</label>
                    <input type="text" id="payment" name="payment">
                  </div>
                  <div >
                    <label style="color:red">*Indicates required field.</label> 
                </div>
                  <input class="btn" type="submit" value="Save">
            </form>
        </div>
    </div>
</main>

<!-- <main class="bg-image">
    <div class="row" style="height: 600px;">
        <div class="col">
            <h1 class="text-center-topic">Welcome to Melewar Kitchen</h1>
            <h3 class="text-center">Truly Nogori Experience</h3>
            <div class="row" style="height: 50%;">
                <div class="col-d-flex"><a href="menu.html" class="btn">Check Our Menu</a></div>
                <div class="col-d-flex"><a href="reservation.html" class="btn">Order Now</a></div>
            </div>
        </div>
        <div class="col" style="background-image:url('res/profile_table.jpeg');">
            <div class="heading" ><h1 class="text-center-topic">Edit Profile</h1></div>
            <br>
            <form action="profile.html" method="get" class="form-container">
                <div class="form-group">
                    <label for="name"><h4 class="text-center">*Name:</h4></label>
                    <input type="text" id="name" name="name">
                  </div>
                
                  <div class="form-group">
                    <label for="email"><h4 class="text-center">*Email:</h4></label>
                    <input type="email" id="email" name="email">
                  </div>
                
                  <div class="form-group">
                    <label for="phone"><h4 class="text-center">*Phone:</h4></label>
                    <input type="text" id="phone" name="phone">
                  </div>
                
                  <div class="form-group">
                    <label for="password"><h4 class="text-center">*Password:</h4></label>
                    <input type="password" id="password" name="password">
                  </div>
                
                  <div class="form-group">
                    <label for="birthday"><h4 class="text-center">Birthday:</h4></label>
                    <input type="date" id="birthday" name="birthday">
                  </div>
                
                  <div class="form-group">
                    <label for="address"><h4 class="text-center">Address:</h4></label>
                    <input type="text" id="address" name="address">
                  </div>
                
                  <div class="form-group">
                    <label for="payment"><h4 class="text-center">Payment:</h4></label>
                    <input type="text" id="payment" name="payment">
                  </div>
                
                  <input class="btn" type="submit" value="Save">
            </form>

        </div>
    </div>
</main> -->
<!------------------------------------------------- END OF PAGE CONTENT ------------------------------------->

<footer class="footer">
    <div class="container footer-container">
        <div class="footer-1">
            <a href="home.html" class="footer-logo"><h4>Melewar Kitchen</h4></a>
            <p>
                Your Favourite Delicacies,<br> Truly Nogori!
            </p>
        </div>

        <div class="footer-2">
            <h4>Permalinks</h4>
            <ul class="permalinks">
                <li><a href="home.html">Home</a></li>
                <li><a href="menu.html">Menu</a></li>
                <li><a href="reservation.html">Reservation</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="profile.html">Profile</a></li>
            </ul>
        </div>

        <div class="footer-3">
            <h4>Privacy</h4>
            <ul class="privacy">
                <li><a href="privacy policy.html">Privacy Policy</a></li>
                <li><a href="terms&condition.html">Terms & Conditions</a></li>
                <li><a href="return policy.html">Refund Policy</a></li>
            </ul>
        </div>

        <div class="footer-4">
            <h4>Contact Us</h4>
            <div>
                <p>+(01)234567898</p>
                <p>melewarkitchen@gmail.com</p>
            </div>

            <ul class="footer-socials">
                <li>
                    <a href="#"><i class="uil uil-facebook-f"></i></a>
                </li>
                <li>
                    <a href="#"><i class="uil uil-instagram-alt"></i></a>
                </li>
                <li>
                    <a href="#"><i class="uil uil-twitter"></i></a>
                </li>
                <li>
                    <a href="#"><i class="uil uil-linkedin-alt"></i></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="footer-copyright">
        <small>All Right Reserved &copy; 2023 - Melewar Kitchen</small>
    </div>
</footer>
<!------------------------------------------------ End Of Footer ---------------------------------------------->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="./navmenu.js"></script>

</body>
</html>
