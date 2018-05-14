<!-- View Popup  -->
<?php $this->beginWidget('booster.widgets.TbModal', array('id'=>'viewModal')); ?>
<!-- Popup Header -->
<div class="modal-header">
	<div class="row">
		<p class="col-xs-9"><?php echo Yii::app()->name; ?></p>
		<p class="col-xs-3 text-right">
			<!-- close button -->
			<?php $this->widget('booster.widgets.TbButton', array(
			    'label'=>'X',
			    'context' => 'danger',
			    'url'=>'#',
			    'htmlOptions'=>array('data-dismiss'=>'modal'),
			)); ?>
			<!-- close button ends-->
		</p>	
	</div>
</div>
<!-- Popup Content -->
<div class="modal-body">
</div>
<!-- Popup Footer -->
<div class="modal-footer ">
</div>
<?php $this->endWidget(); ?>
<!-- View Popup ends -->