
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
</head>
<body>
  <div class='container'>
    <h1>Products</h1>
    <form method='post' action='' class=' mb-2'>
        <div class='d-flex align-items-start'>
          <div class='input-group'>
            <div class='form-floating'>
          <input name='price' placeholder='price' class='form-control' type="number">
          <label>Price</label>
          </div>
          <button class='btn btn-primary'>Filter</button>
          </div>
          
</div>
<button class='btn btn-primary mt-2'>Add Product</button>
    </form>
    <table id ='productTable' class='table table-striped' >
      <thead>
        <th>#</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Action</th>
      </thead>
      <tbody>
      <?php      
      $products = [ 
        ['id' => 1, 'name' => 'Product 1', 'price' => 100, 'quantity' => 10], 
        ['id' => 2, 'name' => 'Product 2', 'price' => 150, 'quantity' => 5], 
        ['id' => 3, 'name' => 'Product 3', 'price' => 200, 'quantity' => 8], 
        ['id' => 4, 'name' => 'Product 4', 'price' => 50, 'quantity' => 3], 
        ['id' => 5, 'name' => 'Product 5', 'price' => 30, 'quantity' => 18], 
        ['id' => 6, 'name' => 'Product 6', 'price' => 140, 'quantity' => 48], 
        ['id' => 7, 'name' => 'Product 7', 'price' => 50, 'quantity' => 6], 
        ['id' => 8, 'name' => 'Product 8', 'price' => 70, 'quantity' => 8], 
        ['id' => 9, 'name' => 'Product 9', 'price' => 90, 'quantity' => 7], 
        ['id' => 10, 'name' => 'Product 10', 'price' => 150, 'quantity' => 8], 
        ['id' => 11, 'name' => 'Product 11', 'price' => 150, 'quantity' => 4], 
        ['id' => 12, 'name' => 'Product 12', 'price' => 200, 'quantity' => 5], 
        ['id' => 13, 'name' => 'Product 13', 'price' => 200, 'quantity' => 2], 
        ['id' => 14, 'name' => 'Product 14', 'price' => 140, 'quantity' => 9], 
        ['id' => 15, 'name' => 'Product 15', 'price' => 175, 'quantity' => 3],
      
    ];
   
    //hi
    if (isset($_POST['price'])) {
                        $filterPrice = $_POST['price'];
                        $filteredProducts = array_filter($products, function($productcc) use ($filterPrice) {
                            return $productcc['price'] == $filterPrice;
                        });
                    } else {
                        $filteredProducts = $products;
                    };
  
    foreach($products as $product){
      echo "<tr>
      <td>{$product['id']}</td>
      <td>{$product['name']}</td>
      <td>{$product['price']}</td>
      <td>{$product['quantity']}</td>
      <td><button class='btn btn-danger'>Delete</button> <button class='btn btn-warning'>Edit</button></td>
      </tr>";
    };
?>
      </tbody>
    </table>
  </div>
    <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
      // let table = new DataTable('#productTable');
      function intializingDataTable(table){
        $(table).DataTable();
      };
      
      intializingDataTable('#productTable');
      
      
    </script>
</body>
</html>