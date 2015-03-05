  <!-- my published records -->
<!-- title -->
<?php
// $publish
?>
<h5 class="title">Published Records</h5>

  <table class="table table-striped tcart table-hover">
    <!-- header of table -->
    <thead>
      <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Title</th>
        <th>Price</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Action</th>
      </tr>
    </thead>
    <!-- body of table -->

    <tbody>
      <!-- on sell -->
      <?php foreach ($product as $key => $value) { ?>
      <tr>
        <form action="<?php echo SharIt::app()->createUrl('user/edit_product.php' ) ?>" method="post">
          <input type="hidden" name="pid" value="<?php echo $value[id]?>" >
          <td name="edit[pid]"><?php echo $value[id] ?></td>
          <td><?php echo $value[upload_time] ?></td>
          <td>
            <!-- get the target item's url -->
            <a href="<?php echo SharIt::app()->createUrl('product/single-item.php',array('pid'=>$value[id]))?>">
            <?php echo $value[name]; ?>
            </a>
          </td>
          <td><?php echo $value[price]; ?></td>
          <td><?php 
                  if($value[status] == SharQuery::$STATUSCODE['product_status']['ONSELL'])
                    echo 'On Sale'; 
                  elseif($value[status] == SharQuery::$STATUSCODE['product_status']['SOLDOUT'])
                    echo 'Sold Out';
                  elseif($value[status] == SharQuery::$STATUSCODE['product_status']['DELETE_SOLDOUT'])
                    echo 'Deleted Sold Out';
                  elseif($value[status] == SharQuery::$STATUSCODE['product_status']['DELETE_ONSELL']) 
                    echo 'Deleted On Sell';?>
          </td>
        
          <td><?php 
                  if($value[status] == SharQuery::$STATUSCODE['product_status']['ONSELL']
                      ||$value[status] == SharQuery::$STATUSCODE['product_status']['DELETE_ONSELL']){?>
            <button class="btn btn-primary btn-sm" type="submit" name="edit" value="submit" >Edit</button><?php }?>
           </form><?php 
                  if($value[oid]&&($value[status] == SharQuery::$STATUSCODE['product_status']['SOLDOUT']||$value[status] == SharQuery::$STATUSCODE['product_status']['DELETE_SOLDOUT'])){?>
                    <form action="<?php echo SharIt::app()->createUrl('order/view_order.php',array('oid'=>$value[oid])) ?>" method="post">
                    <button class="btn btn-primary btn-sm" type="submit" name="view" value="submit" >View</button>
                    </form><?php }?>
          </td>
        
        <form action="<?php echo SharIt::app()->createUrl('user/publish.php') ?>" method="post">
          <input type="hidden" name="pid" value="<?php echo $value[id]?>" >
          <td><?php 
                  if($value[status] == SharQuery::$STATUSCODE['product_status']['DELETE_SOLDOUT']){?>
                    <button class="btn btn-danger btn-sm" type="submit" name="act[activeSoldout]" value="submit" >Active</button> 
            <?php }elseif($value[status] == SharQuery::$STATUSCODE['product_status']['DELETE_ONSELL']){?>
                    <button class="btn btn-danger btn-sm" type="submit" name="act[activeOnsell]" value="submit" >Active</button>
            <?php }elseif($value[status] == SharQuery::$STATUSCODE['product_status']['ONSELL']){?>
                    <button class="btn btn-primary btn-sm" type="submit" name="act[frozen]" value="submit" >Delete</button>
            <?php }elseif($value[status] == SharQuery::$STATUSCODE['product_status']['SOLDOUT']){?>
                    <button class="btn btn-primary btn-sm" type="submit" name="act[delete]" value="submit" >Delete</button><?php }?>
           
        </form></td>
      </tr>
      <?php } ?>                                                                                          
    </tbody>
  </table>

<!-- Pagination -->
<?php
$page_filter = $filter;
$page_filter['page']='[:page]';
echo SharHTML::paging($filter[page], $totalPageNum, SharIt::app()->createUrl('user/publish.php',$page_filter));
?>                                                        