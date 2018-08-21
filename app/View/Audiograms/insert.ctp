<h1>insert</h1>
<?php print_r($newData) ?>
<?php echo $this->element('sql_dump'); ?>
<div
<?php 
	echo $this->Html->link($this->Html->image('/img/Audiograms/
Audiogram_Mon_Aug_20_15:46:40_CDT_2018.jpeg') . ' ' . _('View More'), array('controller' => 'zones', 'action' => 'index'), array('escape' => false));
?> 
</div>

	<?php if ($picture): ?>  
    		<h2>There is a picture in the server</h2>
	<?php else: ?>
		<h3>There is no picture in the server</h3>
	<?php endif; ?>

	<?php if ($info) : ?>
		<h3>There is a info in the server</h3>
	<?php else: ?>
		<h2>There is no info in the server</h2>
	<?php endif; ?>	
