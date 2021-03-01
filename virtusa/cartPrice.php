<?php
/** Have used session to store the cart, for Manual testing we need to change the quantity or can remove products */
@session_start();
$_SESSION['cart']['A'] = array('sku'=>'A','qty'=>3);
$_SESSION['cart']['B'] = array('sku'=>'B','qty'=>2);
$_SESSION['cart']['C'] = array('sku'=>'C','qty'=>5);
$_SESSION['cart']['E'] = array('sku'=>'E','qty'=>1);
$_SESSION['cart']['D'] = array('sku'=>'D','qty'=>5);

class cartPrice
{
    public $price =0;
    /**
     * Class constructor.
     */
    public function __construct()
    {
                    $this->host = 'localhost:3308';
                    $this->user = 'root';
                    $this->pass = '';
                    $this->db = 'vcart';
                    $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
    }
    // Function to calculate the cart price
    public function calculatePrice()
    {
        if(count($_SESSION['cart'])>0){
            foreach($_SESSION['cart'] as $items)
            {
                foreach($items as $key => $value)
                {
                    // Validate the quantity
                    if($key == "sku" && $_SESSION['cart'][$value]['qty'] >=1 )
                    { 
                        // Query to get product details
                        $sql ="select * from products where sku = '$value'";
                        // Fetch the product quantity form Session
                        $qty = $_SESSION['cart'][$value]['qty'];
                        // Query to fetch the actual and offer data
                        $result =$this->mysqli->query($sql);
                        $row = $result->fetch_array(MYSQLI_ASSOC);
                        // Offer Type 1 Code Starts
                        if($row['offer_type'] ==1){
                            $divident  = floor( $qty / $row['offer_1'] ) ;
                            $reminder  = floor( $qty % $row['offer_1'] ) ;
                            $this->price += $divident*$row['offer_1_price'];
                            $this->price += $reminder*$row['unit_price'];
                        } 
                        // Offer Type 1 Ends
                        // Offer Type 2 Code Starts
                        if($row['offer_type'] ==2){
                       
                            $divident  = floor( $qty / $row['offer_1'] ) ;
                            $this->price += $divident*$row['offer_1_price'];
            
                            $reminder  = floor( $qty % $row['offer_1'] );
                            if($reminder==2){
                                $this->price += 1 * $row['offer_2_price'];
                            }
                            if($reminder==1){
                                $this->price += 1 * $row['unit_price'];
                                }
                         }
                         // Offer Type 2 Ends
                         // Offer Type 3 Code Starts
                         if($row['offer_type'] ==3){
                            // To get the combined product and 
                            $combinedProduct  = $row['offer_1'];
                            // To get the quntity of the product from session
                            $combinedProdQuantity = $_SESSION['cart'][$combinedProduct]['qty'];
                            if($qty <= $combinedProdQuantity){
                                $this->price += $qty*$row['offer_1_price'];
                            }
                            if($qty > $combinedProdQuantity){
                              $toBePricedAtActualPrice = $qty - $combinedProdQuantity;
                              $this->price+=$toBePricedAtActualPrice*$row['unit_price'];
                              $this->price+=$combinedProdQuantity*$row['offer_1_price'];
                            }
                         } 
                          // Offer Type 3 Ends
                           // Offer Type 0 Code Starts
                            if($row['offer_type']==0){
                                $this->price += $qty*$row['unit_price'];
                            } 
                         // Offer Type 0 Ends
                    }  // END of if SKU 
                } // END OF INNER FOREACH
            }
            // Return Total Price
            return  $this->price;  
        } // End of Outer foreach
   }  // END of calculatePrice
}  // END of Class

// Create a OBJECT
$cal = new cartPrice();
echo "Cart Value = ". $cal->calculatePrice();
?>