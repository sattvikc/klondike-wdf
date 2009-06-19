	<!-- content-wrap ends-->	
	</div>
		
	<!-- footer starts here -->	
	<div id="footer-wrap"><div id="footer-content">
	
		<div class="col float-left space-sep">
		
			<h3>Recent Posts</h3>
			<ul class="col-list">				
<?php wp_get_archives('type=postbypost&limit=10'); ?>
			</ul>		
				
		</div>
		
		<div class="col float-left">
		
			<h3>Recent Comments</h3>
			
	
			<ul class="col-list">				
				<?php mdv_recent_comments(5); ?>				
			</ul>
				
		</div>		
	
		<div class="col2 float-right">
		
			<h3>About</h3>			
			
			<p>
			<a href="http://getfirefox.com/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/thumb.jpg" width="40" height="40" alt="firefox" class="float-left" /></a>
			Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. 
			Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu 
			posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum 
			odio, ac blandit ante orci ut diam.</p>
			
			<p>
			Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. 
			Cras id urna. <a href="#">Learn more...</a></p>
			
			<p>
			&copy; Copyright <?php echo date('Y');?> <strong><?php bloginfo('name'); ?></strong><br /> 
			Design by: <a href="http://www.styleshout.com">styleshout</a> | <a href="http://www.themelab.com/2008/04/01/colourise-free-wordpress-theme-38/" title="Colourise WordPress Theme">Colourise</a> by: <a href="http://www.themelab.com" title="Free WordPress Themes">Theme Lab</a> and <a href="http://www.webhostingreport.com/best-linux-hosting.html">Best Linux Web Hosting</a>
			</p>
		
			<p>						
			Powered by <a href="http://wordpress.org">WordPress</a> | Valid <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | 
		   	   <a href="http://validator.w3.org/check/referer">XHTML</a>							
			</p>	
			
		</div>		
			
	</div></div>
	<div class="clearer"></div>
	<!-- footer ends here -->

<!-- wrap ends here -->
</div>
<?php wp_footer(); ?>
</body>
</html>