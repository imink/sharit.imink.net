<!-- My requested Record -->
<!-- title -->

<h5 class="title">Requested Record</h5>

  <table class="table table-striped tcart">
    <thead>
      <tr>
        <th>Date</th>
        <th>title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- list the show request -->
      <?php foreach ($request as $key => $value) { ?>
      <tr>
        <form action="<?php echo SharIt::app()->createUrl('user/request.php') ?>" method="post">
        <input type="hidden" name="status[id]" value="<?php echo "$value[id]";?>" >
        <?php if($value[status]==SharQuery::$STATUSCODE['request_status']['SHOW'])
          echo "<input type=\"hidden\" name=\"status[action]\" value=\"0\" >";
        elseif($value[status]==SharQuery::$STATUSCODE['request_status']['HIDDEN'])
          echo "<input type=\"hidden\" name=\"status[action]\" value=\"1\" >";?>
        <td><?php echo $value[ts] ?></td>
        <td>
        <!-- get the target item's url -->
        <a href="<?php echo SharIt::app()->createUrl('request/single.php',array('id'=>$value[id]))?>">
        <?php echo $value[topic] ?>
        </a>
        </td>
        <td><?php echo SharQueryMain::getCategory($value[category_id]) ?></td>
        <td><?php 
                  if($value[status]==SharQuery::$STATUSCODE['request_status']['SHOW'])
                    echo 'SHOW';
                  elseif($value[status]==SharQuery::$STATUSCODE['request_status']['HIDDEN'])
                    echo 'HIDDEN';
                  elseif($value[status]==SharQuery::$STATUSCODE['request_status']['DELECT'])
                    echo 'DELETED';?></td>
        
        <td>
        <?php if($value[status]==SharQuery::$STATUSCODE['request_status']['SHOW']||
                  $value[status]==SharQuery::$STATUSCODE['request_status']['HIDDEN']){ ?>
          <button class="btn btn-primary btn-xs" type="submit" name="status[submit]" value="submit" >
          <?php 
                  if($value[status]==SharQuery::$STATUSCODE['request_status']['SHOW'])
                    echo 'HIDDEN';
                  elseif($value[status]==SharQuery::$STATUSCODE['request_status']['HIDDEN'])
                    echo 'SHOW';?></button>
        <?php }?>
        </td>
        
        </form>
      </tr>
      <?php } ?>  

    </tbody>
  </table>

<?php
$page_filter = $filter;
$page_filter['page']='[:page]';
echo SharHTML::paging($filter[page], $totalPageNum, SharIt::app()->createUrl('user/request.php',$page_filter));
?>                                                                   