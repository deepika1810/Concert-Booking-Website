<!DOCTYPE html>
<html>
<head>
<title>Concertio</title>
<link rel="stylesheet" type="text/css" href="layout.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript">

function selectStep(n)
{
	if(n==1){
		$(".progress-selected").animate({marginLeft: '0px'},100);
	}else if(n==2){
		$(".progress-selected").animate({marginLeft: '36px'},100);
	}else if(n==3){
		$(".progress-selected").animate({marginLeft: '63px'},100);
	}
	$(".content-switcher").hide();
	$("#content"+n).show();
}
</script>
</head>
<?php include_once("connectdb.php");
?>
<?php session_start(); ?>

<body>
<!- container begins>
<div id="container">
    <!- navigation bar begins>
	<div id="navbar">
	  <div id="logindet"> 
		<?php if(@$_SESSION['username']) {echo "Hi,".$_SESSION['username']."! |";
		echo "<a href='logout.php' style='color:white; text-decoration:none;'>Logout </a>";}?>
		</div>
		<nav>
		<a href="index.php"><img src="logo.png">ONCERTIO!</a>
		<ul>
			<?php if(@$_SESSION['username']){ echo "<li><a href='browsemember.php'>Concerts</a></li>";
		    echo "<li><a href='support.php'>Support</a></li>";
			}
         else{
			echo "<li><a href='loginpage.php'>Login</a></li>";
			echo "<li><a href='signuppage.php'>Register</a></li>";
		    echo "<li><a href='browse.php'>Concerts</a></li>";
			echo "<li><a href='support.php'>Support</a></li>";}
		?>

		</ul>
		</nav>
	</div><!- navigation bar ends>
	
	<div id="contentofmain"><!- contentofmain begins>
		<div style="position: relative; background: url(b3.jpg); width: 1344px; height : 300px; ">
		<div style="position: absolute; margin-left:450px; margin-botton:100px; margin-top:130px; font-weight: bold; color: #fff;">
		<form action="searchresult.php" method="post">
		<input type="text" name="keyword" placeholder="Search Concerts" class="searchfield"  />
		<input type="submit" name="search" value="Search" class="buttonfield" />
		</form>
		</div>
        </div>

    
<?php 
$imagesTotal=4; 
?>
<div class="galleryContainer">	
<div class="galleryPreviewContainer">
		<div class="galleryPreviewImage">
			<?php
				for ($i = 1; $i <= $imagesTotal; $i++) {
					echo '<img class="previewImage' . $i . '" src="image' . $i . '.jpg" width="900" height="auto" alt="" />';
				}
			?>
		</div>

		<div class="galleryPreviewArrows">
			<a href="#" class="previousSlideArrow">&lt;</a>
			<a href="#" class="nextSlideArrow">&gt;</a>
		</div>
	</div>

	<div class="galleryNavigationBullets">
		<?php
			for ($b = 1; $b <= $imagesTotal; $b++) {
				echo '<a href="javascript: changeimage(' . $b . ')" class="galleryBullet' . $b . '"><span>Bullet</span></a> ';
			}
		?>
	</div>
</div>
	
	
</div><!- contentofmain ends>
	
	</div>	<!- container ends>
	<div class="cont"><!- cont begins> 
	    <div class="main-content"><!- main-cont begins>
		<div class="content-switcher" id="content1">
		    <img src="g1.png" align="left" style="margin-left:50px">
			<img src="g2.png" align="right" style="margin-right:50px">
		</div>
		<div class="content-switcher" id="content2">
		    <img src="g3.png" align="left" style="margin-left:50px">
			<img src="g4.png" align="right" style="margin-right:50px">
		</div>
		<div class="content-switcher" id="content3">
		    <img src="g5.png" align="left" style="margin-left:50px">
			<img src="g6.png" align="right" style="margin-right:50px">
		</div>	
		</div><!- main-cont ends>
		<div class="progress-cont"><!- progress-cont begins>
			<a href="#" class="item-number" onclick="selectStep(1); return false;"></a>
		    <a href="#" class="item-number" onclick="selectStep(2); return false;"></a>
			<a href="#" class="item-number" onclick="selectStep(3); return false;"></a>
		 
		
			<div class="progress-selected">
			</div>
	    </div><!- progress-cont ends>
	</div><!- cont ends>
	
	<div id="footer">Copyright Concertio Inc.All rights reserved.</div>	

</body>
<script type="text/javascript">
// init variables
var imagesTotal = <?php echo $imagesTotal; ?>;
var currentImage = 1;
$('a.galleryBullet' + currentImage).addClass("active");
// PREVIOUS ARROW CODE
    $('a.previousSlideArrow').click(function() {
	$('img.previewImage' + currentImage).hide();
	$('a.galleryBullet' + currentImage).removeClass("active");
	

	currentImage--;

	if (currentImage == 0) {
		currentImage = imagesTotal;
	}

	$('a.galleryBullet' + currentImage).addClass("active");
	
	$('img.previewImage' + currentImage).show();

	return false;
});
// ===================


// NEXT ARROW CODE
$('a.nextSlideArrow').click(function() {
	$('img.previewImage' + currentImage).hide();
	$('a.galleryBullet' + currentImage).removeClass("active");
	

	currentImage++;

	if (currentImage == imagesTotal + 1) {
		currentImage = 1;
	}

	$('a.galleryBullet' + currentImage).addClass("active");
	
	$('img.previewImage' + currentImage).show();

	return false;
});
// ===================


// BULLETS CODE
function changeimage(imageNumber) {
	$('img.previewImage' + currentImage).hide();
	currentImage = imageNumber;
	$('img.previewImage' + imageNumber).show();
	$('.galleryNavigationBullets a').removeClass("active");
	
	$('a.galleryBullet' + imageNumber).addClass("active");
	
}
// ===================


// AUTOMATIC CHANGE SLIDES
function autoChangeSlides() {
	$('img.previewImage' + currentImage).hide();
	$('a.galleryBullet' + currentImage).removeClass("active");
	

	currentImage++;

	if (currentImage == imagesTotal + 1) {
		currentImage = 1;
	}

	$('a.galleryBullet' + currentImage).addClass("active");
	
	$('img.previewImage' + currentImage).show();
}

var slideTimer = setInterval(function() {autoChangeSlides(); }, 3000);

</script>



</html>
