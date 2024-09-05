<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Grade Score</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <style>
     
      .input-width {
        width: 200px;
        padding: 0;
        margin-top: 10px;
        margin-bottom:10px;
      }
    </style>
  </head>
  <body>
    <section class="container">
      <form action="65_41_workshop2.php" method="post">
        <div class="col-md col-sm">
          <h1>PHP Check Grade A-E from Score</h1>
          <div class="form-floating">
            <input
              name="score"
              id="scoreId"
              placeholder="0"
              type="text"
              class="form-control form-control-md input-width"
              value="<?php echo isset($_POST['score']) ? $_POST['score'] : ""  ?>"
            />
            <label for="scoreId">Enter Score</label>
          </div>
         
          </div>
            <button class="btn btn-primary" type="submit">Submit</button>
            
          
          <hr />
          <h1>Your Grade is:</h1>
          <div class='mb-3' id='result'><h2 style='color:red;'><?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['score'])){
    
     if(is_numeric($_POST['score'])){
     $score = $_POST['score'];
    
    
    
     class Grader {
       public $score;
       public $grade;
      
        function gradeCalc($score){
            $grade = '';
            if($score >= 80){
                $grade = 'A';
            }elseif($score >= 70){
                $grade = 'B';
            }elseif($score >= 60){
                $grade = 'C';
            }elseif($score >= 50){
                $grade = 'D';
            }else{
                $grade = 'E';
            }
            $this->grade = $grade;
            return $grade;
        }
      
      
    }
    if($score <= 100 && $score >= 0){
    $score = floatval($score);
    
    $grade = new Grader();

    $setGrade = $grade->gradeCalc($score);
    
     echo "$setGrade<br>";
     
}else{
        echo "Invalid score. Please enter a value between 0 and 100.";
}}else if($_POST['score'] !== ''){
  echo "Please Enter a valid score";
}
}else{
  echo "Please Enter a score";
}

}

  ?></h2></div>
          <button onclick='clearAllData()' class="btn btn-danger">Clear Data</button>
        </div>
      </form>
    </section>

    <script>
        function clearAllData() {
            document.getElementById("result").innerHTML = "";
            document.getElementById("scoreId").value = "";
        }
    </script>
  </body>
  
</html>
