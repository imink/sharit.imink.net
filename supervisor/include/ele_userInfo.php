<?php
if($user[status] == SharQuery::$STATUSCODE['user_status']['UNACTIVATED']){
    $user[conditon] = "UNACTIVATED";
    $user[aciton] = "Activate";
}elseif($user[status] == SharQuery::$STATUSCODE['user_status']['ACTIVATED']){
    $user[conditon] = "ACTIVATE";
    $user[action] = "Frozen";
}elseif($user[status] == SharQuery::$STATUSCODE['user_status']['FROZEN']){
    $user[conditon] = "FROZEN";
    $user[action] = "Activate";
}
//echo $user[id];
//echo $user[status];
?>
<?php
if ($userErrors){
  SharHTML::alert('danger',$userErrors);
}

?>
<div class="widget">
    <h5>Search a user account</h5>
    <form class="form-inline" method="get" role="form" >
        <div class="form-group">
            <input type="email" class="form-control" name="userForm[email]" placeholder="Search" value="<?php echo $userForm[email]?>">
        </div>
        <button type="submit" name="userForm[search]" class="btn btn-danger" >Search</button>
    </form>
</div>


	<h5 class="title">User Account Information</h5>
        <table class="table table-striped tcart">
            <thead>
              <tr>
                <form class="form-inline" method="post" role="form">
                <th>ID</th>
                <th>Display Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
                </form>
              </tr>
            </thead>
            <tbody>
    
                <!-- TODO - Here should be specified by category id and each item's id -->
                <tr>
                 <?php if($userForm[email]||$userForm[submit1]||$userForm[submit2]||$userForm[submit3]||$userForm[submits]) { ?>
                 <form class="form-inline" method="get" role="form">
                 <input type="hidden" name="userForm[status_id]" value="<?php echo $user[status]?>" >
                 <input type="hidden" name="userForm[id]" value="<?php echo $user[id]?>" >
                 <input type="hidden" name="userForm[email]" value="<?php echo $user[email]?>" >
                 <input type="hidden" name="userForm[display_name]" value="<?php echo $user[display_name]?>" >
                 <td><?php echo $user[id] ?></td>
                 <td>
                     <?php echo $user[display_name]?>
                 </td>
                 <td><a href="mailto:__email__">
                     <?php echo $user[email] ?></a>
                 </td>
                 <td><?php 
                  if($user[status]==SharQuery::$STATUSCODE['user_status']['UNACTIVATED'])
                    echo 'UNACTIVATED';
                  elseif($user[status]==SharQuery::$STATUSCODE['user_status']['ACTIVATED'])
                    echo 'ACTIVATED';
                  elseif($user[status]==SharQuery::$STATUSCODE['user_status']['FROZEN'])
                    echo 'FROZEN'; ?>
                 </td>
                 <td>                
             
                    <?php 
                  if($user[status]==SharQuery::$STATUSCODE['user_status']['UNACTIVATED']){?>
                  <button class="btn btn-primary btn-sm" type="submit" name="userForm[submit1]" value="<?php echo $user[id]?>" >
                    Active</button>
          <?php      } 
                  elseif($user[status]==SharQuery::$STATUSCODE['user_status']['ACTIVATED']){ ?>
                   <button class="btn btn-primary btn-sm" type="submit" name="userForm[submit2]" value="<?php echo $user[id]?>" >
                   Froze</button>
           <?php       }
                  elseif($user[status]==SharQuery::$STATUSCODE['user_status']['FROZEN']){ ?>
                  <button class="btn btn-primary btn-sm" type="submit" name="userForm[submit3]" value="<?php echo $user[id]?>" >
                    Active</button>
                  
           <?php       }} ?>      
                 </td>
                 </form>
                </tr>
            </tbody>
        </table>
        <br>

<h5 class="title">Product List for the User</h5>
        <table class="table table-striped tcart">
            <!-- Header -->
            <thead>
              <tr>
                <form class="form-inline" method="get" role="form">
                <th>Product ID</th>
                <th>Name</th>
                <th>Upload Time</th>
                <th>Bid</th>
                <th>Status</th>
                <th>Action</th>
                </form>
              </tr>
            </thead>
            <!-- Body -->
            <tbody>
            <?php foreach ($product as $key => $value) { ?>
            <tr>
            <form class="form-inline" method="get" role="form">
            <input type="hidden" name="userForm[status_id]" value="<?php echo $user[status]?>" >
            <input type="hidden" name="userForm[id]" value="<?php echo $user[id]?>" >
            <input type="hidden" name="userForm[email]" value="<?php echo $user[email]?>" >
            <input type="hidden" name="userForm[display_name]" value="<?php echo $user[display_name]?>" >
            <?php if($value[status]==SharQuery::$STATUSCODE['product_status']['ONSELL'])
             echo "<input type=\"hidden\" name=\"userForm[action]\" value=\"0\" >";
             elseif($value[status]==SharQuery::$STATUSCODE['product_status']['SOLDOUT'])
             echo "<input type=\"hidden\" name=\"userForm[action]\" value=\"1\" >";
             elseif($value[status]==SharQuery::$STATUSCODE['product_status']['DELETE_SOLDOUT'])
             echo "<input type=\"hidden\" name=\"userForm[action]\" value=\"2\" >";
             elseif($value[status]==SharQuery::$STATUSCODE['product_status']['DELETE_ONSELL'])
             echo "<input type=\"hidden\" name=\"userForm[action]\" value=\"3\" >";?>
                <td><?php if($userForm[email]||$userForm[submits]){?>
               <a href="<?php echo SharIt::app()->createUrl('supervisor/productManage.php',array('pForm[id]'=>$value[id]))?>">
                <?php echo "$value[id]";?>
              
                </td>
                <td>
                    
                    
                    <?php  echo "$value[name]";?>
                    </a>
                </td>
                <td>
                    <?php echo "$value[upload_time]";?>
                </td>
                <td>
                    <?php
                    if($value[on_bid]==1)echo "Yes";else echo "No"; 
                    ?>
                </td>
                <td>
                    <?php
                    switch ($value[status]) {
                    case 0:
                      echo "ON SALE";
                      break;
                    case 1:
                      echo "SOLD OUT";
                      break;
                    case 2:
                      echo "DELETED SOLD OUT";
                      break;
                    case 3:
                      echo "DELETED ON SALE";
                      break;
                    }
                    ?>
                </td>
                <td>
                <?php if($value[status]==SharQuery::$STATUSCODE['product_status']['ONSELL']||$value[status]==SharQuery::$STATUSCODE['product_status']['SOLDOUT']){ ?>
                <button class="btn btn-primary btn-sm" type="submit" name="userForm[submits]" value="<?php echo $value[id]?>" >Delete</button>
            <?php  }
              if($value[status]==SharQuery::$STATUSCODE['product_status']['DELETE_SOLDOUT']||$value[status]==SharQuery::$STATUSCODE['product_status']['DELETE_ONSELL']){ ?>
                 <button class="btn btn-primary btn-sm" type="submit" name="userForm[submits]" value="<?php echo $value[id]?>" >Restore</button>
            <?php } ?>
                </td>
                </form>
            </tr>
            <?php }} ?>
            </tbody>

        </table>
<?php if($userForm[email]||$userForm[submit1]||$userForm[submit2]||$userForm[submit3]||$userForm[submits]){
$page_filter = $userForm;
$page_filter['page']='[:page]';
echo SharHTML::paging($userForm[page], $totalPageNum, SharIt::app()->createUrl('supervisor/userManage.php',$page_filter));}
?> 