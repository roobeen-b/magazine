<?php
	define('BREADCRUMBS', ['contact', 'category', 'blank', 'about']);
	define('CAT_COLOR', ['cat-1', 'cat-2', 'cat-3', 'cat-4']);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>WebMag | <?php echo (isset($header) && !empty($header))?"$header":""; ?></title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet"> 

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="assets/css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		
		<!-- Header -->
		<header id="header">
			<!-- Nav -->
			<div id="nav">
				<!-- Main Nav -->
				<div id="nav-fixed">
					<div class="container">
						<!-- logo -->
						<div class="nav-logo">
							<a href="index" class="logo"><img src="./assets/img/logo.png" alt=""></a>
						</div>
						<!-- /logo -->

						<!-- nav -->
						<ul class="nav-menu nav navbar-nav">
							<?php 
								$Category = new category();
								$categories = $Category->getAllCategory();
								if ($categories) {
									foreach ($categories as $key => $category) {
							?>
							<li class="<?php echo CAT_COLOR[$category->id%4] ?>"><a href="category?id=<?php echo $category->id; ?>"><?php echo $category->categoryname; ?></a></li>

										
								<?php
									}
								}
							 ?>
						</ul>
						<!-- /nav -->

						<!-- search & aside toggle -->
						<div class="nav-btns">
							<button class="aside-btn"><i class="fa fa-bars"></i></button>
							<button class="search-btn"><i class="fa fa-search"></i></button>
							<form class="search-form" action="../search" method="get">
								<input class="search-input" type="text" name="search" placeholder="Enter Your Search ...">
								<button class="search-close"><i class="fa fa-times"></i></button>
							</form>
						</div>
						<!-- /search & aside toggle -->
					</div>
				</div>
				<!-- /Main Nav -->

				<!-- Aside Nav -->
				<div id="nav-aside">
					<!-- nav -->
					<div class="section-row">
						<ul class="nav-aside-menu">
							<li><a href="index">Home</a></li>
							<li><a href="about">About Us</a></li>
							<!-- <li><a href="#">Join Us</a></li>
							<li><a href="#">Advertisement</a></li> -->
							<li><a href="contact">Contacts</a></li>
						</ul>
					</div>
					<!-- /nav -->

					<!-- widget posts -->
					<div class="section-row">
						<h3>Recent Posts</h3>

						<?php
								$Blog = new blog();
								$popularBlog = $Blog->getAllRecentBlogWithLimit(0, 3);
								if ($popularBlog) {
									foreach ($popularBlog as $key => $blog) {
									if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'/blog/'.$blog->image)){
										$thumbnail = UPLOAD_URL.'/blog/'.$blog->image;
									}else{

										$thumbnail = UPLOAD_URL.'noimg.jpg';
									} 

							?>
						<div class="post post-widget">
							<a class="post-img" href="blog-post?id=<?php echo $blog->id; ?>"><img src="<?php echo ($thumbnail); ?>" alt=""></a>
							<div class="post-body">
								<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h3>
							</div>
						</div>
						<?php
									}
								}
							?>
						
					</div>
					<!-- /widget posts -->

					<!-- social links -->
					<div class="section-row">
						<h3>Follow us</h3>
						<?php 
							$Follow = new follow();
							$follows = $Follow->getAllFollowIcons();
							if ($follows) {
								foreach ($follows as $key => $follow) {
						?>
						<ul class="nav-aside-social">
							<li><a target="_blank" href="<?php echo $follow->url ?>"><i class="fa fa-<?php echo strtolower($follow->iconname) ?>"></i></a></li>
						

						<?php
								}
							}
						 ?>
							</ul>
						
					</div>
					<!-- /social links -->

					<!-- aside nav close -->
					<button class="nav-aside-close"><i class="fa fa-times"></i></button>
					<!-- /aside nav close -->
				</div>
				<!-- Aside Nav -->
			</div>
			<!-- /Nav -->

			<?php
				if (in_array(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME), BREADCRUMBS)) {
					
				
			?>
			<!-- Page Header -->
			<div class="page-header">
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<ul class="page-header-breadcrumb">
								<li><a href="index">Home</a></li>
								<li><?php echo (isset($bread) && !empty($bread))?"$bread":""; ?></li>
							</ul>
							<h1><?php echo (isset($bread) && !empty($bread))?"$bread":""; ?></h1>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Header -->
			<?php 
				}else if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == 'blog-post') {
			?>
					<?php if(isset($blog_info->image) && !empty($blog_info->image) && file_exists(UPLOAD_PATH.'/blog/'.$blog_info->image)){
								$thumbnail = UPLOAD_URL.'/blog/'.$blog_info->image;
							}else{

								$thumbnail = UPLOAD_URL.'noimg.jpg';
								} 
					?>			

					<!-- Page Header -->
			<div id="post-header" class="page-header">
				<div class="background-img" style="background-image: url('<?php echo ($thumbnail) ?>');"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<div class="post-meta">
								<a class="post-category <?php echo CAT_COLOR[$blog_info->categoryid%4] ?>" href="category?id=<?php echo $blog_info->categoryid; ?>"><?php echo $blog_info->category; ?></a>
								<span class="post-date"><?php echo date("M d, Y", strtotime($blog_info->created_date)) ?></span>
							</div>
							<h1><?php echo $blog_info->title; ?></h1>
						</div>
					</div>
				</div>
			</div>

			<?php	
			}

			 ?>			

		</header>
		<!-- /Header -->

<!-- 		<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("../search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script> -->

