<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'reportes-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		
		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'rep_proy_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => '',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Proyectos::model()->findAll(array("condition"=>"proy_habilitado='Si'")), 'proy_id', 'proy_nombre'),
						'htmlOptions' => array(
							'empty'=>'-- Selecciona un Proyecto --',
						),
					),
				)
			); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
	        <?php echo $form->dropDownListGroup($model, 'rep_fase',
	            array(
	                'wrapperHtmlOptions' => array(
	                    'class' => '',
	                ),
	                'widgetOptions' => array(
	                	'data' => array(
	                		'DISEÑO E IMPLENTACION'=>'DISEÑO E IMPLENTACIÓN',
	                        'GESTION DEL ENTORNO'=>'GESTIÓN DEL ENTORNO',
	                        'EJECUCION DE LAS PRUEBAS'=>'EJECUCIÓN DE LAS PRUEBAS',
	                        'INFORME DE INCIDENCIAS'=>'INFORME DE INCIDENCIAS',
	                	),
	                    'htmlOptions' => array(
	                        'empty'=>'-- Seleccione una Fase --',
	                    ),
	                ),
	            )
	        ); ?>
    	</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->datePickerGroup($model,'rep_fechaInicio',array('widgetOptions'=>array('options'=>array('format'=>'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->datePickerGroup($model,'rep_fechaFin',array('widgetOptions'=>array('options'=>array('format'=>'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
	        <?php echo $form->dropDownListGroup($model, 'rep_tipo',
	            array(
	                'wrapperHtmlOptions' => array(
	                    'class' => '',
	                ),
	                'widgetOptions' => array(
	                	'data' => array(
	                		'1'=>'Cargas',
	                        '2'=>'Checklists',
	                	),
	                    'htmlOptions' => array(
	                        'empty'=>'-- Seleccione un Tipo --',
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
					'label'=>$model->isNewRecord ? 'Generar Reporte' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>