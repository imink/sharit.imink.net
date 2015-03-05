<!-- My Q&A records -->

<h5 class="title">Q&A Records</h5>
<?php if($question){ ?>
<h6 class="title">Questions</h6>

<table class="table table-striped tcart">
  <thead>
    <tr>
      <th>Question Date</th>
      <th>Item Name</th>
      <th>Question</th>
    </tr>
  </thead>
  <tbody>
  <!-- question -->
  <?php foreach ($question as $key => $value) { ?>
  <tr>
    <td><?php echo $value[question_time] ?></td>
    <td>
    <!-- get the target item's url -->
    <a href="<?php echo SharIt::app()->createUrl('product/single-item.php',array('pid'=>$value[product_id]))?>">
    <?php echo $value[name] ?>
    </a>
    </td>
    <td><?php echo $value[question] ?></td>
  </tr>    
  <?php } ?> 
  </tbody>     
  </table>
<!-- Pagination -->
<?php
$page_filter = $filter;
$page_filter['pageq']='[:page]';
echo SharHTML::paging($filter[pageq], $totalPageNum[question], SharIt::app()->createUrl('user/q&a.php',$page_filter));
?>  
<?php }else{?>
<br>
<h4 class="title"><span class="color">Sorry! </span> You haven't asked any question.</h4>
<br>
<p>You can search more <a href="<?php echo SharIt::app()->createUrl('product/items.php')?>"><b>PRODUCTS</b></a> which you are interested in.</p>
<br>
<?php }?>

<br /><br />
<!-- answer -->
<?php if($answer){ ?>
<h6 class="title">Answer</h6>
<table class="table table-striped tcart">
  <thead>
    <tr>
      <th>Answer Date</th>
      <th>Item Name</th>
      <th>Answer</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($answer as $key => $value) { ?>
  <tr>
    <td><?php echo $value[answer_time] ?></td>
    <td>
    <!-- get the target item's url -->
    <a href="<?php echo SharIt::app()->createUrl('product/single-item.php',array('pid'=>$value[product_id]))?>">
    <?php echo $value[name] ?>
    </a>
    </td>
    <td><?php echo $value[answer] ?></td>
  </tr>    
  <?php } ?>                                                                                                     
  </tbody>
</table>
<!-- Pagination -->
<?php
$page_filter = $filter;
$page_filter['pagea']='[:page]';
echo SharHTML::paging($filter[pagea], $totalPageNum[answer], SharIt::app()->createUrl('user/q&a.php',$page_filter));
?> 
<?php }else{ ?>
 <br>
<h4 class="title"><span class="color">Sorry! </span> You haven't answered any question.</h4>
<br>
<p>You can check if there are some questions about the products you've <a href="<?php echo SharIt::app()->createUrl('user/publish.php')?>"><b>PUBLISHED</b></a>.</p>
<br>
<!-- if user has login start -->
<p>You can also <a href="<?php echo SharIt::app()->createUrl('publish/index.php')?>"><b>PUBLISH</b></a> a new item here.</p>
<br>

<?php }?>                                                      