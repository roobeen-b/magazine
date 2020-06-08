<?php  
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
		//$bread = "Contact";

	  
	    if (isset($_GET['id']) && !empty($_GET['id'])) {
	    	$blog_id = (int)$_GET['id'];
	    	if ($blog_id) {
	    		$Blog = new blog();
	     		 $blog_info = $Blog->getBlogfromId($blog_id);
	     		 if ($blog_info) {
	     		 	$blog_info = $blog_info[0];
	     		 	$data = array(
	     		 		'view' => $blog_info->view+1
	     		 	);
	     		 	$Blog->updateBlogById($data, $blog_id);
	     		 	//debugger($blog_info);
	     		 	$bread = $blog_info->category;
	     		 	$header = $blog_info->category;
	     		 }else{
	     		 	redirect('index');
	     		 }
	    	
	    }else{
	    	redirect('index');
	    }
	    }else{
	    	redirect('index');
	    }
	  

	include 'inc/header.php';
?>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Post content -->
					<div class="col-md-8">
						<div class="section-row sticky-container">
							<div class="main-post">
								<?php echo html_entity_decode($blog_info->content); ?>
							</div>
							<div class="post-shares sticky-shares">
								<?php 
									$Follow = new follow();
									$follows = $Follow->getAllFollowIcons();
									if ($follows) {
										foreach ($follows as $key => $follow) {
						?>
								<a target="_blank" class="share-<?php echo strtolower($follow->iconname) ?>" href="<?php echo $follow->url ?>"><i class="fa fa-<?php echo strtolower($follow->iconname) ?>"></i></a>

								<?php
								}
							}
						 ?>
							</div>
						</div>

						<!-- ad -->
						<?php 
							$Ad = new ad();
							$wideAd = $Ad->getWideAd();
							
							if (isset($wideAd) && !empty($wideAd)) {
								//debugger($wideAd);
							?>

							
						<div class="section-row text-center">
							<?php
								 if(isset($wideAd[0]->image) && !empty($wideAd[0]->image) && file_exists(UPLOAD_PATH.'/ad/'.$wideAd[0]->image)){
										$thumbnail = UPLOAD_URL.'/ad/'.$wideAd[0]->image;
									}else{

										$thumbnail = UPLOAD_URL.'noimg.jpg';
									} 
									
						?>
							<a target="_blank" href="<?php echo $wideAd[0]->url ?>" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="<?php echo $thumbnail; ?>" alt="">
							</a>
						</div>

					<?php
					 }
					  ?>

						<!-- ad -->
						
						<!-- author -->
						<!-- <div class="section-row">
							<div class="post-author">
								<div class="media">
									<div class="media-left">
										<img class="media-object" src="./assets/img/author.png" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h3>John Doe</h3>
										</div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
										<ul class="author-social">
											<li><a href="#"><i class="fa fa-facebook"></i></a></li>
											<li><a href="#"><i class="fa fa-twitter"></i></a></li>
											<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											<li><a href="#"><i class="fa fa-instagram"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div> -->
						<!-- /author -->

						<!-- comments -->
						<div class="section-row">
							<div class="section-title">
								<h2>
									<?php 
									$Comment = new comment();
									$count = $Comment->getNumberOfCommentByBlog($blog_id);
									echo $count[0]->total.' Comments';
								 ?>
								 	
								 </h2>
							</div>

							<div class="post-comments">
								<?php 
									$comments = $Comment->getAllAcceptedCommentByBlog($blog_id);
									if ($comments) {
										foreach ($comments as $key => $comment) {
								?>
								<div class="media">
									<div class="media-left">
										<img class="media-object" src="./assets/img/avatar.png" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h4><?php echo $comment->name ?></h4>
											<span class="time"><?php echo date('M d, Y h:i:s a', strtotime($comment->created_date)) ?></span>
											<a href="#ReplySection" class="reply" onclick="comment(this);" data-commentID="<?php echo $comment->id ?>" >Reply</a>
										</div>
										<p><?php echo $comment->message ?></p>

										<?php 
											$replies = $Comment->getAllAcceptedReplyByBlogByComment($blog_id, $comment->id);
											if ($replies) {
												foreach ($replies as $key => $reply) {
											?>
										<!-- reply -->
										<div class="media">
											<div class="media-left">
												<img class="media-object" src="./assets/img/avatar.png" alt="">
											</div>
											<div class="media-body">
												<div class="media-heading">
													<h4><?php echo $reply->name ?></h4>
													<span class="time"><?php echo date('M d, Y h:i:s a', strtotime($reply->created_date)) ?></span>
													<a href="#ReplySection" class="reply" onclick="comment(this);" data-commentID="<?php echo $comment->id ?>">Reply</a>
												</div>
												<p><?php echo $reply->message ?></p>
											</div>
										</div>

											<?php
												}
											}
										 ?>

									</div>
								</div>

								<?php
										}
									}
								 ?>

								<!-- comment -->
								<!-- <div class="media">
									<div class="media-left">
										<img class="media-object" src="./assets/img/avatar.png" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h4>John Doe</h4>
											<span class="time">March 27, 2018 at 8:00 am</span>
											<a href="#" class="reply">Reply</a>
										</div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> -->

										<!-- comment -->
									<!-- 	<div class="media">
											<div class="media-left">
												<img class="media-object" src="./assets/img/avatar.png" alt="">
											</div>
											<div class="media-body">
												<div class="media-heading">
													<h4>John Doe</h4>
													<span class="time">March 27, 2018 at 8:00 am</span>
													<a href="#" class="reply">Reply</a>
												</div>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
											</div>
										</div>
									 </div>
								</div>  -->
								<!-- /comment -->

			
							</div>
						</div>
						<!-- /comments -->

						<!-- reply -->
						<div class="section-row">
							<div class="section-title" id="ReplySection">
								<h2>Leave a reply</h2>
								<p>your email address will not be published. required fields are marked *</p>
							</div>
							<form class="post-reply" action="process/comment" method="post">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<span>Name *</span>
											<input class="input" type="text" name="name">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span>Email *</span>
											<input class="input" type="email" name="email">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span>Website</span>
											<input class="input" type="text" name="website">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="input" name="message" placeholder="Message"></textarea>
										</div>
										<input type="hidden" name="commentid" id="comment_id" value="">										
										<input type="hidden" name="blogid" value="<?php echo ($blog_id) ?>">
										<button class="primary-button" type="submit">Submit</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /reply -->
					</div>
					<!-- /Post content -->

					<!-- aside -->
					<div class="col-md-4">
						<?php 
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
							<a target="_blank" href="<?php echo $simpleAd[0]->url ?>" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="<?php echo $thumbnail; ?>" alt="">
							</a>

						<?php  
							}
						 ?>
						</div>
						<!-- /ad -->

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
									<li><a href="category?id=<?php echo $category->id; ?>" class="<?php echo CAT_COLOR[$category->id%4] ?>"><?php echo $category->categoryname ?><span>
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
								$Category = new category();
								$categories = $Category->getAllCategory();
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
						
						<!-- archive -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Archive</h2>
							</div>
							<div class="archive-widget">
								<ul>
									<?php 
										$Archive = new archive();
										$Archives = $Archive->getAllArchive();
										if ($Archives) {
											foreach ($Archives as $key => $archive) {

									?>
												<li><a href="archive?id=<?php echo $archive->id ?>"><?php echo date('M d, Y',strtotime($archive->date)); ?></a></li>
									<?php			
											}
										}
									 ?>
								</ul>
							</div>
						</div>
						<!-- /archive -->
					</div>
					<!-- /aside -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
		

		<?php include 'inc/footer.php'; ?>

<script>
	$('blockquote').addClass('blockquote');

	function comment(element){
		var id = $(element).data();
		console.log(id.commentid);
		$('#comment_id').val(id.commentid);
	}
</script>