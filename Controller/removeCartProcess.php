<?php

require_once __dir__.'/../Model/login_signup.php';
session_start();

$pid = $_POST['product_id'];
$userEmail = $_SESSION['userEmail'];

$queryOb = new LoginSignup();

$queryOb->removeCart($userEmail,$pid);
$result = $queryOb->fetchCart($userEmail);
$price = $queryOb->totalPrice($userEmail);
?>
<?php if (!$result): ?>
  <h1>THERE IS NOTHING IN YOUR CART</h1>
  <?php else: ?>
    <table>
      <tr>
        <th>Name</th>
        <th>Details</th>
        <th>Price</th>
      </tr>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo $row['Product_name']?></td>
          <td><?php echo $row['caption']?></td>
          <td><?php echo $row['price']?></td>
          <td><button class="button delete" data-product-id="<?php echo $row['Product_id'] ?>">Remove</button></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="3"><button class="button buy" data-product-id="<?php echo $row['Product_id'] ?>">Buy Now</button></td>
        <td>Total: 
          <?php echo $price['PRICE'] ?>
        </td>
      </tr>
    </table>
<?php endif;?>
