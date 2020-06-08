<?php  
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$bread = 'Home';
	$header = 'Home';
	include 'inc/header.php';
?>


		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">	
						<?php 
								$Blog = new blog();
								$featuredBlog = $Blog->getAllFeaturedBlogWithLimit(0, 2);
								if (isset($featuredBlog[0]) && !empty($featuredBlog[0])) {
						?>
					<!-- post -->
					<div class="col-md-6">
						<div class="post post-thumb">
							<?php if(isset($featuredBlog[0]->image) && !empty($featuredBlog[0]->image) && file_exists(UPLOAD_PATH.'/blog/'.$featuredBlog[0]->image)){
										$thumbnail = UPLOAD_URL.'/blog/'.$featuredBlog[0]->image;
									}else{

										$thumbnail = UPLOAD_URL.'noimg.jpg';
									} 
									?>
							<a class="post-img" href="blog-post?id=<?php echo $featuredBlog[0]->id; ?>"><img src="<?php echo ($thumbnail); ?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo CAT_COLOR[$featuredBlog[0]->categoryid%4] ?>" href="#"><?php echo $featuredBlog[0]->category; ?></a>
									<span class="post-date"><?php echo date("M d, Y", strtotime($featuredBlog[0]->created_date)) ?></span>
								</div>
								<h3 class="post-title"><a href="blog-post?id=<?php echo $featuredBlog[0]->id; ?>"><?php echo $featuredBlog[0]->title; ?></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->
						<?php
								}
							 ?>
							 <?php

					if (isset($featuredBlog[1]) && !empty($featuredBlog[1])) {
						?>
					<!-- post -->
					<div class="col-md-6">
						<div class="post post-thumb">
							<?php if(isset($featuredBlog[1]->image) && !empty($featuredBlog[1]->image) && file_exists(UPLOAD_PATH.'/blog/'.$featuredBlog[1]->image)){
										$thumbnail = UPLOAD_URL.'/blog/'.$featuredBlog[1]->image;
									}else{

										$thumbnail = UPLOAD_URL.'noimg.jpg';
									} 
									?>
							<a class="post-img" href="blog-post?id=<?php echo $featuredBlog[1]->id; ?>"><img src="<?php echo ($thumbnail); ?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo CAT_COLOR[$featuredBlog[1]->categoryid%4] ?>" href="#"><?php echo $featuredBlog[1]->category; ?></a>
									<span class="post-date"><?php echo date("M d, Y", strtotime($featuredBlog[1]->created_date)) ?></span>
								</div>
								<h3 class="post-title"><a href="blog-post?id=<?php echo $featuredBlog[1]->id; ?>"><?php echo $featuredBlog[1]->title; ?></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->
						<?php
								}
							 ?>
				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h2>Recent Posts</h2>
						</div>
					</div>

						<?php 
								$recentBlog = $Blog->getAllRecentBlogWithLimit(0, 6);
								if ($recentBlog) {
									foreach ($recentBlog as $key => $blog) {
							?>

					<!-- post -->
					<div class="col-md-4">
						<div class="post">

							<?php if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'/blog/'.$blog->image)){
										$thumbnail = UPLOAD_URL.'/blog/'.$blog->image;
									}else{

										$thumbnail = UPLOAD_URL.'noimg.jpg';
									} 
									?>
							<a class="post-img" href="blog-post?id=<?php echo $blog->id; ?>"><img src="<?php echo ($thumbnail); ?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo CAT_COLOR[$blog->categoryid%4] ?>" href="#"><?php echo $blog->category; ?></a>
									<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date)) ?></span>
								</div>
								<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->

		

					<?php
									}
								}
							 ?>
				</div>

				<!-- /row -->

				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">

							<?php 
								
								$recentBlog = $Blog->getAllRecentBlogWithLimit(6, 1);
								if (isset($recentBlog[0]) && !empty($recentBlog[0])) {
						?>
							<!-- post -->
							<div class="col-md-12">
								<div class="post post-thumb">
									<?php if(isset($recentBlog[0]->image) && !empty($recentBlog[0]->image) && file_exists(UPLOAD_PATH.'/blog/'.$recentBlog[0]->image)){
										$thumbnail = UPLOAD_URL.'/blog/'.$recentBlog[0]->image;
									}else{

										$thumbnail = UPLOAD_URL.'noimg.jpg';
									} 
									?>
									<a class="post-img" href="blog-post?id=<?php echo $recentBlog[0]->id; ?>"><img src="<?php echo $thumbnail ?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?php echo CAT_COLOR[$recentBlog[0]->categoryid%4] ?>" href="#"><?php echo $recentBlog[0]->category; ?></a>
											<span class="post-date"><?php echo date("M d, Y", strtotime($recentBlog[0]->created_date)) ?></span>
										</div>
										<h3 class="post-title"><a href="blog-post?id=<?php echo $recentBlog[0]->id; ?>"><?php echo $recentBlog[0]->title; ?></a></h3>
									</div>
								</div>
							</div>
							<?php
								}
							 ?>
							<!-- /post -->

							<!-- post -->
							<?php 
								$recentBlog = $Blog->getAllRecentBlogWithLimit(7, 6);
								if ($recentBlog) {
									foreach ($recentBlog as $key => $blog) {
							?>

					<!-- post -->
					<div class="col-md-6">
						<div class="post">

							<?php if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'/blog/'.$blog->image)){
										$thumbnail = UPLOAD_URL.'/blog/'.$blog->image;
									}else{

										$thumbnail = UPLOAD_URL.'noimg.jpg';
									} 
									?>
							<a class="post-img" href="blog-post?id=<?php echo $blog->id; ?>"><img src="<?php echo ($thumbnail); ?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo CAT_COLOR[$blog->categoryid%4] ?>" href="#"><?php echo $blog->category; ?></a>
									<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date)) ?></span>
								</div>
								<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->

		

					<?php
									}
								}
							 ?>
							<!-- /post -->

							
							<!-- /post -->
						</div>
					</div>

					<div class="col-md-4">
						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>

							<?php
								$popularBlog = $Blog->getAllPopularBlogWithLimit(0, 4);
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
						<!-- /post widget -->

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Featured Posts</h2>
							</div>

							<?php 
								$featuredBlog = $Blog->getAllFeaturedBlogWithLimit(0, 2);
								if ($featuredBlog) {
									foreach ($featuredBlog as $key => $blog) {
							?>
							<div class="post post-thumb">
								<?php if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'/blog/'.$blog->image)){
										$thumbnail = UPLOAD_URL.'/blog/'.$blog->image;
									}else{

										$thumbnail = UPLOAD_URL.'noimg.jpg';
									} 
									?>
								<a class="post-img" href="blog-post?id=<?php echo $blog->id; ?>"><img src="<?php echo $thumbnail ?>" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category <?php echo CAT_COLOR[$blog->categoryid%4] ?>" href="#"><?php echo $blog->category; ?></a>
										<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date)) ?></span>
									</div>
									<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h3>
								</div>
							</div>

							<?php
									}
								}
							?>
						</div>
						<!-- /post widget -->
						
						<!-- ad -->
						<?php 
							$Ad = new ad();
							$simpleAd = $Ad->getSimpleAd();
							if ($simpleAd) {
								
							
						 ?>
						<!-- ad -->
						<?php
								 if(isset($simpleAd[0]->image) && !empty($simpleAd[0]->image) && file_exists(UPLOAD_PATH.'/ad/'.$simpleAd[0]->image)){
										$thumbnail = UPLOAD_URL.'/ad/'.$simpleAd[0]->image;
									}else{

										$thumbnail = UPLOAD_URL.'noimg.jpg';
									} 
									
						?>
						<div class="aside-widget text-center">
							<a href="<?php echo $simpleAd[0]->url ?>" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="<?php echo $thumbnail; ?>" alt="">
							</a>

						<?php  
							}
						 ?>
						<!-- /ad -->
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
		
		<!-- section -->
		<div class="section section-grey">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-center">
							<h2>Featured Posts</h2>
						</div>
					</div>
					<?php 
								$featuredBlog = $Blog->getAllFeaturedBlogWithLimit(2, 3);
								if ($featuredBlog) {
									foreach ($featuredBlog as $key => $blog) {
							?>

					<!-- post -->
					<div class="col-md-4">
						<div class="post">
							<?php if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'/blog/'.$blog->image)){
										$thumbnail = UPLOAD_URL.'/blog/'.$blog->image;
									}else{

										$thumbnail = UPLOAD_URL.'noimg.jpg';
									} 
									?>
							<a class="post-img" href="blog-post?id=<?php echo $blog->id; ?>"><img src="<?php echo $thumbnail ?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo CAT_COLOR[$blog->categoryid%4] ?>" href="#"><?php echo $blog->category; ?></a>
										<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date)) ?></span>
								</div>
								<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->

					<?php
									}
								}
							?>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-12">
								<div class="section-title">
									<h2>Most Read</h2>
								</div>
							</div>

							<?php
								$popularBlog = $Blog->getAllPopularBlogWithLimit(0, 4);
								if ($popularBlog) {
									foreach ($popularBlog as $key => $blog) {
									if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'/blog/'.$blog->image)){
										$thumbnail = UPLOAD_URL.'/blog/'.$blog->image;
									}else{

										$thumbnail = UPLOAD_URL.'noimg.jpg';
									} 

							?>
							<!-- post -->
							<div class="col-md-12">
								<div class="post post-row">
									<a class="post-img" href="blog-post?id=<?php echo $blog->id; ?>"><img src="<?php echo $thumbnail ?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?php echo CAT_COLOR[$blog->categoryid%4] ?>" href="#"><?php echo $blog->category; ?></a>
										<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date)) ?></span>
										</div>
										<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h3>
										<p><?php echo substr(html_entity_decode($blog->content), 0, 100).'...'; ?><a href="blog-post?id=<?php echo $blog->id; ?>"><br>Read more</a></p>
									</div>
								</div>
							</div>
							<!-- /post -->

							<?php
									}
								}
							?>
							
							<div class="col-md-12">
								<div class="section-row">
									<button class="primary-button center-block">Load More</button>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<!-- ad -->
						<?php 
							$Ad = new ad();
							$simpleAd = $Ad->getSimpleAd();
							if ($simpleAd) {
								
							
						 ?>
						<!-- ad -->
						<?php
								 if(isset($simpleAd[1]->image) && !empty($simpleAd[1]->image) && file_exists(UPLOAD_PATH.'/ad/'.$simpleAd[1]->image)){
										$thumbnail = UPLOAD_URL.'/ad/'.$simpleAd[1]->image;
									}else{

										$thumbnail = UPLOAD_URL.'noimg.jpg';
									} 
									
						?>
						<div class="aside-widget text-center">
							<a href="<?php echo $simpleAd[1]->url ?>" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="<?php echo $thumbnail; ?>" alt="">
							</a>

						<?php  
							}
						 ?>
						</div>
						<!-- /ad -->
						
						<!-- catagories -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Categories</h2>
							</div>
							<div class="category-widget">
								<ul>
									<?php 

										if ($categories) {
											foreach ($categories as $key => $category) {
									?>
									<li><a href="#" class="<?php echo CAT_COLOR[$category->id%4] ?>"><?php echo $category->categoryname ?><span>
									<?php 
										$Count = $Blog->getNumberOfBlogByCategory($category->id);
										echo $Count[0]->total;
									 ?>
									</span></a></li>
									<?php	
											}
										}
									 ?>
								</ul>
							</div>
						</div>
						<!-- /catagories -->
						
						<!-- tags -->
						<div class="aside-widget">
							<div class="tags-widget">
								<ul>
							<?php 
								
								if ($categories) {
									foreach ($categories as $key => $category) {
							?>
									<li><a href="category?id=<?php echo $category->id ?>"><?php echo $category->categoryname ?></a></li>
									<?php
								}
							}
								?>
								</ul>
							</div>
						</div>
						<!-- /tags -->
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<?php include 'inc/footer.php'; ?>