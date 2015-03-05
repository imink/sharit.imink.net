<?php
    include(dirname(__FILE__)."/modal_bid.php");
    include(dirname(__FILE__)."/modal_reply.php");

    $condition = array('10'=>'New In Box',
                    '9'=>'Unused',
                    '8'=>'Mint In Box',
                    '7'=>'Mint',
                    '6'=>'Like New',
                    '5'=>'Excellent',
                    '4'=>'Good',
                    '3'=>'Fair',
                    '2'=>'Bargain Grade',
                    '1'=>'Poor');
    $conditionID = $product[product_condition];
    if ($questionErrors){
      SharHTML::alert('danger',$questionErrors);
    }
    if ($replyErrors){
      SharHTML::alert('danger',$replyErrors);
    }

    if ($bidErrors){
      SharHTML::alert('danger',$bidErrors);
    }


SharIt::page()->registerScript('function setTargetQid(id){$("#targetQid").val(id);}','POS_END');
SharIt::page()->registerScriptFile('js/Chart.js',true,'POS_BEGIN');

if($product[on_bid] == 1) { 
  SharIt::page()->registerScriptFile('js/jquery.plugin.min.js',true,'POS_BEGIN');
  SharIt::page()->registerScriptFile('js/jquery.countdown.min.js',true,'POS_BEGIN');
  SharIt::page()->registerCssFile('css/jquery.countdown.css');
  $duedate = getdate(strtotime($product[due_date] ." ".SHARIT_BID_HOUR.":00:00"));
  SharIt::page()->registerScript("$(function(){var dueDate = new Date($duedate[year],$duedate[mon]-1,$duedate[mday],$duedate[hours],$duedate[minutes],$duedate[seconds]);$('#bidCountdown').countdown({until: dueDate});});",'POS_BEGIN');
}
// print_r($pictureList);
?>
<?php if($product[status]==2):?>
  <h2 class="title"><span class="color">Sorry! </span> The product has been deleted.</h2>

  <p>You can <a href="<?php echo SharIt::app()->createUrl('about/contact.php')?>">contact</a> our staff for more information.</p>
<hr>
 <!-- Some site links -->
<div class="horizontal-links">
  <h5>Take a look around our site</h5>
  <a href="<?php echo SharIt::app()->createUrl('index.php')?>">Home</a>
  <a href="<?php echo SharIt::app()->createUrl('about/about.php')?>">About Us</a>
  <a href="<?php echo SharIt::app()->createUrl('about/contact.php')?>">Contact Us</a>
  <a href="<?php echo SharIt::app()->createUrl('about/policy.php')?>">Policy</a>
</div>

<?php else: ?>

<!-- Breadcrumbs -->
<!--         <ul class="breadcrumb">
  <li><a href="index.html">Home</a> <span class="divider">/</span></li>
  <li><a href="items.html">Smartphone</a> <span class="divider">/</span></li>
  <li class="active">Apple</li>
</ul> -->

<!-- Product details starts -->
<div class="product-main">
  <div class="row">
    <div class="col-md-6 col-sm-6">

      <!-- Image. Flex slider -->
        <div class="product-slider">
          <div class="product-image-slider flexslider">
            <ul class="slides">
                <!-- Each slide should be enclosed inside li tag. -->
                
                <!-- Slide #1 Main Slide -->
              <li style="width: 100%; float: left; margin-right: -100%; position: relative; display: none;" class="">
                <!-- Image -->
                <img src="<?php echo SharHTML::imgUrl("$pictureMain[picture_name]");?>" alt="" class="img-responsive">
              </li>
              
               <!-- Slide2 #2 Normal Slide -->
              <?php foreach ($pictureList as $value) { ?>
              <li style="width: 100%; float: left; margin-right: -100%; position: relative; display: none;" class="">
                <img src="<?php echo SharHTML::imgUrl("$value[picture_name]");?>" alt="" class="img-responsive">
              </li>
              <?php } ?>
            </ul>
          </div>
      </div>

    </div>

    <!-- Simple description starts -->
    <div class="col-md-6 col-sm-6">
        <!-- Name -->
        <h4 class="title"><?php echo "$product[name]";?></h4>
        <!-- On bid -->
        <p><b>On Bid : </b><?php if($product[on_bid]==1)echo "Yes";else echo "No";?></p>
        <!-- Price -->
        <p><b>Price : £ </b><?php echo $price[price];?></p>
        <!-- If on bid is yes, then here shows current highest price and due date -->
        <p><?php 
        if($product[on_bid] == 1) { 
          echo "Highest Price: £ $price[highest]";
          echo "<br>";
          echo "Due Date : $product[due_date]";
        }
        ?></p>
        <p><b>Condition : </b><?php echo "$condition[$conditionID]"; ?></p>
        <p><b>Publish Date : </b><?php echo "$product[upload_time]"; ?></p>
        <p><b>Availability : </b>
        <?php
        if($product[status] == 0)
          echo "On Sell";
        elseif ($product[status] == 1) 
          echo "Sold out";
        ?></p>
        <p><b>View Number : </b><?php echo "$product[view_number]"; ?></p> 
				
        <br>

				<div class="row">
					<div class="col-md-6">
						<div class="input-group">
						  <span>
              <?php if ($user['status']== SharQuery::$STATUSCODE['user_status']['ACTIVATED']){?>
              <?php if($checkUser[isSeller]=='false'&&$checkUser[isLogin]=='true') { ?>
              <!-- buy button -->
                  <?php if($product[status]==SharQuery::$STATUSCODE['product_status']['ONSELL']) { 
                          if($product[on_bid] == SharQuery::$STATUSCODE['product_onbid']['ORIGINALSELL']) {?>
                  <a class="btn btn-danger" href="<?php echo  SharIt::app()->createUrl('order/checkout.php',array('pid'=>$product[id]))?>" role="button">Buy Now !</a>
                  <?php } ?>
                  <?php if($product[on_bid] == SharQuery::$STATUSCODE['product_onbid']['ONBID']) { ?>
                  <a class="btn btn-danger" href="#bid" role="button" value="<?php $productInfo ?>" data-toggle="modal">Bid Now !</a>
                  <?php } ?>
                <?php }} ?>
                <?php }elseif($user['status']== SharQuery::$STATUSCODE['user_status']['FROZEN']){ ?>
                <h2 class="title"><span class="color">Warning! </span> </h2>
                <h5>This seller is frozen!</h5>
                <?php } ?>
                </button>
              </span>							  
						</div>
					</div>
				</div>
    </div>
    <!-- Simple description ends -->

  </div>
</div>
<!-- Product details ends -->

<br>

<!-- Description, specs and review -->

<ul class="nav nav-tabs">
  <!-- Use uniqe name for "href" in below anchor tags -->
  <li class="active"><a href="#tab1" data-toggle="tab">Description</a></li>
  <li class=""><a href="#tab2" data-toggle="tab">Price History</a></li>
  <li class=""><a href="#tab3" data-toggle="tab">Seller Info</a></li>
  <li class=""><a href="#tab4" data-toggle="tab">Q&ampA</a></li>

</ul>

<!-- Tab Content Starts -->
<div class="tab-content">
  <!-- Description starts-->
  <div class="tab-pane active" id="tab1">
    <p><?php echo "$product[description]";?></p>
    <br>
    <hr>
    <ul>
        
        <!-- Pic #1 Main  -->
      <!-- <li style="width: 100%; float: left; margin-right: -100%; position: relative; " class=""> -->
      <li style="list-style:none;">
        <img src="<?php echo SharHTML::imgUrl("$pictureMain[picture_name]");?>" alt="" class="img-responsive">
      </li>
      
        <!-- Pic #2 Normal -->
      <?php foreach ($pictureList as $key => $value) { ?>

      <li style="list-style:none;">
        <img src="<?php echo SharHTML::imgUrl("$value[picture_name]");?>" alt="" class="img-responsive">
      </li>
      <?php } ?>
      
    </ul>
  </div>
  <!-- Description ends-->

  <!-- Price History Starts -->
  <div class="tab-pane" id="tab2">
    <?php if (count($priceHistory) == 1): ?>
    <p>The price has not changed for now.</p>
    <?php else: ?>
    <canvas id="canvas" height="400" width="600"></canvas>
    <script>
    var lineChartData = {
      labels : [<?php foreach ($priceHistory as $value) { echo "\"$value[ts]\","; }?>],
      datasets : [
        {
          fillColor : "rgba(220,220,220,0.5)",
          strokeColor : "rgba(220,220,220,1)",
          pointColor : "rgba(220,220,220,1)",
          pointStrokeColor : "#fff",
          data : [<?php foreach ($priceHistory as $value) { echo "$value[price],"; }?>]
        }
  
      ]
      
    }
    var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData); 
    </script>
    <?php endif; ?>
  </div>
  <!-- Price History Ends -->


  <!-- Seller Info Start -->
  <div class="tab-pane" id="tab3">
    <h5>Seller Info</h5>
    <div class="item-review">
      <h5>Name: </h5>
      <p><?php echo "$user[display_name]";?></p>
      <br>
      <h5>Average Rating: <?php echo $seller_rating;?></h5>
      <p>Item as described: <?php echo "$user[review_describe]";?>/5</p>
      <p>Communication: <?php echo "$user[review_com]";?>/5</p>
      <p>Shipping Speed: <?php echo "$user[review_ship]";?>/5</p>
      <br>
      <h5>Email</h5>
      <p><a href="mailto:<?php echo $user[email];?>?Subject=Query%20on%20product%20$product[id]"><?php echo "$user[email]";?></a></p>
      <br>
      <h5>Register Date</h5>
      <p class="rmeta"><?php echo "$user[register_date]";?></p>
    </div>
  </div>
  <!-- Seller Info End -->

  <!-- Q&A Start -->
  <div class="tab-pane" id="tab4">
    <div class="comments well">
       <!-- Comment title -->
          <div class="title"><h4>Q &amp A</h4></div>
          <?php foreach ($q_a as $key => $value) { 
                    $qid=$value[id];
          ?>
          <ul class="comment-list">
            <li class="comment">
              <!-- Author -->
                <div class="comment-author">
                <h5><b><a href='<?php echo SharIT::app()-> createUrl('order/profile.php',array('uid'=>$value[user_id])) ?>'>
                <?php 
                  echo $value[display_name];
                ?>
                </a></b></h5>
                </div>
                <!-- Comment date -->
                <div class="cmeta">Commented on <?php echo "$value[question_time]";?></div>
                <!-- Para -->
                <h5><?php echo "$value[question]";?></h5>
                <!-- button to reply -->
                <?php 
                  if($checkUser[isSeller]=='true' && !$value[answer]) {
                ?>
                <a class="btn btn-danger" href="#reply" role="button" onclick="setTargetQid(<?php echo $qid; ?>)" data-toggle="modal">Reply</a>
                <?php }?>
                <div class="clearfix"></div>
            </li>
            <!-- Reply to previous comment (by adding class "reply") -->
            <?php if($value[answer]){?>
            <li class="comment reply">
                <div class="comment-author"><a href="#">
               <h5> <b><a href='<?php echo SharIT::app()-> createUrl('order/profile.php',array('uid'=>$user[id])) ?>'><?php
                echo "$user[display_name]"; 
                ?></a></b></h5>
                </a></div>
                <!-- reply date -->
                <div class="cmeta">Commented on <?php echo "$value[answer_time]";?></div>
                <!-- Para -->
                <h5><?php echo "$value[answer]";?></h5>
                <div class="clearfix"></div>
            </li>
            <?php }?>  
          </ul>
          <?php } ?>
    </div>

    <hr>
<?php if($checkUser[isLogin]=='true') { ?>
  <?php if($checkUser[isSeller]=='false') { ?>
    <div id="questionForm" class="respond well">
        <!-- Form title -->
         <div class="title"><h4>Ask a Question</h4></div>
         <!-- Comment form starts -->
         <div class="form">
           <form class="form-horizontal" method="post">
            <input type="hidden" name="questionForm[pid]" value="<?php echo $product[id]?>" >
               <div class="form-group">
                 <label class="control-label col-md-3" for="question">Content</label>
                 <div class="col-md-6">
                   <textarea class="form-control" name="questionForm[content]" rows="3"></textarea>
                 </div>
               </div>
               <div class="form-group">
                  <div class="col-md-6 col-md-offset-3">
                      <button type="submit" name="questionForm[submit]" class="btn btn-default">Submit</button>
                      <button type="reset" class="btn btn-default">Reset</button>
                  </div>
               </div>
             </form>
           </div>
           <!-- Commment form ends -->
      </div>
      <?php } ?>
<?php } ?>
  <!-- Q&A End -->
</div>
</div>
<!-- Tab Content Ends -->


<?php endif; ?>