<!-- My Purchased Record -->
<!-- title -->
<h5 class="title">Purchased Record</h5>

<table class="table table-striped tcart">
  <thead>
    <tr>
      <th>Date</th>
      <th>Name</th>
      <th>Price</th>
      <th>Status</th>
      <th>View</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($purchase as $key => $value) { ?>
    <tr>
      <td><?php echo $value[order_time]; ?></td>
      <td>
      <!-- get the target item's url -->
      <a href="<?php echo SharIt::app()->createUrl('product/single-item.php', array('pid' => $value[product_id]))?>">
      <?php echo $value[name]; ?>
      </a>
      </td>
      <td><?php echo $value[price]; ?></td>
      <td><?php
      switch ($value[status]) {
        case 0:
          echo "WAITPAYMENT";
          break;
        case 1:
          echo "WAITSHIPPING";
          break;
        case 2:
          echo "DISPATCHED";
          break;
        case 3:
          echo "SELLERVIEWING";
          break;
        case 4;
          echo "SUCCEED";
          break;
        case 5:
          echo "CANCELED";
          break;
      }
      ?></td>
      <td><?php 
                  if($value[status]!=5){?>
                    <form action="<?php echo SharIt::app()->createUrl('order/view_order.php', array('oid' => $value[id]))?>" method="post">
                    <button class="btn btn-primary btn-sm" type="submit" name="view" value="submit" >View</button>
                    </form><?php }?>
      </td>
    </tr> 
    <?php } ?>                                                                                                            
  </tbody>
</table>

<?php
$page_filter = $filter;
$page_filter['page']='[:page]';
echo SharHTML::paging($filter[page], $totalPageNum, SharIt::app()->createUrl('user/publish.php',$page_filter));
?> 
                                                      