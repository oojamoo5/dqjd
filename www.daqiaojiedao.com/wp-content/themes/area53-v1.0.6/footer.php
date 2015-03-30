<?php
/* ---------------------------------------------------------------------------------------------------
	
	Footer
	
--------------------------------------------------------------------------------------------------- */
?>
	
<?php $jw_option = jw_get_options(); /* Get theme options */ ?>

<?php global $sn; ?>

<?php $sidebar_name = 'Footer Widgets'; ?>
				
					</div><!-- #main -->
					
				</div><!-- .wrapper-inner -->
				
			</div><!-- .wrapper -->
			
			<?php
			/* ---------------------------------------------------------------------------------------------------					
			
				Footer
				
			--------------------------------------------------------------------------------------------------- */
			?>
			
			<?php if($jw_option[$sn.'_footer'] == 'yes'){ ?>
			
				<footer id="footer" class="clearfix">
						
					<?php if($jw_option[$sn.'_footer_main'] == 'widgets'){ ?>
					
						<div id="footer-inner" class="clearfix">
					
							<div class="one-third">
								<div id="text-2" class="widget widget_text"><h3 class="widget-title"><span>联系我们</span></h3>	
									<div class="textwidget"><p>上海市杨浦区周家嘴路3206号<!-- br--><br>
															   联系人：黄老师 15800634222<br>
															   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;吴老师 13816637095 <br>
															   邮箱：2116616499@qq.com
															</p>
									</div>
								</div>
							</div>
							<div class="one-third">
								<div id="text-2"><h3 class="widget widget-title"><span>二维码</span></h3>
									<dl class="footer-qrcode">
										<dd><img src="/image/qrcode1.jpg"/></dd>
										<dd><img src="/image/qrcode2.jpg"/></dd>
									</dl>
								</div>
							</div>
							<div class="one-third">
								<div id="linkcat-2" class="widget widget_links"><h3 class="widget-title"><span>友情链接</span></h3>
									<ul class="xoxo blogroll">
										<li><a target="_blank" href="http://www.ypcy.org.cn/ypcy/index.jsp">杨浦创业</a></li>
										<li><a target="_blank" href="http://www.kic.net.cn/">创智天地</a></li>
										<li><a target="_blank" href="http://www.ybc.org.cn/">中国青年创业计划</a></li>
										<li><a target="_blank" href="http://http://www.tjt.cn/">同济大学国家大学科技园</a></li>
									</ul>
								</div>
							</div>
							
						</div>
						
					<?php }else{ ?>
						
						<?php echo $jw_option[$sn.'_footer_main_text']; ?>
						
					<?php } ?>
					
				</footer><!-- end #footer -->
				
			<?php } ?>
		
		</div><!-- end #container -->
		
		<?php wp_footer(); ?>
		
		<?php  if(isset($jw_option[$sn.'_analytics']) && $jw_option[$sn.'_analytics_position'] == 'body'){ echo $jw_option[$sn.'_analytics']; } ?>
		
	</body>

</html>
