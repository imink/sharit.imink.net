<?php 
SharIt::page()->registerScript('function setTargetQid(id){$("#targetQid").val(id);}','POS_END');
SharIt::page()->registerScriptFile('js/Chart.js',true,'POS_BEGIN');
SharIt::page()->registerScriptFile('js/Chart.js',true,'POS_BEGIN');
?>
<?php 
if ($pErrors){
  SharHTML::alert('danger',$pErrors);
}
?>
<div class="widget">
    <h5>Search a single product using product id</h5>
    <form class="form-inline" method="get" role="form">
        <div class="form-group">
            <input type="text" class="form-control" name="pForm[id]" placeholder="Search" value="<?php echo $pForm[id]?>">
        </div>
        <button type="submit" name="pForm[submit]" class="btn btn-default">Search</button>
    </form>
</div>
<?php if($check[check]=='true') {?>
<div class="widget">
    <h5 class="title">Product Details</h5>
      <table class="table table-striped tcart">
            <!-- Header -->
            <thead>
              <tr>
                <form class="form-inline" method="get" role="form">
                <th>Product ID</th>
                <th>Name</th>
                <th>Seller</th>
                <th>Upload Time</th>
                <th>Bid</th>
                <th>Status</th>
                <th>Action</th>
                </form>
              </tr>
            </thead>
            <!-- Body -->
            <tbody>
            
            <tr>
            <form class="form-inline" method="get" role="form">
            <?php if($product[status]==SharQuery::$STATUSCODE['product_status']['ONSELL'])
             echo "<input type=\"hidden\" name=\"pForm[action]\" value=\"0\" >";
             elseif($product[status]==SharQuery::$STATUSCODE['product_status']['SOLDOUT'])
             echo "<input type=\"hidden\" name=\"pForm[action]\" value=\"1\" >";
             elseif($product[status]==SharQuery::$STATUSCODE['product_status']['DELETE_SOLDOUT'])
             echo "<input type=\"hidden\" name=\"pForm[action]\" value=\"2\" >";
             elseif($product[status]==SharQuery::$STATUSCODE['product_status']['DELETE_ONSELL'])
             echo "<input type=\"hidden\" name=\"pForm[action]\" value=\"3\" >";?>
                <td><?php if($pForm[id]||$pForm[submits]){ 
                    echo "$product[id]";?></td>
                <td>
                    
                    <?php echo "$product[name]";?>
                    </a>
                </td>
                <td>
                  <a href="<?php echo SharIt::app()->createUrl('supervisor/userManage.php',array('userForm[email]'=>$user[email]))?>">  
                    <?php echo "$user[email]";?>
                    </a>
                </td>
                <td>
                    <?php echo "$product[upload_time]";?>
                </td>
                <td>
                    <?php
                    if($product[on_bid]==1)echo "Yes";else echo "No"; 
                    ?>
                </td>
                <td>
                    <?php 
                    switch ($product[status]) {
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
                <?php 
                if($product[status]==SharQuery::$STATUSCODE['product_status']['ONSELL']||$product[status]==SharQuery::$STATUSCODE['product_status']['SOLDOUT']){ ?>
                <button class="btn btn-primary btn-lg" type="submit" name="pForm[submits]" value="<?php echo $product[id]?>" >Delete</button>
            <?php  }
              if($product[status]==SharQuery::$STATUSCODE['product_status']['DELETE_SOLDOUT']||$product[status]==SharQuery::$STATUSCODE['product_status']['DELETE_ONSELL']){ ?>
                 <button class="btn btn-primary btn-lg" type="submit" name="pForm[submits]" value="<?php echo $product[id]?>" >Restore</button>
            <?php }} ?>
                </td>
                </form>
            </tr>
           
            </tbody>
        </table>   
    <hr>
    <h5 class="title">Price History</h5>
    <!-- TODO Price History Graph -->
    <div>
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
</div>
<?php }elseif($check[check]=='false'){ ?>
  <h3>NOT found this product!</h3>
<?php } ?>