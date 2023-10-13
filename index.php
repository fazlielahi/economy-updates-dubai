<?php

	session_start();
	include("inc/database.php");
	include("inc/functions.php");
	include("inc/functions-general.php");
	$dir_images = "images/";
	$dir_media = "media/";
	
?>

<?php

	// Top story
	$topstory = get_news("topstory");
	//var_dump($topstory);
	//die();
	
	$topstory_slider = "";
	$topstory_list = "";

	foreach($topstory as $top)
	{
		
		if(is_file($dir_images . "news/large/" . $top['image']))
		{
			$image = " <a href='news.php?id=$top[id]&type=news'>
							<img src='$dir_images/news/large/$top[image]' width='400' />
						</a>	
					";
		}else
		{
			$image = " <a href='news.php?id=$top[id]&type=news'>
							<img src='$dir_images/large/default.jpg' width='400' />
						</a>	
					";
		}
		
		$topstory_slider .= "
						
						 <li class='pbSlider slide1'>
							<a href='news.php?id=$top[id]&type=news'> $image </a>
							<div class='PBcaption'>
							   <h2><a href='news.php?id=$top[id]&type=news' > $top[title] </a></h2>
							</div>
						</li>
							
		";
		
		$topstory_list .= "
				
			<div class='topstory_box'>
				<a href='news.php?id=$top[id]&type=news'> $image </a>
				
				<span class='categ_name'> $top[categ_title] </span>
				
				<div class='topnews-heading'> 
					<a href='news.php?id=$top[id]&type=news' >" 
						. substr($top['title'], 0, 70) . "... 
					</a> 
					<span class='created_at'> $top[created_at] </span>
				</div>
			</div>
			
		";
	}
	
	//latest news

	$all_latest_news = get_news("all_news", "", 15);
	$latest_news_list = "";
	foreach($all_latest_news as $latest_news)
	{
		
		
		if(is_file($dir_images . "news/thumb/" . $latest_news['image']))
		{
			$image = " <div class='image'>
							<a href='news.php?id=$latest_news[id]&type=news' >
								<img src='$dir_images/news/thumb/$latest_news[image]' width='200' />
							</a>
						</div> ";
		}else
		{
			
			$image = " <div class='image'>
							<a href='news.php?id=$latest_news[id]&type=news' >
								<img src='$dir_images/default.jpg]' width='200' />
							</a>
						</div> ";
		}
		
		$latest_news_list .= "
		
						<div class='news_box'>
							<a href='news.php?id=$latest_news[id]&type=news' > $image </a> 
							
							<span class='categ_name'> $latest_news[categ_title] </span>
							
							<a href='news.php?id=$latest_news[id]&type=news' class='text-light'>" 
								. substr($latest_news['title'], 0, 70) . "... 
							</a> 
						</div>
		";
	}

	// First 2 categories news

	$all_categ = get_categories("all_caregories", "", 2, "ASC");
	$category_list = "";
	$news_list = "";

	foreach($all_categ as $categ)
	{
		$categ_id = $categ['id'];

		$category_list .= "

			<h2 class='categ_heading'> $categ[title] </h2>
			<div class='category'>";
			
				$all_news = get_news('all_categ_news', $categ_id); //for categories
				foreach($all_news as $news)
				{
					if(is_file($dir_images . "news/thumb/" . $news['image']))
					{
						$image = " <div class='image'>
							<a href='news.php?id=$news[id]&type=news' >
								<img src='$dir_images/news/thumb/$news[image]' width='200' />
							</a>
						</div> ";
						
					}else
					{
						$image = " <div class='image'>
							<a href='news.php?id=$latest_news[id]&type=news' >
								<img src='$dir_images/thumb/default.png' width='200' />
							</a>
						</div> ";
					}
					
					$category_list .= "
					
						<div class='news_box'>
							<a href='news.php?id=$latest_news[id]&type=news' > $image	</a> 
							
							<span class='categ_name'> $news[categ_title] </span>
							
							<a href='news.php?id=$news[id]&type=news' class='text-dark title-news'>" .
								substr($news['title'], 0, 70) . "...
							</a> 
						</div>
					";
				}
				
		$category_list .= "</div>";
	}

	// Last 3 categories news

	$all_categ = get_categories("all_caregories", "", 3, "ASC");
	$category_list2 = "";

	foreach($all_categ as $categ)
	{
		$categ_id = $categ['id'];

		$category_list2 .= "

			<div class='category'>
				<h2 class='categ_heading'> $categ[title] </h2> ";
				$all_news = get_news('all_categ_news', $categ_id, 8); //for categories
				foreach($all_news as $news)
				{
					if(is_file($dir_images . "news/thumb/" . $news['image']))
					{
						$image = " <div class='image'>
							<a href='news.php?id=$news[id]&type=news' >
								<img src='$dir_images/news/thumb/$news[image]' />
							</a>
						</div> ";
					}else
					{
						$image = " <div class='image'>
							<a href='news.php?id=$news[id]&type=news' >
								<img src='$dir_images/thumb/default.png' />
							</a>
						</div> ";
					}
					
					$category_list2 .= "
					
						<div class='news_box'>
							<a href='news.php?id=$news[id]&type=news' > $image </a>
							<a href='news.php?id=$news[id]&type=news' class='text-dark newsbox-heading'>" 
								. substr($news['title'], 0, 70) . "... 
							</a> 
						</div>
					";
				}
				
		$category_list2 .= "</div>";
	}
	
	
	//for videos
	
	if(isset($_GET['start']))
	{
		$start = $_GET['start'];
	}else
	{
		$start = 0;
	}

	$vid_limit = 4;

	$nextpage = $start + $vid_limit;
	$previouspage = $start - $vid_limit;
	
	$videos_list = "";
	$videos_news = get_videos('all_videos', "", $vid_limit, $start); //video categ id is 24
				foreach($videos_news as $video)
				{
					if(is_file($dir_media . "cover/" . $video['cover']))
					{
						$video_cover = " <div class='video_cover'>
											<a href='news.php?id=$video[id]&type=video'>
												<img src='$dir_media/cover/$video[cover]' />
											</a>
										</div> ";
					}else
					{
						$video_cover = " <div class='video_cover'> 
											<a href='news.php?id=$video[id]&type=video'>
												<video src='$dir_media/videos/$video[video]' > 
											</a>	
										</video> </div>";
					}
					
					$videos_list .= "
						
						<div class='video_box'>
							<a href='news.php?id=$video[id]&type=video'> $video_cover </a>
							
							<span class='categ_name'> $latest_news[categ_title] </span>
							
							<a href='news.php?id=$video[id]&type=video' class='text-dark video-caption'>" 	.	substr($video['caption'], 0, 77) . "... 
							</a> 
						</div>
					";
				}
?>

<html>

	<head>
		
		<title> <?php $categ['title']; ?> </title>
		<link rel='stylesheet' href='styles/home.css' />
		<link rel='stylesheet' href='lib/bootstrap-4.6.0-dist/css/bootstrap.min.css' />
		<link rel='stylesheet' href='lib/fontawesome-free-6.4.2-web/css/all.min.css' />
		<link rel='stylesheet' href='styles/topstory.css' />
		<link rel='stylesheet' href='styles/header.css' />
		<link rel='stylesheet' href='styles/footer.css' />
		<link rel='stylesheet' href='styles/sidebar.css' />
	</head>
	
	<body>
	
		<div class='header' >
			
				<?php include("inc/header.php"); ?> 
			
		</div>
		
		<h3 class='topstory_heading'> Top Stories </h3>
		<div class='topstory'> 
		    <ul class="slider">
			  <?php  echo $topstory_slider; ?>
		    </ul>
		</div>	
		<div class='top-stories-sec'>
			<?php  echo $topstory_list; ?>
		</div>
		<div class='clear'></div>

		<!-- Latest news -->
		<h3 class='news_heading'> Latest News </h3>
		<div class='bg-dark latest_news'>
			<?php echo $latest_news_list ?>
		</div>
		
		<!-- First 2 categories news -->
		<div class='categ_news_asc'> <!-- asc means first 2 categ news -->
			<?php echo $category_list ?>
		</div>
		
		<!-- Last 4 categories news -->
		<div class='categ_news_desc'>	<!-- desc means first 2 categ news -->
			<?php echo $category_list2 ?>
		</div>
		
		<!-- Latest Videos -->
		<h2 class='video_heading' id="watch"> What to watch </h2>
		<div class='videos_sec'> <!-- asc means first 2 categ news -->
			<?php 
			
				$sql = "SELECT COUNT(video) AS total_videos FROM news_videos";
				$query = mysqli_query($connection, $sql);
				$total_vid = mysqli_fetch_assoc($query);
				
				if($previouspage >= 0)
				{
					echo "<a href='index.php?start=$previouspage&#watch'> 
							<i class='fa-solid fa-circle-chevron-left arrow-icon'></i>
						  </a> ";
				} 
				
				$total_videos = $total_vid['total_videos'];
				echo  $videos_list;
				
				if($nextpage < $total_videos)
				{
					echo "<a href='index.php?start=$nextpage&#watch'> 
							<i class='fa-solid fa-circle-chevron-right arrow-icon'></i> 
						  </a> ";
				}
				
				
				
			?>
		</div>

		<div class="footer">
			<?php include("inc/footer.php"); ?> 
		</div>
	
		<script src="lib/slider/js/code.jquery.com_jquery-3.6.4.min.js"></script>
		<script src="lib/fontawesome-free-6.4.2-web/js/all.min.js"></script>
		<script src="lib/slider/js/PBslider.js"></script>
		
		
		<script>

			var search = document.querySelector("#search");
			var topstory = document.querySelector(".topstory");
			var topstory_sec = document.querySelector(".top-stories-sec");
			
			function search_show()
			{
				
				if(search.style.visibility == "visible")
				{
					search.style.visibility = "hidden";
					topstory.style.display = "block";
					topstory_sec.style.display = "block";
					
				}else
				{
					search.style.visibility = "visible";
					topstory.style.display = "none";
					topstory_sec.style.display = "none";
				}
			}

		</script>
    
	</body>
	
</html>