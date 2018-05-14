<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'turnos-asesores-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información de los turnos de los asesores</h3>
		</div>
		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'turase_tur_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Turnos::model()->findAll(array("condition"=>"tur_habilitado='Si'")), 'tur_id', function($tur) {
							    return CHtml::encode($tur->tur_nombre);
							}),
						'htmlOptions' => array(
							'empty'=>'-- Seleccione un Turno --',
							'disabled'=>'disabled',
						),
					),
				)
			); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'turase_aseserv_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(AsesoresServicios::model()->findAll(array()), 'aseserv_id', function($aseserv) {
							    return CHtml::encode($aseserv->aseservAse->ase_nombre . " " . $aseserv->aseservAse->ase_apellidos);
							}),
						'htmlOptions' => array(
							'empty'=>'-- Seleccione un Asesor --',
							'disabled'=>'disabled',
						),
					),
				)
			); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->datePickerGroup($model,'turase_fechaInicio',
				array(
					'widgetOptions'=>array('options'=>array('weekStart'=>1, 'format'=>'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'')
					), 
					'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>'
					)
				); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->datePickerGroup($model,'turase_fechaFin',array('widgetOptions'=>array('options'=>array('weekStart'=>1, 'format'=>'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>
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
					'label'=>$model->isNewRecord ? 'Crear TurnosAsesores' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>
