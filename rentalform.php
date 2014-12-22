<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);


    if ($name == "" OR $phone == "" OR $message == "") {
        echo "You must specify a value for name, phone number, and message.";
        exit;
    }

    foreach( $_POST as $value ){
        if( stripos($value,'Content-Type:') !== FALSE ){
            echo "There was a problem with the information you entered.";    
            exit;
        }
    }

    if ($_POST["address"] != "") {
        echo "Your form submission has an error.";
        exit;
    }

    require_once("inc/class.phpmailer.php");
    $mail = new PHPMailer();

    if (!$mail->ValidateAddress($email)){
        echo "You must specify a valid email address.";
        exit;
    }

    $email_body = "";
    $email_body = $email_body . "NAME: " . $name . "<br>";
    $email_body = $email_body . "PHONE: " . $phone . "<br>";
    $email_body = $email_body . "EMAIL: " . $email . "<br>";
    $email_body = $email_body . "MESSAGE: " . $message;

    $mail->SetFrom($email, $name);
    $address = "courthendricks@gmail.com";
    $mail->AddAddress($address, "Douglas County Fairgrounds");
    $mail->Subject    = "Fairgrounds Rental Request Form | " . $name;
    $mail->MsgHTML($email_body);

    if(!$mail->Send()) {
      echo "There was a problem sending the email: " . $mail->ErrorInfo;
      exit;
    }

    header("Location: rentalform.php?status=thanks");
    exit;
}
?>


<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Douglas County Complex &amp; Speedway </title>
    <link rel="icon" type="image/png" href="favicon.ico" />
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
	<link rel="stylesheet" href="_/sass/foundation.css" >
	<link rel="stylesheet" href="css/style.css" >

    <script src="js/vendor/modernizr.js"></script>


  </head>
  
  
  <body>
	 
	<!-- HEADER SECTION -->
	  <div class="top-section">
	    	<div class="header">
				 <h1 class="logo">
			        <a href="index.html"><img src="img/logo.png"></a>
			     </h1>
			     <div class="right">
			     	<a href="fair/welcome.html"><div class=" sign-top"></div></a>
				 	<a href="sponsors.html"><div class=" sign-bottom"></div></a>
			     </div>
	    	</div> <!-- END HEADER -->
	</div>
	<!-- END HEADER SECTION -->

	<!-- NAVIGATION -->
	<div class="contain-to-grid">
	 <nav class="top-bar" data-topbar>
		  <ul class="title-area">
		    <li class="name">
		      <h1></h1>
		    </li>
		    <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
		  </ul>
		  
	    <section class="top-bar-section">
	      <ul class="right">
	      	<li>
		      	<a href="index.html">Home</a>
	      	</li>
	        <li class="has-dropdown">
	        	<a href="">Events</a>
	        	<ul class="dropdown" >
		        	<li><a href="fair/index.html">DC Fair</a></li>
		        	<li><a href="christmas.html">Christmas Fair</a></li>
		        	<li><a href="sportsman.html">Sportsmen's Show</a></li>
		        	<li> <a href="poker.html">Poker Craze</a></li>
		        	<li> <a href="brew.html">Brew Ha Ha</a></li>
	        	</ul>
	        </li>
	        <li >
	        	<a href="calendar.html">Calendar</a>
	        	
	        </li>	        
	        <li class="has-dropdown">
	        	<a href="">Facilities</a>
	        	<ul class="dropdown" >
		        	<li><a href="buildings.html">Buildings</a></li>
		        	<li> <a href="arenas.html">Arenas</a></li>
		        	<li><a href="grandstands.html">Grandstands</a></li>
		        	<li><a href="rvpark.html">RV Park</a></li>
		        	<li class="divider"></li>
		        	<li><a href="rentalform.html">Rental Inquiry Form</a></li>
	        	</ul>
	        </li>
		    <li>
		    	<a href="catering.html">Catering</a>
		    </li>
	        <li class="has-dropdown">
	        	<a href="">About</a>
	        	<ul class="dropdown" >
		        	<li><a href="aboutus.html">Contacts</a></li>
		        	<li><a href="location.html">Find Us</a></li>
	        	</ul>
	        </li>
	      </ul>
	    </section> <!-- END top-bar-section -->
	 </nav>
	</div> <!-- END contain-to-grid -->
	<!-- END NAVIGATION -->
	    


<!---------- MAIN SECTION ---------->    
           

	<div class="row">
	
		  <div class="large-12 medium-12 columns main-copy"> 
			  <div class="single-column">
		  		<h1>Rental Request Form</h1>

            <?php if (isset($_GET["status"]) AND $_GET["status"] == "thanks") { ?>
        		<div data-alert class="alert-box success ">
					  Thank you for your submission!
					  <a href="#" class="close">&times;</a>
				</div>
				<p><a href="rentalform.php"><em>Back to the Rental Inquiry Form.</em></a></p>
            <?php } else { ?>

		        	<form data-abide method="post" action="rentalform.php">
						  <div class="row">
						    <div class="large-12 columns">
						    	<div class="name-field " >
								    <label for="name">Your Name <small>required</small>
								      <input type="text" name="name" id="name" placeholder="John Doe" required pattern="[a-zA-Z]+">
								    </label>
								    <small class="error">A name is required.</small>
						    	</div>
						    </div>
						  </div>
						  
						  <div class="row">
							    <div class="large-6 medium-6 columns">
							    	<div class="phone-field " >
									    <label for="phone">Phone Number <small>required</small>
									      <input type="tel" name="phone" id="phone" placeholder="888 888 8888" required pattern="integer">
									    </label>
									    <small class="error">A phone number is required.</small>
							    	</div>
							    </div>
							    
							    <div class="large-6 medium-6 columns">
							    	<div class="email-field " >
									    <label for="email">Email <small>required</small>
									      <input type="email" name="email" id="email" placeholder="john@doe.com" requried pattern="email">
									    </label>
									    <small class="error">An email is required.</small>
							    	</div>
							    </div>
						  </div> <!-- END ROW -->
						  <div>
							  <label for="message">Message</label>
							  <textarea  name="message" id="message" placeholder="Your message here." rows="3"></textarea>
						  </div>
						    	<div style="display: none;" >
								    <label for="address">Address
								      <input type="address" name="address" id="address">
								      <p><em>Not required. Please leave this field blank.</em></p>
								    </label>
						    	</div>
						  <br>
						  <button type="submit" name="submit" value="Submit" href="#" class="small button">Submit</button>
					</form>
            <?php } ?>

			  </div>
		</div>
		
	</div> <!-- END MAIN ROW -->

      
   <div class="sponsors">
  		<h4>Sponsored By</h4>
  		<div class="row">
  			<div class="large-12 medium-12 columns">
	  			<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-5 effects">
	  				<li><a href="http://coorslight.com" target= "_blank"><img src="img/sponsor-coors.png"></a></li>
	  				<li><a href="http://infostructure.net" target= "_blank"><img src="img/sponsor-info.png"></a></li>
	  				<li><a href="http://www.bigfootbeverages.com" target= "_blank"><img src="img/sponsor-bigfoot.png"></a></li>
	  				<li><a href="http://www.henryestate.com" target= "_blank"><img src="img/sponsor-henry.png"></a></li>
	  				<li><a href="http://www.umpquadairy.com" target= "_blank"><img src="img/sponsor-umpqua.png"></a></li>
	  			</ul>
  			</div>
  		
	  	</div>
  </div>
    


  	<div id="footer" class="contain-to-grid">
	 	<div class="row">
	 	
	       <div class="large-3 medium-3 columns">
	        	<p><h4>Contact Us</h4>541 957 7010 <br> 541 440 6023 (fax) <br> <a href="mailto:fairgrounds@co.douglas.or.us">fairgrounds@co.douglas.or.us</a></p>
	    	</div>
	        <div class="large-3 medium-3 columns">
	        	<p><h4>Visit Us</h4><strong>Take I-5 Exit 123</strong> <br><a href="location.html"><i class="fa fa-map-marker"></i>2110 SW Frear Street <br>Roseburg, Oregon 97471</a></p>
	        </div>
			<div class="large-3 medium-3 columns">
	        	<p><h4>Community Links</h4>
	        		<a href="http://www.visitroseburg.com/" target= "_blank">Visitor's Center</a><br>
	        		<a href="http://www.co.douglas.or.us/" target= "_blank">Douglas County Government</a><br>	        		
	        		<a href="http://www.oregonfairs.org/" target= "_blank">Oregon Fairs Association</a>
	        	</p>
	        </div> 
	        <div class="large-3 medium-3 columns">
	        	<p><h4>Connect With Us</h4>
		        	<a href="https://www.facebook.com/douglascountyfair"target="_blank"><i class="fa fa-facebook-square"></i>Facebook</a><br>
		        	<a href="https://www.youtube.com/user/DouglasFairgrounds/feed"target="_blank"><i class="fa fa-youtube-play"></i>YouTube</a><br>
		        	<a href="http://www.pinterest.com/dcfair1"target="_blank"><i class="fa fa-pinterest"></i>Pinterest</a>
	        	</p>
	        </div>        
		</div>
  	</div>
  	

  <div id="copyright">
  		<div class="row">
	       <div class="large-6 medium-12 small-12 columns" >
	    		<p>&copy; <script type="text/javascript">var year = new Date();document.write(year.getFullYear());</script> Douglas County Fairgrounds. All Rights Reserved.</p>
	    	</div>
	    	<div class="large-6 medium-12 small-12 columns" >
	    	</div>
	  	</div>
  </div>
  
	    <script src="js/vendor/jquery.js"></script>
	    <script src="js/jquery-1.9.1.min.js"></script> 
	    <script src="js/foundation.min.js"></script>
	    <script>
	      $(document).foundation();
	    </script>



	    <script src="http://localhost:35729/livereload.js"></script> 
      </body>
</html>
