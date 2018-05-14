<div class="form">

<?php $form = $this->beginWidget(
	'CActiveForm',
	array(
		'id' => 'upload-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
	)
); ?>

	<div class="col-xs-12 col-sm-6">
		<?php echo $form->labelEx($model,'carga_proy_id'); ?>
		<?php //echo $form->dropDownList($model_proyectos,'proy_id', CHtml::listData(Proyectos::model()->findAll(array("condition"=>"proy_habilitado='Si'")), 'proy_id','proy_name'), array('class' => 'form-control')); ?>
		<?php echo $form->dropDownList($model,'carga_proy_id', array(''=>'','1'=>'SALDOS','2'=>'TARJETAS')); ?>
		<?php echo $form->error($model,'carga_proy_id'); ?>
	</div>

	<div class="col-xs-12 col-sm-6">
		<?php echo $form->labelEx($model,'carga_fase'); ?>
		<?php echo $form->dropDownList($model,'carga_fase', array(''=>'','DISEÑO E IMPLEMENTACION'=>'DISEÑO E IMPLEMENTACIÓN','GESTION DEL ENTORNO'=>'GESTIÓN DEL ENTORNO','EJECUCION DE LAS PRUEBAS'=>'EJECUCIÓN DE LAS PRUEBAS','INFORME DE INCIDENCIAS'=>'INFORME DE INCIDENCIAS')); ?>
		<?php echo $form->error($model,'carga_fase'); ?>
	</div>

	<div class="col-xs-12 col-sm-6">
		<?php echo $form->labelEx($model,'carga_descripcion'); ?>
		<?php echo $form->textField($model,'carga_descripcion'); ?>
		<?php echo $form->error($model,'carga_descripcion'); ?>
	</div>

	<div class="col-xs-12 col-sm-6">
		<?php echo $form->labelEx($model,'carga_nombre_archivo'); ?>
		<?php echo $form->fileField($model,'carga_nombre_archivo'); ?>
		<?php echo $form->error($model, 'carga_nombre_archivo'); ?>
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
                'label'=> 'Cargar Archivo',
            )); ?>
    </div>
</div>

<?php $this->endWidget(); ?>

</div>