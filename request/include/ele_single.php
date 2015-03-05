<?php
//$single_Request[topic]
//$single_Request[ts]
//$single_Request[username]
//$single_Request[category_id]
//$single_Request[category]
//$single_Request[replyNo]
//$single_Request[message]
//$reply[picture_name]
//$reply[item_name]
//$reply[item_id]
//$reply[ts]
//$reply[item_price]
//$replier[id]
//$replier[item_list]
//$requester_id

//$replyForm
//$replyFormError

$requester_id = $single_Request[requester_id];

if ($replyFormError){
  SharHTML::alert('danger',$replyFormError);
}
// print_r($reply);

?>
<div class="entry">
   <h4><?php echo $single_Request[topic]; ?></h4>
   
   <!-- Meta details -->
   <div class="meta">
      <i class="icon-calendar"> <?php echo $single_Request[ts]?></i>
      <i class="icon-folder-open"> <a href="<?php echo SharIt::app()->createUrl('request/list.php',array('cid'=>$single_Request[category_id]))?>"><?php echo $single_Request[category]?></a></i>
      <i class="icon-user"> <a href="<?php echo SharIt::app()->createUrl('user/view.php',array('uid'=>$requester_id))?>"><?php echo $single_Request[username]?></a></i>
         
      <span class="pull-right">
         <i class="icon-comment"></i> <?php echo $single_Request[replyNo]?> Reply
      </span>
   </div>
   <br>
   <p><?php echo $single_Request[message]?></p>
</div>

<?php if($reply){?>
<div class="comments well">
   <!-- Comment title -->
      <div class="title"><h4>Reply</h4></div>
      
      <ul class="comment-list">
      <?php foreach($reply as $key => $value): ?>
        <li class="comment">
            <!-- Avatar -->
            <div class="col-md-4 col-sm-8">
            <img class="avatar" style="width: 100%; float: left; margin-right: -100%; position: relative;"
            src="<?php echo SharHTML::imgUrl($value[picture_name])?>" alt="" >
            </div>
          <!-- Author -->
            <div class="comment-author">
                <a href="<?php echo SharIt::app()->createUrl('product/single-item.php',array('pid'=>$value[item_id]))?>">
                    <?php echo $value[item_name];?>
                </a>
            </div>
            <!-- Reply date -->
            <div class="cmeta">Replied on <?php echo $value[ts];?></div>
            <div class="item-details">
                <p><b>Status: </b><?php echo $value[item_status];?></p>
                <hr>
                <div class="item-price pull-left">£ <?php echo $value[item_price];?></div>
                <div class="button pull-right">
                    <a href="<?php echo SharIt::app()->createUrl('product/single-item.php',array('pid'=>$value[item_id]))?>">
                    View Details
                    </a>    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </li>
        <?php endforeach ?>
      </ul>
</div>
<?php 
  }else{
    echo "<hr><h6>Currently there is no reply for this request.</h6>";
  }
?>

<?php 
if($check[login]=='true'){
if ($replier[id] != $requester_id){
?>
<div class="respond well">
  <!-- Form title -->
   <div class="title"><h4>Post Reply</h4></div>
   <!-- Comment form -->
   <div class="form">
     <form class="form-horizontal" method="post">

         <div class="form-group">
            <label class="control-label col-md-3" for="category">Select an Item</label>
            <div class="col-md-8"> 
            <!-- Use two loops to print these options -->                              
               <select class="form-control" name = "postReply[item_id]" required>
                   <option disabled selected value= -1> --- Please Select --- </option>
                    <?php
                    $repliesIDSet = array();
                    foreach ($reply as $id => $r) {
                      array_push($repliesIDSet, $r[item_id]);
                    }

                    foreach($replier[item_list] as $key => $value){
                        if(!in_array($key, $repliesIDSet)){
                          $selected = '';
                          if($replyForm[item_id] && $replyForm[item_id]!=-1)
                              $selected = 'selected';
                          echo "<option value=\"$key\" $selected>$value</option>";
                        }
                    }
                    ?>   
               </select>
            </div>
         </div>
         <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
               <input type="checkbox" name="postReply[agree]" value="on">
               I have read and accept the terms of use
               <button type="submit"  name='postReply[submit]' class="btn btn-danger">Submit</button>
            </div>
         </div>
     </form>
   </div>
</div>
<?php 
}
}else{
?>
<br>
<h3 class="title"><span class="color">Sorry! </span> You do not have the authority to reply a request.</h3>


<h5>Why not register an account and post your product?</h5>


<h4><a href="<?php echo SharIt::app()->createUrl('register.php')?>">Register</a> Now!</h4>
<h5>Already have an account? <a href="<?php echo SharIt::app()->createUrl('login.php')?>">Login</a> here.</h5>


<br>
<p>You can also <a href="<?php echo SharIt::app()->createUrl('about/contact.php')?>">contact</a> our staff for more information.</p>
<hr>
 <!-- Some site links -->
<div class="horizontal-links">
  <h5>Take a look around our site</h5>
  <a href="<?php echo SharIt::app()->createUrl('index.php')?>">Home</a>
  <a href="<?php echo SharIt::app()->createUrl('about/about.php')?>">About Us</a>
  <a href="<?php echo SharIt::app()->createUrl('about/contact.php')?>">Contact Us</a>
  <a href="<?php echo SharIt::app()->createUrl('about/policy.php')?>">Policy</a>
</div>
<?php } ?>
<div class="clearfix"></div>