<?php
//$formData
//$contactFormErrors

$subjec = array('1'=>'Query',
                '2'=>'Report',
                '3'=>'Suggestion');

if ($contactFormError){
  SharHTML::alert('danger',$contactFormError);
}
?>

<!-- Contact form -->
   <h4 class="title">Contact Form</h4>
   <div class="form">
     <!-- Contact form (not working)-->
     <form class="form-horizontal" method="post">
         <!-- topic -->
         <div class="form-group">
           <label class="control-label col-md-3">Contact Subject</label>
           <div class="col-md-6">                               
            	<select class="form-control" name="contact[subject]" required>
            	<option disabled selected> --- Please Select --- </option>
               		<option value="1">Query</option>
               		<option value="2">Report</option>
			            <option value="3">Suggestion</option>
                  <?php
                     foreach ($subject as $key => $value) {
                       $subjectSelected="";
                       if($key == $formData[subject]){
                         $subjectSelected = "selected";
                       }
                       echo "<option value=\"$key\" $subjectSelected>$value</option>";
                     }
                  ?>                       
            	</select>
           </div>
         </div> 
         
      <!-- Content -->
      <div class="form-group">
            <label class="control-label col-md-3" for="content">Content</label>
            <div class="col-md-6">
                <textarea class="form-control" id="content" rows="3" name="contact[content]" required><?php echo $contact[content];?></textarea>
            </div>
      </div>
      
      <?php if(!SharIt::auth()->isLogin()):?>
        <h6>You are currently not logged in.</h6>
        <p>You can choose to either <a href="<?php echo SharIt::app()->createUrl('login.php')?>">login</a> / <a href="<?php echo SharIt::app()->createUrl('register.php')?>">register</a> now, or enter your personal contact informaiton below.</p>
        <br>
        <div class="form-group"> 
          <label class="control-label col-md-3" for="email">Email Address</label>
          <div class="col-md-6">
            <input type="text" class="form-control" name="contact[email]" value= "<?php echo $formData[email]?>">
          </div>
        </div>

        <div class="form-group"> 
          <label class="control-label col-md-3" for="name">Your Name</label>
          <div class="col-md-6">
            <input type="text" class="form-control" name="contact[name]" value= "<?php echo $formData[name]?>">
          </div>
        </div>
      <?php endif?>


	   <!-- Buttons -->
		<div class="form-group">
        <!-- Buttons -->
			<div class="col-md-6 col-md-offset-3">
				<button type="submit" class="btn btn-danger">Submit</button>
				<button type="reset" class="btn btn-default">Reset</button>
			</div>
      </div>
    </form>
	</div>
	<hr>        
    <div class="center">
      <!-- Social media icons -->
      <strong>Get in touch:</strong>
      <div class="social">
           <a href="#"><i class="icon-facebook facebook"></i></a>
           <a href="#"><i class="icon-twitter twitter"></i></a>
           <a href="#"><i class="icon-linkedin linkedin"></i></a>
           <a href="#"><i class="icon-google-plus google-plus"></i></a>
           <a href="#"><i class="icon-pinterest pinterest"></i></a>
      </div>
    </div>


<!-- Google Map starts -->
  <h4 class="title">Google Map</h4>
  <!-- Google maps -->
  <div class="gmap">
     <!-- Google Maps. Replace the below iframe with your Google Maps embed code -->
     <!-- <iframe height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Google+India+Bangalore,+Bennigana+Halli,+Bangalore,+Karnataka&amp;aq=0&amp;oq=google+&amp;sll=9.930582,78.12303&amp;sspn=0.192085,0.308647&amp;ie=UTF8&amp;hq=Google&amp;hnear=Bennigana+Halli,+Bangalore,+Bengaluru+Urban,+Karnataka&amp;t=m&amp;ll=12.993518,77.660294&amp;spn=0.012545,0.036006&amp;z=15&amp;output=embed"></iframe> -->
     <iframe  height="200" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=University%20of%20Liverpool%2C%20Liverpool%2C%20United%20Kingdom&key=AIzaSyBU_EbwOCQ_cQ3f0A1_wWwMoXTRu9YtA44"></iframe> 
  </div>
<!-- Google Map ends -->
<hr>
<!-- Address section -->
<h4 class="title">Address</h4>
<div class="address">
    <address>
       <!-- Company name -->
       <strong>Responsive Web, Inc.</strong><br>
       <!-- Address -->
       795 Folsom Ave, Suite 600<br>
       San Francisco, CA 94107<br>
       <!-- Phone number -->
       <abbr title="Phone">P:</abbr> (123) 456-7890.
    </address>
     
    <address>
       <!-- Name -->
       <strong>Email</strong><br>
       <!-- Email -->
       <?php
        echo '<a href="mailto:'.SHARIT_MAIL_ADDRESS.'">'.SHARIT_MAIL_ADDRESS.'</a>';
       ?>
    </address> 
</div>

