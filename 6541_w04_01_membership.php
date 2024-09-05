<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sale Product</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <style>
      /* body {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
      } */
      .input-width {
        width: 200px;
        padding: 0;
        margin-top: 10px;
      }
    </style>
  </head>
  <body>
    <section class="container">
      <form action="6541_w04_01_membership.php" method="post">
        <div class="col-md col-sm">
          <h1>Infomation about Product</h1>
          <div class="form-floating">
            <input
              name="price"
              id="priceId"
              placeholder="0"
              type="text"
              class="form-control form-control-md input-width"
              value="<?php echo isset($_POST['price']) ? $_POST['price'] : ""  ?>"
            />
            <label for="priceId">Price</label>
          </div>
          <div class="form-floating">
            <input
              class="form-control input-width"
              type="text"
              placeholder="0"
              name="amount"
              id="amountId"
              value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : ""  ?>"
            />
            <label class="form-label" for="amountId">Amount</label>
          </div>

          <div>
            <label>Member ?</label>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                value="true"
                name="isMember"
                id="member"
                <?php echo isset($_POST['isMember']) ? ($_POST['isMember'] == "true" ? 'checked': '' ) :'' ?>
              />
              <label for="member">Yes</label>
            </div>

            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                value="false"
                name="isMember"
                id="notMember"
                <?php echo isset($_POST['isMember']) ? ($_POST['isMember'] == "false" ? 'checked': '' ) : '' ?>
              />
              <label for="notMember">No</label>
            </div>
          </div>

          <div>
            <button class="btn btn-primary" type="submit">Submit</button>
            <button class="btn btn-secondary" type="reset">Reset</button>
          </div>
          <hr />
          <h1>Result:</h1>
          <div class='mb-3' id='result'><?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['price']) && isset($_POST['amount'])){
      if(isset($_POST['isMember'])){
    $price = $_POST['price'];
    $amount = $_POST['amount'];
    $isMember = $_POST['isMember'];
    $isMember = $booleanValue = filter_var($isMember, FILTER_VALIDATE_BOOLEAN);
    
    
    class Customer {
      public $price;
      public $amount;
      public $total;
      public $discount;
      public $payTotal;

      function __construct($price,$amount,$isMember = false){
        $this->price = $price;
        $this->amount = $price;
        
        
        $this->totalCalc($this->price,$this->amount);
          if($isMember){
            $this->member($this->total);
          }else{
            $this->discount = 0;
          }
           $this->payTotal = $this->total - $this->discount;
      }

      private function totalCalc($price,$amount){
          $this->total = $price * $amount;
      }
      private function member($total){
        $this->discount = $total * (10/100);
      }
      function getDetail(){
        return [
          'total' => $this->total,
          'discount' => $this->discount,
          'payTotal' => $this->payTotal
        ];
      }
      
    }

    if(is_numeric($price) && is_numeric($amount)){
      $price = floatval($price);
      $amount = floatval($amount);
    
    $customer = new Customer($price,$amount,$isMember);

    $productDetail = $customer->getDetail();
    
     echo "Price of Product: $price <br>";
     echo "Amount of Product: $amount <br>";
     echo "Total of Price:". $productDetail['total']." <br>";
     if($isMember){
     echo "Discount:". $productDetail['discount'] . " <br>";
     echo "Total Paid:". $productDetail['payTotal'] . " <br>";
  }
  }else{
   echo "Please enter price and amount";
  }
}
else{
    echo "Please check member";
  
}
}else{
  echo "Please Enter a valid number";
}
}
  ?></div>
          <button onclick='clearAllData()' class="btn btn-danger">Clear Data</button>
        </div>
      </form>
    </section>

    <script>
        function clearAllData() {
            document.getElementById("result").innerHTML = "";
            document.getElementById("member").checked = false;
            document.getElementById("notMember").checked = false;
            document.getElementById("priceId").value = "";
            document.getElementById("amountId").value = "";
        }
    </script>
  </body>
  
</html>
