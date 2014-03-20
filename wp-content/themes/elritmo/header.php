<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo
 */
 global $sape;
     if (!defined('_SAPE_USER')){
        define('_SAPE_USER', '860912d9444fcef32ff079a6a3612917');
     }
     require_once($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php');
$o['force_show_code'] = true;
     $o['charset'] = 'UTF-8';
$sape = new SAPE_client($o);
 unset($o);
 
  global $template_path; $template_path = get_bloginfo('template_url');
 global $our_url; $our_url = 'http://mantiya.in.ua'
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
	
	<?php if (is_tag()) { echo "<meta name='description' content='".strip_tags(tag_description())."' /> ";}; ?>
	 
	<base href="http://elritmo.info/" />
	<link href="/favicon.ico" rel="icon" type="image/x-icon" />
	<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<script type="text/javascript" src="http://vkontakte.ru/js/api/share.js?10" charset="windows-1251"></script>



	<script type="text/javascript" src="<?php echo $template_path; ?>/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="<?php echo $template_path; ?>/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $template_path; ?>/fancybox/jquery.fancybox-1.3.4.css" media="screen" />	
	
	<!--
	<script type='text/javascript'>		
		$(document).ready(function() {	 

			$("#ordernow").fancybox({
				type: 'iframe',
				maxWidth	: 600,
				maxHeight	: 500,
				fitToView	: false,
				width		: '70%',
				height		: '70%',
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none',				
			}).trigger('click');
			
			
			//$("#ordernow").fancybox();			
		 
		});
	</script>	
	-->

<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?78"></script>

<script type="text/javascript">
  VK.init({apiId: 3393667, onlyWidgets: true});
</script>

<!-- Код авторизации администратора коментариев 
<meta property="fb:admins" content="{100004502586918}"/> -->



</head>


<body <?php body_class(); ?>>
	<div id="header">
		<div id="header-menu">
			<div id="container">
			
				<ul><?php wp_list_pages('title_li=&exclude=585,2502&depth=1'); ?></ul>
				
			<!--	<a class="fancybox.ajax" id='ordernow' href="/order/index.php" style='display: none;'>Купить</a>-->
			
						<?php $search_text = __("Поиск","hubet"); ?>
						<form method="get" id="searchform"  
						action="<?php bloginfo('home'); ?>/"> 
						<input type="hidden" id="searchsubmit" /> 
						<div id="s-div">
						<input type="text" value="<?php echo $search_text; ?>"  
						name="s" id="s"  
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
				<div id="adver"><!--<a href="http://elritmo.info/2011/09/01/2-salsa-fest-karnaval" title="II «Сальса-фест Карнавал»"><img src="<?php bloginfo('template_url'); ?>/images/adver/karnaval.png" alt="II «Сальса-фест Карнавал»" height="195px" width="553px"></a>--></div>
				<span><em>Всеукраинский Сальса Портал</em></span>
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



