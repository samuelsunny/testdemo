<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == "GET")
{

        // Reading from the products table in the data base
        $query = "select * from products";

        $result = mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $products_data = mysqli_fetch_all($result);
            }
        }
    
    else{
        echo "problem in getting data";
    }

}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="product_display.css" rel="stylesheet">
    <style>
        .container {
            padding: 2rem 0rem;
        }

        h4 {
            margin: 2rem 0rem 1rem;
        }

        .table-image {
            td, th {
                vertical-align: middle;
            }
        }
    </style>
  </head>
  <body>
    <div class="container-fluid">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">C S M</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Importer
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="products.php">Place order</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="myorders.php">My orders</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Exporter
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="received_orders.php">Received orders</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Products
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="addproducts.php">Add products</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="products.php">View all products</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="addusers.php">Add users</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="viewusers.php">View all users</a></li>
                    </ul>
                </li>
            </ul>
            
                <span class="align-middle mr-2">
                    <h1 class="display-4 fs-5 text-center ">Welcome, <?php echo $user_data['user_name']; ?> </h1>
                </span>
                <a href="logout.php">
                    <button class="btn btn-warning  ml-2" type="submit">Log out</button>
                </a>
            </div>
        </div>
    </nav>
      
    <div class="row justify-content-center mt-1">
        <div class="col-6">
            <h1 class="display-4 fs-2 text-center"><b>Order products</b></h1>
        </div>
    </div>
  
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table class="table table-image">
                <thead>
                    <tr>
                    <th scope="col" class="text-center">Product Id</th>
                    <th scope="col" class="text-center">Product image</th>
                    <th scope="col" class="text-center">Product name</th>
                    <th scope="col" class="text-center">Product type</th>
                    <th scope="col" class="text-center">Price</th>
                    <th scope="col" class="text-center">Exporter name</th>
                    <th scope="col" class="text-center">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($row = 0; $row < count($products_data); $row++) { ?>
                    <tr>
                    <th scope="row" class="text-center"><?php echo $products_data[$row][0]; ?></th>
                    <td class="w-25 text-center">
                        <img class="img" src="data:image/png;charset=utf8;base64,<?php echo base64_encode($products_data[$row][6]); ?>" width = "150px" height="150px">
                    </td>
                    <td class="text-center">
                        <?php echo $products_data[$row][2]," ",$products_data[$row][1]; ?></td>
                    <td class="text-center"><?php echo $products_data[$row][3]; ?></td>
                    <td class="text-center"><?php echo "$",$products_data[$row][7]; ?></td>
                    <td class="text-center"><?php echo $products_data[$row][9]; ?></td>
                    <td class="text-center">
                        <input type="text" class="form-control" style="width: 80px;" id = "quantity" name = "quantity">
                    </td>
                    <td class="text-center"><button type="submit" class="btn btn-primary" onclick="add_to_cart(<?php echo $products_data[$row][0] ?>,
                                                                                                                '<?php echo strval( $products_data[$row][1]);?>', 
                                                                                                                '<?php echo strval( $products_data[$row][2]);?>',
                                                                                                                '<?php echo strval( $products_data[$row][3]);?>',
                                                                                                                '<?php echo strval( $products_data[$row][8]);?>',
                                                                                                                '<?php echo strval( $products_data[$row][9]);?>'
                                                                                                                )">Buy product</button></td>
                    </tr>
                    <?php }?>
                    </form>
                </tbody>
                </table>   
            </div>
        </div>
    </div>

      
      <script>
        var check = 1;
        
        function add_to_cart(product_id,product_name,
                            product_brand,product_type,
                            exporter_id,exporter_name)
        {
          var quantity = parseInt(document.getElementById("quantity").value);
          if (check == 1)
          {
            localStorage.clear();
            check = 2;
          }
          console.log(product_id,product_name,
                            product_brand,product_type,exporter_id,exporter_name);

        
        console.log(quantity)
        var product_data = {
        "product_id"    : product_id,
        "product_name"  : product_name,
        "product_brand" : product_brand,
        "product_type"  : product_type,
        "quantity"      : quantity,
        "exporter_id"   : exporter_id,
        "exporter_name" : exporter_name
        }
        console.log(product_data)
        data = JSON.stringify(product_data);
        // data = JSON.parse(data_crude);

         localStorage.setItem(product_id, data);
         console.log(data);
        }

      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>

