<?php

	session_start();
	include("inc/database.php");
	include("inc/functions.php");
	include("inc/functions-general.php");
	$dir_images = "images/";
	
?>

<?php 

	if(!isset($_GET['id']))
	{
		die("Error: Invalid access");
		
	}else
	{
		$id = $_GET['id'];
	}
	
	if(isset($_GET["start"]))
	{
		$start = $_GET["start"];
	}else
	{	
		$start = 0;
	}
	
	if(isset($_GET["q"]))
	{
		$q = $_GET["q"];
	}else
	{	
		$q = "";
	}
	
	
	
	$limit = 7;
	
	$nextpage = $start + $limit;
	$previouspage = $start - $limit;
	
	$categ = get_categories("", $id);

	$categ_title = $categ['title'];

	$all_news = get_news("all_categ_news", $id, $limit, $start);
	$news_list = "";

	foreach($all_news as $news)
	{
		
		if(is_file($dir_images . "news//thumb/" . $news['image']))
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
		
		$news_list .= "
		
			<div class='news_box'>
				<a href='news.php?id=$news[id]' > $image </a>
				
				<h5 class='news-heading'> 
					<a href='news.php?id=$news[id]'>" . substr($news['title'], 0, 100) . " </a> 
				</h5>
				
				<p class='news-text'> " .  substr($news['text'], 0, 157);
					
			$news_list .= "	 <a href='news.php?id=$news[id]'> | Read more ...</a> </p>
				<span class='news-about'> $news[created_at] | $news[author] | $news[categ_title] </span>	
			</div>
		
		";
	}

?>

<html>

	<head>
		
		<title> <?php $categ['title']; ?> </title>
		<link rel='stylesheet' href='styles/category.css' />
		<link rel='stylesheet' href='styles/header.css' />
		<link rel='stylesheet' href='styles/sidebar.css' />
		<link rel='stylesheet' href='styles/footer.css' />
		<link rel='stylesheet' href='lib/bootstrap-4.6.0-dist/css/bootstrap.min.css' />
	</head>
	
	<body>
	
		<div class='header' >
			<div class='menu'>
				<?php include("inc/header.php"); ?> 
			</div>
		</div>
		
		<h3 class="categ_title"> Latest from <b> <?php echo $categ_title; ?> </b> </h3>
		
		<div class='news-sec'> 

			<?php echo $news_list ?>
			
			<div class="pagination-categ">
				<?php 
					
					if($previouspage >= 0)
					{
						echo "<a href='categories.php?id=$id&start=$previouspage' > Previous </a>";
					}
					
					$sql = "SELECT * FROM news where status = 1 AND category_id = '$id' ";
					$query = mysqli_query($connection, $sql);
					$total = mysqli_num_rows($query);
					
					if($nextpage < $total)
					{
						echo "<a href='categories.php?id=$id&start=$nextpage' > Next </a>"; 
					}		
				?>
		</div>

		</div>
		
		<div class='sidebar'> 
			<div class='top-stories-sec'>
				<?php include('inc/sidebar.php') ?>
			</div> 
		</div>
		
		<div class="clear"> </div>
		
		
		
		<div class="footer">
			<?php include("inc/footer.php"); ?> 
		</div>
		
	</body>
	
</html>