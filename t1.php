<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$selected_product_flag = 0;
$products_data = [];

$query = "select * from products";

$result = mysqli_query($con, $query);
// print_r( $result);

if($result)
{
    if($result && mysqli_num_rows($result) > 0)
    {
        $products_data = mysqli_fetch_all($result);
        // print_r($products_data);
    }
}

else{
echo "problem in getting data";
}

$get = "select * from products";

$result = mysqli_query($con, $get);
// print_r( $result);

if($result)
{
    if($result && mysqli_num_rows($result) > 0)
    {
        $products_data = mysqli_fetch_all($result);
        // print_r( $products_data);

    }
}

else{
echo "problem in getting data";
}


if($_SERVER['REQUEST_METHOD'] == "GET")
{
    // print_r( $_GET['product_id']);
    $product_name = $_GET['product_name'];
    // Reading from the data base
    $query = "select * from products where product_name = '{$product_name}'";

    $result = mysqli_query($con, $query);
    // print_r( $result);

    if($result)
    {
        if($result && mysqli_num_rows($result) > 0)
        {
            $selected_product_data = mysqli_fetch_all($result);
            // print_r( $selected_product_data);
            $selected_product_flag = 1;
        }
    }

    else{
        echo "problem in getting data";
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    print_r($_POST);
    // $product_id = $_POST['product_id'];
    // // When the user clicks on the buy product button
    // $query = "select * from products where product_id='{$product_id}'";

    // $result = mysqli_query($con, $query);
    // // print_r( $result);

    // if($result)
    // {
    //     if($result && mysqli_num_rows($result) > 0)
    //     {
    //         $product_data = mysqli_fetch_all($result);
    //     }
    // }

    // else{
    //     echo "problem in getting data";
    // }
    

    //     // Reading from the data base
        
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
        
        .wrapper{
        width:230px;
        padding:0px;
        height: 150px;
        }
        .dropdown-menu {
        width:230px;
        max-height:200px;
        overflow:scroll; 
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
                        <li><a class="dropdown-item" href="test.php">Place order</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="myorders.php">My orders</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="addwarehouse.php">Add warehouse</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Exporter
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="received_loading_orders.php">Received orders</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="manufacturerorder.php">Order inventory</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Products
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="addproducts.php">Add products</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="allproducts.php">View all products</a></li>
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
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="addharbour.php">Add a harbor</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="addcontainer.php">Add container</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="addmanufacturer.php">Add manufacturer</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="addtrucks.php">Add trucks</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="addtruckingcompanies.php">Add trucking company</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="adddrivers.php">Add driver</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="addship.php">Add ships</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="addshippingcompanies.php">Add shipping company</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="adddrivers.php">Add driver</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="add_FFC.php">Add freight forwarding company</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Orders
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="received_loading_orders.php">Load container</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="shipping_orders.php">Sea shipping order</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="index.php">Truck shipping order</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Manufacturer
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="man_received_orders.php">Export orders</a></li>
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
      
    <div class="container-fluid text-center mt-2">
        <div class="row justify-content-center bg-light">
            <div class="col-6">
                <div class="row justify-content-center bg-light">
                    <div class="col-3">
                        <p> Product: </p>
                    </div>
                    <div class="col-3">
                        <div class="wrapper">
                            <select name="" id="" class="form-control" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                <?php for ($row = 0; $row < count($products_data); $row++) { ?>
                                    <form method = "get">    
                                    <a href="http://localhost/Container-Scheduling-and-management/t1.php?product_name=<?php echo $products_data[$row][1]; ?>"id="product" name="product_id" value="<?php $products_data[$row][0]; ?>">

                                        <option value="">
                                                 <?php echo $products_data[$row][1]; ?>
                                        </option>
                                    </a>
                                    </form>
                                <?php }?>
                                
                            </select>
                        </div>                    
                    </div>
                </div>
                <div class="row justify-content-center bg-light">
                    <div class="col-3">
                        <p> Warehouse: </p>
                    </div>
                    <div class="col-3 p-2">
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Warehouse
                            </a>

                            <ul class="dropdown-menu">
                                <?php for ($row = 0; $row < count($products_data); $row++) { ?>
                                        <li>
                                            <a class="dropdown-item" href="http://localhost/Container-Scheduling-and-management/t1.php?product_name=<?php echo $products_data[$row][1]; ?>" id="warehouse" name="product_id" value="<?php $products_data[$row][0]; ?>">
                                                <?php echo $products_data[$row][2]," ",$products_data[$row][1]; ?>
                                            </a>
                                        </li>
                                <?php }?>
                            </ul>
                        </div>                  
                    </div>
                </div>
            </div>
            
            <div class="col-2 p-2">
                <input type="number" class="form-control" id = "quantity" name = "quantity" placeholder="Quantity">
            </div>
           
        </div>
    </div>
  
    <div class="container">
        <div class="row mt-2 justify-content-center">
                
                <?php
                if($selected_product_flag == 1)
                    { ?>
                            <?php for ($row = 0; $row < count($selected_product_data); $row++) { ?>

                                <div class="card mx-1 mb-3 h-100" style="max-width: 400px;">
                                    <div class="row g-0">
                                        <div class="col-md-1">

                                            <input class="form-check-input" type="checkbox" value="<?php echo $selected_product_data[$row][0],"/",$selected_product_data[$row][1],"/",$selected_product_data[$row][2]
                                                                                                    ,"/",$selected_product_data[$row][7],"/",$selected_product_data[$row][8],"/",$selected_product_data[$row][9]; ?>"  id="checkbox" name="check_box">
                                        </div>
                                        <div class="col-md-5 m-1">
                                        <img src="data:image/png;charset=utf8;base64,<?php echo base64_encode($selected_product_data[0][6]); ?>" width = "150px" height="150px" class="img" alt="Product image">
                                        </div>
                                        <div class="col-md-5 ml-1">
                                        <div class="card-body p-0">
                                            <h5 class="card-title">Product details</h5>
                                            <p class="m-0 card-text"><b>Name:</b> <?php echo $selected_product_data[$row][2]," ",$selected_product_data[$row][1]; ?></p>
                                            <p class="m-0 card-text"><small class="text-muted"><b>Price:</b>  <?php echo "$",$selected_product_data[$row][7]; ?></small></p>
                                            <p class="m-0 card-text"><small class="text-muted"><b>  Exported by:</b>  <?php echo $selected_product_data[$row][9]; ?></small></p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        
                            <?php }?>
                            <div class="row">
                                <div class="col-3 p-2">
                                    <form action="test.php" method="post">
                                        <input type="hidden" id="poster" value=""/>
                                        <button type="button" onclick="set_product_id()" class="btn btn-primary">
                                                                                                                Add
                                                               
                                                                                                                <a class="text-decoration-none " href="test.php">                                             </button>
                                                                <button type="button" onclick="set_product_id()" class="btn btn-primary">
                                                                                                                
                                                                                                                    Add to art
                                                                                                                
                                                                                                                </button>
                                                                                                                </a>
                            </form>
                                </div>
                            </div>
                <?php } ?>
        </div>

        
    </div>
    
            
       
</div>

            
      <script>
        var product_ids = [];
        var selected = [];

        function addToCart(products)
        {
            console.log("PIds:",[...new Set(selected)]);
            // quantity = document.getElementById("quantity").value;
            // document.getElementById("product_id").innerHTML = "Hello";
        }
        function set_product_id()
        {
            console.log("Ids:",[...new Set(selected)]);
            localStorage.clear();
            // checkbox = document.getElementById("checkbox");
           var checkboxes = document.getElementsByName("check_box");
           var value  = document.getElementsByName("quantity").value;
           var quantity   = document.getElementById("quantity").value;
           console.log("check:", value);
            // var selected = [];
            for (var i=0; i<checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    selected.push(checkboxes[i].value);
                    console.log("Inside checkbox:",checkboxes[i].value.split("/"), quantity,document.getElementById("product").innerHTML,document.getElementById("warehouse").innerHTML);
                    data = checkboxes[i].value.split("/");

                    var product_data = {
                    "product_id"    : parseInt(data[0]),
                    "product_name"  : data[1],
                    "quantity"      : parseInt(quantity),
                    "price"         : parseInt(data[3]),
                    "exporter_id"   : parseInt(data[4]),
                    "exporter_name" : data[5]
                    }
                    json_data = JSON.stringify(product_data);

                    localStorage.setItem(parseInt(data[0]), json_data);

                }
            }
            console.log(selected);
        
        

        console.log("PIds:",[...new Set(selected)]);
        // poster = document.getElementById("poster");
        // poster.value = JSON.stringify(selected);

        }

        var check = 1;
        function add_to_cart(product_id,product_name,
                            product_brand,product_type,
                            exporter_id,exporter_name)
        {
          if (check == 1)
          {
            localStorage.clear();
            check = 2;
          }
          console.log(product_id,product_name,
                            product_brand,product_type);

        var quantity = parseInt(document.getElementById(String(product_id)).innerHTML);
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

        data = JSON.stringify(product_data);
        // data = JSON.parse(data_crude);

         localStorage.setItem(product_id, data);
        //  console.log(JSON.parse(localStorage.getItem(7)));
        }


        function quantity_counter(operation,element_id)
        {
          // localStorage.clear();
          // var i = localStorage.getItem(6);
          // var obj = JSON.stringify(i);
          // alert(JSON.stringify(i));
          // console.log(obj);
          value = parseInt(document.getElementById(String(element_id)).innerHTML);
          if (operation > 0)
          {
            document.getElementById(String(element_id)).innerHTML = value + 1;
          }
          else
          {
            if(value > 0)
            document.getElementById(String(element_id)).innerHTML = value - 1;
            else
            {
              document.getElementById(String(element_id)).innerHTML = value;
            }
          }
          
        }
        </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>

