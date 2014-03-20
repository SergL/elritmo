<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" media="screen" />
		<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/ie6.css" media="screen"/><![endif]-->		

		
	<?php remove_filter('wp_head','ec3_action_wp_head'); ?>
	<?php wp_head(); ?>
	
	<base href="http://elritmo.info/">
	<link href=”/favicon.ico” rel=”icon” type=”image/x-icon” />
	<link href=”/favicon.ico” rel=”shortcut icon” type=”image/x-icon” />
	
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<script type="text/javascript" src="http://vkontakte.ru/js/api/share.js?10" charset="windows-1251"></script>

</head>



<body <?php body_class(); ?>>

<body>
	<div id="header">
		<div id="header-menu">
			<div id="container">
			
			<ul><?php wp_list_pages('title_li=&exclude=585'); ?></ul>
			
						<?php $search_text = __("Поиск","hubet"); ?>
						<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/"> 
						<input type="hidden" id="searchsubmit" /> 
							<div id="s-div">
							<input type="text" value="<?php echo $search_text; ?>" name="s" id="s"  
							onblur="if (this.value == '')  
							{this.value = '<?php echo $search_text; ?>';}"  
							onfocus="if (this.value == '<?php echo $search_text; ?>')  
							{this.value = '';}" /> 
							</div>
						</form>
						
			</div>
		</div>
		<div id="header-presentation">
			<div id="container">
				<strong id="logo"><a href="/">elRitmo.info - Сальса в Укрине, бачата, сальсатеки, события, вечеринки Киев, Харьков, Донецк, Днепропетровск, Одесса.</a></strong>
				<SPAN style="font-weight:normal; margin-top:20px; float:right; font-size:22px; color:#fff;"><em>Всеукраинский Сальса Портал</em></SPAN>
			</div>
		</div>		

	</div>
	
<!--LiveInternet counter--><script type="text/javascript"><!--
new Image().src = "//counter.yadro.ru/hit?r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random();//--></script><!--/LiveInternet-->
	
	<div id="content">			



