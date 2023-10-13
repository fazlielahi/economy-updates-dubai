<?php
	
	$all_popular_categ = get_categories("popular_categories", "", 4);
	$popular_categ_list = "";
	foreach($all_popular_categ as $popular_categ)
	{
		$popular_categ_list .= "
		
			<span class='popular_categ'>
				<a href='categories.php?id=$popular_categ[id]'>$popular_categ[title] </a>
			</span>
		
		";
	}
	
?>

<div class="row1">
	<h5> Popular Categories </h5>
	<?php  echo $popular_categ_list ?>
</div>

<div class="col1">
	<h3> About us </h3>
	<p>
		Get the latest business and financial news, analysis, documentaries, event coverage, interviews, talk shows and commentaries direct from economyupdatedubai.tv website Stay informed wherever you are with top business and financial news headline alerts and informative video content. economyupdatedubai.tv connects with viewers digitally, providing diverse programming throughout the business day and is seamlessly integrated with Dubai News Digital Networks for maximum reach and brand exposure.
	</p>
	<div class="social-links">
		<a href="https://www.facebook.com/masiapk" target="_blank">
			<img src="images/facebook.png" title="Facebook" /> 
		</a>
		
		<a href="https://www.instagram.com/masiainstitute/?hl=en" target="_blank"> 
			<img src="images/instagram.jpg" title="Instagram" /> 
		</a>
		
		<a href="https://twitter.com/MasiaInstitute" target="_blank">
			<img src="images/twitter.jpg" title="Twitter" />
		</a>
		
		<a href="https://www.pinterest.com/masiainstitute/" target="_blank">
			<img src="images/pinterest.jpg" title="Pinterest" />
		</a>
		
		<a href="https://www.youtube.com/channel/UCFkR0mYt61XhcQYnjh-aWxw" target="_blank">
			<img src="images/youtube.png" title="Youtube" />
		</a>
		
	</div>
</div>

<div class="col">
	<h3> Contact </h3>
	<p>
		Welcome to Economy Update Dubai. Below are some details to reach us. To avoid any confusion contact directly on
		<br /><br />
		<b> WhatsApp </b>
		<br />
		034156009801
		<br />
		<b> Email </b>
		<br />
		info@eud.com
		<br />
		fazlielahi03060155124@gmail.com
	</p>
</div>

<div class="col">
	<a href="index.php"> 
		<img src="images/logo.png"/>
	</a>
	<p class="copyright"> © 2023 All rights reserved by Economy Update Dubai </p>
</div>