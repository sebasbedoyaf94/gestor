<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php \$form=\$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'" . $this->class2id($this->modelClass) . "-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>\n"; ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información del <?php echo $this->modelClass; ?></h3>
		</div>
	<?php
	foreach ($this->tableSchema->columns as $column) {
		if ($column->autoIncrement) {
			continue;
		}
		?>
	<div class="col-xs-12 col-sm-6">
			<?php echo "<?php echo " . $this->generateActiveGroup($this->modelClass, $column) . "; ?>\n"; ?>
		</div>

	<?php
	}
	?>
</div>

	<div class="col-xs-12">
		<p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>
		<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>
	</div>

	<div class="col-xs-12 text-center">
		<div class="form-actions">
			<?php echo "<?php \$this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=>\$model->isNewRecord ? 'Crear ".$this->modelClass."' : 'Guardar Cambios',
				)); ?>\n"; ?>
		</div>
	</div>
</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
