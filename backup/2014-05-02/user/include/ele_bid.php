<!-- My Bid records -->
<!-- title -->


<h5 class="title">Bid Record</h5>

  <table class="table table-striped tcart table-hover">
    <!-- header -->
    <thead>
      <tr>
        <th>Date</th>
        <th>Item</th>
        <th>Highest Price</th>
        <th>My Price</th>
        <th>Status</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($bid as $key => $value) { ?>
      <tr>
        <td><?php echo $value[ts];?></td>
        <td>
          <a href="<?php echo SharIt::app()->createUrl('product/single-item.php',array('pid'=>$value[product_id])) ?>">
          <?php echo $value[name];?>
          </a>
        </td>
        <td><?php echo $value[highprice];?></td>
        <td><?php echo $value[price];?></td>
        <td>Bid</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

<?php
$page_filter = $filter;
$page_filter['page']='[:page]';
echo SharHTML::paging($filter[page], $totalPageNum, SharIt::app()->createUrl('user/publish.php',$page_filter));
?>                                                       