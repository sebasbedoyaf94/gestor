<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'asesores-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información del Asesor</h3>
		</div>

		<div class="col-xs-12 col-sm-4">
			<?php echo $form->textFieldGroup($model,'ase_usuariored',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-4">
			<?php echo $form->textFieldGroup($model,'ase_nombre',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-4">
			<?php echo $form->textFieldGroup($model,'ase_apellidos',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>
		
		<div class="col-xs-12 col-sm-6">
			<?php echo $form->textFieldGroup($model,'ase_identificacion',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'ase_cont_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Contratos::model()->findAll(array("condition"=>"cont_habilitado='Si'")), 'cont_id', 'cont_total_horas_semana'),
						'htmlOptions' => array(
							'empty'=>'-- Selecciona un Contrato --',
						),
					),
				)
			); ?>
		</div>


		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'ase_lider', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'ase_habilitado', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'ase_identificacion_lider',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Asesores::model()->findAll(array("condition"=>"ase_lider='Si'")), 'ase_identificacion', 'ase_nombre'),
						'htmlOptions' => array(
							'empty'=>'-- Selecciona un Lider --',
						),
					),
				)
			); ?>
		</div>


		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Horario del Asesor</h3>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaInicioLunes',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaFinLunes',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaInicioMartes',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaFinMartes',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaInicioMiercoles',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaFinMiercoles',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaInicioJueves',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaFinJueves',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaInicioViernes',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaFinViernes',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaInicioSabado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaFinSabado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaInicioDomingo',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>

			<div class="col-xs-12 col-sm-6">
				<?php echo $form->textFieldGroup($model,'ase_horaFinDomingo',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
			</div>
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
					'label'=>$model->isNewRecord ? 'Crear Asesor' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>
