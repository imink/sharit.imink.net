<?php 
//$requestList
?>
<!-- title -->
<h5 class="title">Request List</h5>
<?php if($requestList){ ?>
<table class="table table-striped tcart">
    <thead>
      <tr>
        <th>Topic</th>
        <th>Last Update</th>
      </tr>
    </thead>

    <tbody>
        <!-- TODO - Here should be specified by category id and each item's id -->
        <?php
        foreach($requestList as $key => $value) { 
          echo "<tr><td><a href=\"";
          echo SharIt::app()->createUrl('request/single.php',array('id'=>$value[id]));
          echo "\">$value[topic]</a></td><td>$value[ts]</td></tr>";
        }
        ?>
    </tbody>
</table>
    
<!-- Pagination -->
<?php
$page_filter = $filter;
$page_filter['page']='[:page]';
echo SharHTML::paging($filter[page], $totalPageNum, SharIt::app()->createUrl('request/list.php',array($page_filter)));
}else{
  echo "<h6>There is no request under this category.</h6>";
}
?> 

