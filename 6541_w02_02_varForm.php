<?php
    $fname = "PASIT";
    $lname = "Lnwza007";
    $email = "maoezxad@gmail.com";
    $age = 21;
    $phone = "08512154121";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variable in Form</title>
    <link rel="stylesheet" href="./custom.css">
</head>
<body>
    <form action="6541_w02_02_varForm.php" method="post">
        <fieldset >
            <legend>My Information</legend>
            <div class="form-alingment">
            <label for="fname">First Name</label>
            <input type="text" id="fname" value=<?php echo $fname; ?> name="fname">
            <label for="lname">Last name</label>
            <input type="text" id="lname" value=<?php echo $lname; ?> name="lname">
            <label for="email">Email</label>
            <input type="text" id="email" value=<?php echo $email; ?> name="email">
            <label for="age">Age</label>
            <input type="text" id="age" value=<?php echo $age; ?> name="age">
            <label for="phoneNum">Phone Number</label>
            <input type="text" id="phoneNum" value=<?php echo $phone; ?> name="phone">
</div>
        </fieldset>
        <button type="submit">send</button>
    </form>

    <?php 
    
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $age = $_POST['age'];
            $phone = $_POST['phone'];

            echo "<br><h1>Get Data: </h1>";
            echo $fname."<br>";
            echo $lname."<br>";
            echo $email."<br>";
            echo $age."<br>";
            echo $phone."<br>";

        }
    
    
    ?>
    
</body>
</html>