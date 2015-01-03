<?php 
	
	//include('simple_html_dom.php');
	
	$site = 'https://www.landlords.org.uk';
	
	$html = file_get_html($site . "/news-campaigns/press-releases");
	$news = $html->find('div[id=content-area]', 0);
	foreach($news->find('img') as $thumb){
		$thumb->src = str_replace("http:","https:", $thumb->src);
		$thumb->style="float: left; margin-right: 20px; margin-bottom: 20px;";
	}
	
	foreach($news->find('a') as $link){
		$href = $link->href;
		$link->href=$site . $href;
		$link->target="_blank";
	}
	
	foreach($news->find('ul') as $list){
		$list->style="display: none;";
	}
	
	echo $news;
	
?> 