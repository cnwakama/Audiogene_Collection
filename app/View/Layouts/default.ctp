<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'AudioGene v4');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('audiogene.theme');
		echo $this->Html->css('/usermgmt/css/umstyle');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	
	<div id="sidebar">
		<div id="logo"><a href="#" id="logo-splash"><span>AudioGene</span></a></div>
		<div id="sidebar-header">Navigation</div>
		<div id="sidebar-links">
			<?php echo $this->MenuBuilder->build('left-menu'); ?>
		</div>
	</div>	
	<div id="container">
		<div id="masthead">
						<h1 id="main-logo" style="margin: 0;">
							<a href="/" title="AudioGene">
								<span></span>
							</a>
						</h1>
						<ul class="links" id="navlist"><li class="first menu-1-1-2"><a href="https://genome.uiowa.edu" class="menu-1-1-2">Center for Bioinformatics and Computational Biology@UIowa</a></li>
						<li><a href="https://medicine.uiowa.edu/oto" class="menu-1-2-2">Department of Otolaryngology@UIowa</a></li></ul>
						</div>	
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<div class="rbroundbox">
						<div class="rbtop"><div></div></div>
							<div class="rbcontent">
								<div id="footer-copyright-message">
	 <div class="block-title" id="block-block-2"><strong></strong></div>

© Copyright 2012-<?php echo date("Y"); ?>, Center for Bioinformatics and Computational Biology at The University of Iowa
</div>
							</div><!-- /rbcontent -->
						<div class="rbbot"><div></div></div>
					</div>
			
		</div>
	</div>
	<?php /*echo $this->element('sql_dump');*/ ?>
</body>
</html>
