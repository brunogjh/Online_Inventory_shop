<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";
require "cache.php";
$cacheService = new CacheService();
if(isset($_POST["categoryhome"])){
	
	echo "
		
				<!-- responsive-nav -->
				<div id='responsive-nav'>
					<!-- NAV -->
					<ul class='main-nav nav navbar-nav'  style='width:100%; '>
                    <li class='active'><a href='index.php'>Home</a></li>
					<li style='padding-right: 2%'><a href='store.php'>All</a></li>
					
	";
	$category_query = "SELECT * FROM categories";
	// Define a callback function that fetches data from RDS if not found in the cache
	$navbar_callback = function () use ($con, $category_query) {
		$run_query = mysqli_query($con, $category_query) or die(mysqli_error($con));
		$dataArray = array();
		while ($row = mysqli_fetch_array($run_query)) {
			
			$dataArray[] = array($row["cat_id"], $row["cat_title"]);
		}
		return $dataArray;
	};
	$run_query = $cacheService->getFromCacheOrDatabase($category_query, $navbar_callback);
	if ($run_query) {
        if ($run_query instanceof mysqli_result && mysqli_num_rows($run_query) > 0) {
            while ($row = mysqli_fetch_array($run_query)) {
				
                $cid = $row["cat_id"];
                $cat_name = $row["cat_title"];

                // $sql = "SELECT COUNT(*) AS count_items FROM products,categories WHERE product_cat=cat_id";
                // $query = mysqli_query($con, $sql);
                // $row = mysqli_fetch_array($query);
                // $count = $row["count_items"];

                echo "<li class='categoryhome' cid='$cid'><a href='store.php'>$cat_name</a></li>";
            }
        } else {
			foreach ($run_query as $row){
				
				$cid = $row[0];
                $cat_name = $row[1];

                // $sql = "SELECT COUNT(*) AS count_items FROM products,categories WHERE product_cat=cat_id";
                // $query = mysqli_query($con, $sql);
                // $row = mysqli_fetch_array($query);
                // $count = $row["count_items"];

                echo "<li class='categoryhome' cid='$cid'><a href='store.php'>$cat_name</a></li>";
			}
        }
    } else {
        echo "Unable to retrieve data from the cache or database.";
        // Handle the case when data retrieval fails
    }
}


if(isset($_POST["page"])){
	$sql = "SELECT * FROM products";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/2);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#product-row' page='$i' id='page'>$i</a></li>
            
            
		";
	}
}
if(isset($_POST["getProducthome"])){
	$limit = 3;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM products,categories WHERE product_cat=cat_id LIMIT $start,$limit";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			  $pro_dis=$row['product_discount'];
            
            $cat_name = $row["cat_title"];
			echo "
				
                       <div class='product-widget'>
                                <a href='product.php?p=$pro_id'> 
									<div class='product-img'>
										<img src='product_images/$pro_image' alt=''>
									</div>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price'>RM $pro_price<del class='product-old-price'>RM $pro_dis</del></h4>
									</div></a>
								</div>
                        
			";
		}
	}
	
}


if(isset($_POST["gethomeProduct"])){
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
    
	$product_query = "SELECT * FROM products,categories WHERE product_cat=cat_id AND product_id BETWEEN 71 AND 74";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
        
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			  $pro_dis=$row['product_discount'];
            
            $cat_name = $row["cat_title"];
            
			echo "
				
                        
                                <div class='col-md-3 col-xs-6'>
								<a href='product.php?p=$pro_id'><div class='product'>
									<div class='product-img'>
										<img src='product_images/$pro_image' style='max-height: 170px;' alt=''>
										<div class='product-label'>
											<span class='sale'>-30%</span>
											<span class='new'>NEW</span>
										</div>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>RM $pro_price<del class='product-old-price'>RM $pro_dis</del></h4>
										
										
									</div>
									<div class='add-to-cart'>
										<button pid='$pro_id' id='product' class='add-to-cart-btn block2-btn-towishlist' href='#'><i class='fa fa-shopping-cart'></i> add to cart</button>
									</div>
								</div>
                                </div>
							
                        
			";
		}
        ;
      
	}
    
	}
    
if(isset($_POST["get_seleted_Category"]) ||  isset($_POST["search"])){
	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM products,categories WHERE product_cat = '$id' AND product_cat=cat_id";
	}else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM products,categories WHERE product_cat=cat_id AND product_keywords LIKE '%$keyword%'";
	}
	
	$run_query = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			  $pro_dis=$row['product_discount'];
            $cat_name = $row["cat_title"];
			echo "
					
                        
                        <div class='col-md-4 col-xs-6'>
								<a href='product.php?p=$pro_id'><div class='product'>
									<div class='product-img'>
										<img  src='product_images/$pro_image' style='max-height: 170px;' alt=''>
										<div class='product-label'>
											<span class='sale'>-30%</span>
											<span class='new'>NEW</span>
										</div>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>RM $pro_price<del class='product-old-price'>RM $pro_dis</del></h4>
										
										
									</div>
									<div class='add-to-cart'>
										<button pid='$pro_id' id='product' href='#' tabindex='0' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> add to cart</button>
									</div>
								</div>
							</div>
			";
		}
	}
