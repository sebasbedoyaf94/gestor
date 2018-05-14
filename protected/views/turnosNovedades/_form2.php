<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'turnos-novedades-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información de la novedad del turno</h3>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'turnov_dia', array('widgetOptions'=>array('data'=>array("Lunes"=>"Lunes","Martes"=>"Martes","Miercoles"=>"Miercoles","Jueves"=>"Jueves","Viernes"=>"Viernes","Sabado"=>"Sabado","Domingo"=>"Domingo",), 'htmlOptions'=>array('class'=>'input-large')))); ?>
		</div>

		

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'turnov_nov_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Novedades::model()->findAll(array("condition"=>"nov_habilitado='Si'")), 'nov_id', function($nov) {
							    return CHtml::encode($nov->nov_nombre);
							}),
						'htmlOptions' => array(
							'empty'=>'-- Seleccione una Novedad --',
						),
					),
				)
			); ?>
		</div>



		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'turnov_horaInicio',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->timePickerGroup($model,'turnov_horaFin',array('widgetOptions' => array('noAppend' => true,'options' => array('disableFocus' => true,'showMeridian' => false),'wrapperHtmlOptions' => array('class' => ''),),'hint' => '',)); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'turnov_tur_id',
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
					'label'=>$model->isNewRecord ? 'Crear TurnosNovedades' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>
