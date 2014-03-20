<?php
/**
 * @package WordPress
 * @subpackage WordPress elritmo
 */
?>




	<!-- Content end -->	
	</div>

	
		
	<div id="footer">
		<div id="container">
		<p>
		<strong><a href="/" title="Карта сайта - Архив Сальсы за каждый месяц">© 2010 elRitmo .info</a></strong> &nbsp;|&nbsp; 
		<a href="/?p=585" title="Карта сайта - Архив Сальсы за каждый месяц">карта сайта</a> &nbsp;|&nbsp; 
		<a href="/?p=11" title="Карта сайта - Архив Сальсы за каждый месяц">обратная связь</a> </p>
		
		<p style="margin-left:60px; color:#e69800;"><a href="http://www.southpaw.in.ua" rel="nofollow" target="_blank" style="color:#e69800;">Southpaw Design: идея → дизайн → реализация</a>
		</p >
		<p style="margin-left:60px; margin-top:1px; color:#e69800;">
		<!--LiveInternet logo--><a href="http://www.liveinternet.ru/click"
		target="_blank" rel="nofollow"><img src="//counter.yadro.ru/logo?25.6"
		title="LiveInternet: показано число посетителей за сегодня"
		alt="" border="0" width="88" height="15"/></a><!--/LiveInternet-->

		</p>
				<?php wp_footer(); ?>
	
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
	

	
	
<!-- Yandex.Metrika -->
<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript"></script>
<div style="display:none;"><script type="text/javascript">
try { var yaCounter1491743 = new Ya.Metrika(1491743); } catch(e){}
</script></div>
<noscript><div style="position:absolute"><img src="//mc.yandex.ru/watch/1491743" alt="" /></div></noscript>
<!-- /Yandex.Metrika -->

<!-- Google Analitics -->	
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18677306-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!-- /Google Analitics -->	

<!-- WebVisor -->
<script type="text/javascript" id="__visorCode"></script>
<script type="text/javascript">
    var __visorInit = new Function('', 'if (typeof window["__visor"] != "undefined") __visor.init(20467);');
    setTimeout('document.getElementById("__visorCode").src="//c1.web-visor.com/c.js";',10);
</script>
<noscript><img src="//c1.web-visor.com/noscript?sid=20467" alt="" 
style="position:absolute;width:1px;height:1px;left:-999px;top:-999px;"></noscript>
<!-- /WebVisor -->
	
</body>
</html>



