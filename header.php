<?php

	$all_categ = get_categories("all_caregories");
	//var_dump($all_categ);
	$menu = "";
	
	
	
	
	foreach($all_categ as $categ)
	{
		
		if($categ['status'] == 1)
		{
			$menu .= "<a href='categories.php?id=$categ[id]'> $categ[title]  </a>";
		}
	}

?>

<a href="index.php"> 
	<img src="images/logo.png" class="logo"/>
</a>

<img src="images/search.png" class="search-icon" onclick="search_show()"/>

<div id="search">
	<form action="categories.php">
		<input type="text" name="q"  class="search-field" placeholder="Search here" />
		<input type="submit" value="Search" class="search-btn"/>
	</form>
	
	<div id="menu-hidden">
		<?php 
			echo "<a href='index.php'> Home </a>";
			echo $menu;
		?>
	</div>

</div>

<div id="menu">
	<?php 
		echo "<a href='index.php'> Home </a>";
		echo $menu;
	?>
</div>

<script>

	var search = document.querySelector("#search");
	var topstory = document.querySelector(".topstory");
	
	function search_show()
	{
		
		if(search.style.visibility == "visible")
		{
			search.style.visibility = "hidden";
			
		}else
		{
			search.style.visibility = "visible";
		}
	}

</script>
    