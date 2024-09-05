<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
    <style>
        .text_field{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    
<?php
    $fname = "PASIT";
    $lname = "Bungoed" ;
    $email = "maoezxooo@gmail.com" ;
    $age = 21;
    $phone = "0858425846";
    $gender = "Male";
    $skill = ["HTML","JAVA","PHP"];  // string => array   PHP,HTML => ["PHP","HTML"]
    $note = "Interested in Computer field";
?>
<h3 style='background-color:red; color:white;'>Workshop01</h3>
<h1 style='padding-right:10px'>Information about me: <?php echo "<span style='color:red;'>$fname"." "."$lname</span>" ?></h1>
<form>
<fieldset class="text_field">
    <legend>Text Field</legend>
    <label for="fname">First Name</label>
    <input  style='width:150px;' type="text" required name="fname" id="fname" value="<?php echo $fname;  ?>">
    <label for="lname">Last name</label>
    <input style='width:150px;' type="text" name="lname" id="lname" value="<?php echo $lname; ?>">
    <label for="email">Email</label>
    <input style='width:250px;' type="text" name="email" value="<?php echo $email; ?>" id="email">
    <label for="age">Age</label>
    <input style='width:50px;' type="text" value="<?php echo $age; ?>" name="age" id="age">
    <label for="phone">Phone</label>
    <input style='width:100px;' type="text" name="phone" id="phone" value="<?php echo $phone; ?>">
</fieldset>

<fieldset>
    <legend>Radio Button</legend>
    <label for="gender">Gender:</label>
    <input type="radio" id="genderMale" name="gender" value="<?php echo $gender; ?>" checked >
    <label for="genderMale">Male</label>
    <input type="radio" id="genderFemale" name="gender" value="Female">
    <label for="genderFemale">Female</label>
    
</fieldset>

 <fieldset>
        <legend>CheckBox</legend>
        <label>Skill</label>
        <input id="html" name="skills" value="<?php echo $skills[0] ?>" checked type="checkbox">
        <label for="html"><?php echo $skill[0]?></label>
        <input id="php" name="skills" value="<?php echo $skills[2] ?>" checked type="checkbox">
        <label for="php"><?php echo $skill[2]?></label>
        <input id="java" name="skills" value="<?php echo $skills[1] ?>" checked type="checkbox">
        <label for="java"><?php echo $skill[1] ?></label>
    </fieldset>

    <fieldset>
        <legend>Textarea with CSS</legend>
        <label for="">Note:</label>
        <textarea style='color:blue;' name="" class="" cols=150 rows=10 id=""><?php echo $note ?></textarea>
    </fieldset>
    
</form>
<a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&t=0s"><button style='margin-top:10px;'>ยืนยัน</button></a>

</body>
</html>