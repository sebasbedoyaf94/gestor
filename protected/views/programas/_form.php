<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'programas-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información del Programa</h3>
		</div>
		
		<div class="col-xs-12 col-sm-4">
			<?php echo $form->dropDownListGroup($model,'prog_cli_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Clientes::model()->findAll(array("condition"=>"cli_habilitado='Si'")), 'cli_id', 'cli_nombre'),
						'htmlOptions' => array(
							'empty'=>'-- Selecciona un Cliente --',
						),
					),
				)
			); ?>
		</div>

		<div class="col-xs-12 col-sm-4">
			<?php echo $form->textFieldGroup($model,'prog_nombre',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-4">
			<?php echo $form->dropDownListGroup($model,'prog_habilitado', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>
		</div>

		<div class="col-xs-12 col-sm-12">
			<?php echo $form->textAreaGroup($model,'prog_descripcion', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'')))); ?>
		</div>

	</div>

	<div class="col-xs-12">
		<p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>
		<?php echo $form->errorSummary($model); ?>
	</div>

	<div class="col-xs-12 text-center">
		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=>$model->isNewRecord ? 'Crear Programa' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>
