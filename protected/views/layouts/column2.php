<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>


<div class="row">
	<div class="col-xs-12 col-sm-9">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	
	<div class="col-xs-12 col-sm-3">
		<div id="sidebar">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operaciones',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		?>
		</div><!-- sidebar -->
	</div>

</div>
<?php $this->endContent(); ?>