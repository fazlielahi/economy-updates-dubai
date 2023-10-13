<?php

	// PUBLIC VIEW FUNCTIONS

	// category query
	
	function get_categories($all = null, $id = null, $limit = 200, $position = "ASC")
	//200 is random deault value of $limit
	{
		global $connection;

		$all_categ = Array();
	
		if($all == "all_caregories")
		{
			$categ_sql = "SELECT a.id, a.title, a.created_at, a.status,
							a.cover, b.firstname, b.lastname FROM categories a
							LEFT JOIN
							members b
							ON
							a.author_id = b.id
							
							ORDER BY a.position $position
							
							LIMIT $limit
			";
			
		}else if($all == "popular_categories"){
			
			$categ_sql = "SELECT a.id, a.title, a.created_at,
							a.cover, b.firstname, b.lastname FROM categories a
							LEFT JOIN
							members b
							ON
							a.author_id = b.id
							
							WHERE a.popular = 1 	 	
							ORDER BY a.position $position
							
							LIMIT $limit
			";
			
		}else{
			
			$categ_sql = "SELECT * FROM categories WHERE id = '$id' ";
			$categ_query = mysqli_query($connection, $categ_sql);
			$categ = mysqli_fetch_assoc($categ_query);

			return $categ;
			
		}
			$categ_query = mysqli_query($connection, $categ_sql);
			//die(mysqli_error($connection));
			
			while($categ = mysqli_fetch_assoc($categ_query))
			{
				array_push($all_categ, $categ);
			}
			
			return $all_categ;
		
	}

	// NEWS QUERY

	function get_news($all = null, $id = null, $limit = 4, $start = 0)
	{
		global $connection;

		$all_news = Array();
		
		if($all == "all_news") // all news can be gotten from this query
		{
			$news_sql = "SELECT a.id, a.title, a.created_at,
							a.image, b.firstname, b.lastname, c.title AS categ_title FROM news a
							LEFT JOIN
							members b
							ON
							a.author_id = b.id
							LEFT JOIN
							categories c 
							ON 
							a.category_id = c.id
							
							WHERE a.status = 1
							ORDER BY id DESC
							
							LIMIT $start, $limit
							
							";
							
		}else if($all == "topstory") //query for top stories
		{
			$news_sql = "SELECT a.*,
						 b.title AS categ_title
						 FROM news a
						 LEFT JOIN
						 categories b 
						 ON
						 a.category_id = b.id
			
						 WHERE top_story = 1 ORDER BY id DESC LIMIT 0, 3"; 
			
		}else if($all == "all_categ_news") // ---- category news
		{
			 $news_sql = "SELECT a.*,
						 b.title AS categ_title,
						 c.firstname AS author,
						 c.lastname
						 FROM news a
						 LEFT JOIN
						 categories b 
						 ON
						 a.category_id = b.id
						 LEFT JOIN
						 members c ON
						 a.author_id = c.id

						 WHERE a.status = 1 AND a.category_id = '$id' ORDER BY a.id DESC LIMIT $start, $limit"; 	
			
		}else if($all == "all_news_member") // ---- category news
		{
			 $news_sql = "SELECT a.*,
						 b.title AS categ_title,
						 c.firstname AS author,
						 c.lastname
						 FROM news a
						 LEFT JOIN
						 categories b 
						 ON
						 a.category_id = b.id
						 LEFT JOIN
						 members c ON
						 a.author_id = c.id

						 WHERE a.status = 1 AND a.author_id = '$id' ORDER BY a.id DESC LIMIT $start, $limit"; 	
			
		}else
		{
			$news_sql = "SELECT a.*, b.firstname AS author, b.lastname, c.title AS categ_title FROM news a
						 LEFT JOIN
						 members b ON
						 a.author_id = b.id
						 LEFT JOIN 
						 categories c ON
						 a.category_id = c.id
						 WHERE a.id = '$id'  ";
						 
			$news_query = mysqli_query($connection, $news_sql);
			$news = mysqli_fetch_assoc($news_query);
			return $news;
		}
		
		//echo $news_sql;
	
		$news_query = mysqli_query($connection, $news_sql);
		//die(mysqli_error($connection));

		while($news = mysqli_fetch_assoc($news_query))
		{
			array_push($all_news, $news);
		}
		return $all_news;
	}
	
	
	//videos
	
	function get_videos($all, $id, $limit, $start)
	{
		global $connection;

		$all_videos = Array();
		
		if($all == "all_videos") // all videos can be gotten from this query
		{
			$video_sql = "SELECT a.id, a.caption, a.created_at,
							a.video, a.cover, b.firstname, b.lastname, c.title AS categ_title FROM news_videos a
							LEFT JOIN
							members b
							ON
							a.author_id = b.id
							LEFT JOIN
							categories c 
							ON 
							a.category_id = c.id
							
							WHERE a.status = 1
							
							ORDER BY id DESC
							
							LIMIT $start, $limit
							
							";
							
		}else if($all == "all_categ_videos"){
			
			$news_sql = "SELECT a.*,
						 b.title AS categ_title
						 FROM news_videos a
						 LEFT JOIN
						 categories b 
						 ON
						 a.category_id = b.id

						 WHERE a.status = 1 AND a.category_id = '$id' ORDER BY a.id DESC LIMIT 4"; // ---- category news
			
		}else{
		
			$video_sql = "SELECT a.*, b.firstname AS author, b.lastname,
						c.title AS categ_title FROM news_videos a
						 LEFT JOIN
						 members b ON
						 a.author_id = b.id
						 LEFT JOIN 
						 categories c ON
						 a.category_id = c.id
						 WHERE a.id = '$id'  ";
			$video_query = mysqli_query($connection, $video_sql);
			$videos = mysqli_fetch_assoc($video_query);
			return $videos;
		
		}
		
			$video_query = mysqli_query($connection, $video_sql);
			
			while($videos = mysqli_fetch_assoc($video_query))
			{
				array_push($all_videos, $videos);
			}
			
			return $all_videos;
	}


	function search($q)
	{
		$search_sql = "SELECT * FROM news
							WHERE
							title LIKE %q%
							OR
							text LIKE %q%
							";
	}

?>