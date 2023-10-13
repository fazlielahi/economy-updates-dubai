<?php

	// Top stories
	$topstory = get_news("topstory");
	//var_dump($topstory);
	//die();
	$topstory_list = "";
	
	foreach($topstory as $top)
	{
		if(is_file($dir_images . "news/thumb/" . $top['image']))
		{
			$topstory_image = " <div class='image'> 	
									<a href='news.php?id=$top[id]' >
										<img src='$dir_images/news/thumb/$top[image]'  />
									</a>
								</div> ";
		}else
		{
			$topstory_image = " <div class='image'> 	
									<a href='news.php?id=$top[id]' >
										<img src='$dir_images/default.jpg'  />
									</a>
								</div> ";
		}
		
		$topstory_list .= "
				
			<div class='topstory_box'>
				<a href='news.php?id=$top[id]' > $topstory_image </a> 	
				<div class='topnews-heading'> 
					<a href='news.php?id=$top[id]' >" . substr($top['title'], 0, 55) . "... </a> 
					<span class='news-about'> $top[categ_title] | $top[created_at] </span>
				</div>
			</div>
			
		";
	}
	

	// Latest news
	$latest_news = get_news("all_news", "", 7);
	$latestnews_list = "";
	
	foreach($latest_news as $news)
	{
		if(is_file($dir_images . "news/thumb/" . $news['image']))
		{
			$image = " <div class='image'> 	
									<a href='news.php?id=$news[id]' >
										<img src='$dir_images/news/thumb/$news[image]'  />
									</a>
								</div> ";
		}else
		{
			$image = " <div class='image'> 	
									<a href='news.php?id=$news[id]' >
										<img src='$dir_images/default.png'  />
									</a>
								</div> ";
		}
		
		$latestnews_list .= "
				
			<div class='topstory_box'>
				$image	
				<div class='topnews-heading'> 
					<a href='news.php?id=$news[id]' >" . substr($news['title'], 0, 55) . "... </a> 
					<span class='news-about'> $news[categ_title]| $news[created_at] </span>
				</div>
			</div>
			
		";
	}
	
?>

	<h3 class="topstory-heading"> Top Stories </h3>
	
	<?php echo $topstory_list . "<h3 class='topstory-heading'> Latest News </h3>" . $latestnews_list?>



	