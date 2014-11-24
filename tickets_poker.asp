<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<%
Dim objConn, strSQL

Set objConn = server.createObject("ADODB.Connection")	

objConnStr = Session("SQLConnectionStringFair")
objConn.open objConnStr
%>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="global.css" rel="stylesheet" type="text/css" />
<link href="css/smoothDivScroll.css" rel="stylesheet" type="text/css" />
    <title>Douglas County Fairgrounds Complex &amp; Speedway </title>
	<link rel="stylesheet" href="css/foundation.css" >
	<link rel="stylesheet" href="css/normalize.css" >
	<link rel="stylesheet" href="css/style.css" >


<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/s3Slider.js" type="text/javascript"></script> 
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>

    
</head>

  <body>
	 
	<!-- HEADER SECTION -->
	  <div class="top-section">
	    	<div class="header">
				 <h1 class="logo">
			        <a href="index.html"><img src="img/logo.png"></a>
			     </h1>
			     <div class="right">
			     	<a href="fair/index.html"><div class=" sign-top"></div></a>
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
	        	<a>Events</a>
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
	        	<a>Facilities</a>
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
	        	<a>About</a>
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



        <div><br />

  <div align="center"><strong>Fairgrounds<br />
 Poker Craze</strong>
  </div>
  <p align="center"></p>
  <div align="center">February 21, 2015</a><br /><br />

<span class="style1">Early Bird Registration Bonus<br />
        Ends February 16th @ 5pm</span>  </div>
  <p align="center"></p>
  <div align="center"><strong>Times</strong><br />
Registration:  4:00 p.m.<br />
Tournament Play:  6:00 p.m.<br />
Buffet Dinner Break:  5:00 p.m.</div></a>
</DIV>
</div> <!--Right Div Close-->


		  <table border="3" align="center" cellpadding="3" cellspacing="0">
			<tr>
			  <th colspan="3" scope="col"><p><br />
		      <img src="POKER CRAZE REGISTRATION" alt="POKER CRAZE REGISTRATION" width="225" height="58" /></p></th>
</tr>
			<tr>
			  <td colspan="3" class="eventhead" align="right"><a href="viewcart_poker.asp">View Shopping Cart</a></td>
		    </tr>
			<tr>
			  <td width="271" class="redHeadings">Ticket Description </td>
			  <td width="95" class="redHeadings">Price</td>
			  <td width="208" class="redHeadings">&nbsp;</td>
			</tr>


	<%
	Set objRs = objConn.Execute("SELECT ProductID, ProductName, Price, ProductDesc, ReservedOut FROM Product p "&_
					"Join Category c On p.CategoryID = c.CategoryID "&_
					"WHERE CategoryName = 'Poker' AND CategoryType = 'Ticket' "&_
					"AND ExpireDate > GetDate() AND StartDate < GetDate() ORDER BY ProductOrder, ExpireDate, ProductName")
	
	If objRs.EOF Then								
	%>						  
			<tr>
			  <td colspan="2" align="center" class="imageFloat"><br>
			    <span class="style13">You can call <br>
			    </span>
			    <p>541-440-4359 to Register by phone<br />
			      Intial Buy-In $100 = 5,000 chips<br />
			      <span class="style2">Early Bird Deadline Aug. 13th at 5p.m.</span><br />
			      Early Bird Bonus = 1,000 chips<br />
			      One time Add-on $100 =10,000 chips<br />
			    Smoked Tri-Tip Dinner . . . $10<br /></p>
			    </td>
			  <td>&nbsp;</td>
		    </tr>
	<%
	Else
	Do until objRs.EOF
	If objRs("ReservedOut") <>  0  Then
	%>	
			<tr>
			  <td align="left" class="content"><%=objRs("ProductName")%></td>
			  <td colspan="2" class="content">&nbsp;</td>
			</tr>
	<%
	Else
	%>	
			<tr>
			  <td align="left" class="content"><%=objRs("ProductName")%></td>
			  <td class="content"><%=FormatCurrency(objRs("Price"))%></td>
			  <td class="content"><a href="addtocart_poker.asp?pid=<%=objRs("ProductID")%>&url=tickets_poker.asp"><img src="img/addtocart.gif" alt="Add <%=objRs("ProductName")%> to Cart" width="116" height="21" border="0"></a></td>
			</tr>
	<%
	End If
	If objRs("ProductDesc") <> "" Then
	%>
			<tr class="ticketcaption">
			  <td colspan="3" align="left" class="ticketcaption"><%=objRs("ProductDesc")%></td>
		    </tr>
	<%			
	End If
	objRs.MoveNext
	Loop
	End If
	%>						  							  
		</table>	
          <br>
              <div align="center" class="redHeadings"></div>



   <div class="sponsors">
  	<div >
  		<h4>Sponsored By</h4>
  		<div class="row">
  			<div class="large-12 medium-12 columns">
	  			<ul class="large-block-grid-5 medium-block-grid-5 small-block-grid-1 effects">
	  				<li><a href="http://www.bigfootbeverages.com" target="_blank"><img src="img/sponsor-bigfoot.png"></a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>

	  			</ul>
  			</div>
  			<div class="large-12 medium-12 columns">
	  			<ul class="large-block-grid-5 medium-block-grid-5 small-block-grid-1 effects">
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  			</ul>
  			</div>
  			<div class="large-12 medium-12 columns">
	  			<ul class="large-block-grid-5 medium-block-grid-5 small-block-grid-1 effects">
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  			</ul>
  			</div>
  			<div class="large-12 medium-12 columns">
	  			<ul class="large-block-grid-5 medium-block-grid-5 small-block-grid-1 effects">
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  				<li><a href="#" target="_blank">#</a></li>
	  			</ul>
  			</div>

		
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

</div> <!--wrapper close-->
</body>
</html>