<?php
/* ---------------------------------------------------------------------------------------------------
	
	Starting page
	
--------------------------------------------------------------------------------------------------- */
?>

<?php $jw_option = jw_get_options(); /* Get theme options */ ?>

<?php get_header(); ?>
		
	<h4>The Documentation &amp; Support</h4>
	<p>We suggest you take a look at the documentation, it's located in the "Documentation" folder that came with your download from Themeforest. If you do not find what you need in the documentation then feel free to to contact us using the contact form on our <a href="http://themeforest.net/user/WPScientist">profile page</a>. In most cases we need WordPress admin login credentials and FTP login credentials to help you fix the problem you have, so to get your problem solved faster please include that info when you contact us.</p>
	
	<h4>Get Started</h4>
	<p>I guess the first thing you would like to do is change the homepage to a page you created.</p>
	<ol>
		<li>
			Create the page you want
			<ul>
				<li>Blog posts listing &rarr; choose "Blog" as "Template"</li>
				<li>Portfolio posts listing &rarr; choose "Portfolio" as "Template"</li>
				<li>Regular page &rarr; choose "Default" as "Template"</li>
			</ul>
		</li>
		<li>Go to Settings -> Reading (WordPress admin)</li>
		<li>Set "A static page" under "Front page displays"</li>
		<li>Set the page you creted as "Front page"</li>
		<li><strong>Important:</strong> Don't change the "Posts page", leave it at "--Select--"</li>
	</ol>
	
<?php get_footer(); ?>