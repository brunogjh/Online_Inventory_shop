<?php
include "db.php";
require "./cache.php";
include "header.php";
?>

<!-- this is the part where i add the content for profile -->

<?php
    if($_SESSION['uid'] == null || !isset($_SESSION['uid'])){ 
        echo $_SESSION['uid'];
?>
<div>
    Please login.
</div>
<?php } ?>

<div class="content" style='width: 90%; margin-left: auto; margin-right:auto'>
    <div class="container-fluid">
        <div class="col-md-14">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">
                        Order History
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive ps">
                        <table class="table table-hover tablesorter">
                            <thead class="text-primary">
                                <tr>
                                    <th>
                                        Order ID
                                    </th>
                                    <th>
                                        Products
                                    </th>
                                    <th>
                                        Number of Products (QTY)
                                    </th>
                                    <th>
                                        Total Price
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                <?php 
                                    $order_query = "SELECT * FROM orders_info WHERE user_id = $_SESSION[uid]";

                                    $run = mysqli_query($con, $order_query);

                                    if(mysqli_num_rows($run) > 0){
                                        // there are rows/ past orders 

                                        while ($row = mysqli_fetch_array($run)){
                                            $order_id = $row['order_id'];
                                            $total_amount = $row['total_amt'];
                                            $qty = $row['prod_count'];
                                            $status = $row['status'];
                                        // shifted the 2 ending } to the bottom to continue echoing correctly
                                ?>

                                <tr>
                                    <td>
                                        <?php echo $order_id ?>
                                    </td>

                                    <td> 
                                        <?php
                                            // TO GET THE PRODUCTS IN THE ORDER
                                            $query1 = "SELECT * FROM order_products where order_id = $order_id";
                                            $run1 = mysqli_query($con,$query1); 
                                            while($row1 = mysqli_fetch_array($run1)){
                                                $product_id = $row1['product_id'];
                                                
                                                // TO GET THE ACTUAL PRODUCT
                                                $query2 = "SELECT * FROM products where product_id = $product_id";
                                                $run2 = mysqli_query($con,$query2);

                                                while($row2 = mysqli_fetch_array($run2)){
                                                $product_title = $row2['product_title'];
                                        ?>
                            
                                            <?php 
                                                echo $product_title 
                                            ?>

                                            <br>

                                            <?php }}?>
                                    </td>

                                    <td>
                                        <?php echo $qty ?>
                                    </td>
                                    <td>
                                        <?php echo $total_amount ?>
                                    </td>
                                    <td>
                                        <?php echo $status ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <?php
                                } else{
                                    echo "<center><h2>No past orders</h2></center>";
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include "footer.php";
mysqli_close($con);
?>
