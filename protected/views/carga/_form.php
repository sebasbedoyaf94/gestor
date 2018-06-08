<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
    'id'=>'upload-form',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>

<div class="row">
	<div class="col-xs-12 col-sm-12">
        <h3 class='subtitulo'>Carga Masiva</h3>
    </div>

    <div class="col-xs-12 col-sm-6">
        <?php echo $form->dropDownListGroup($model, 'carga_proy_id',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => '',
                ),
                'widgetOptions' => array(
                    'data' => CHtml::listData(Proyectos::model()->findAll(array("condition"=>"proy_habilitado='Si'")), 'proy_id', function($proy) {
                                return CHtml::encode($proy->proy_nombre . " (" . $proy->proyCli->cli_nombre.")");
                            }),
                    'htmlOptions' => array(
                        'empty'=>'-- Seleccione un Proyecto --',
                    ),
                ),
            )
        ); ?>
    </div>

    <div class="col-xs-12 col-sm-6">
        <?php echo $form->dropDownListGroup($model, 'carga_fase',
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

    <div class="col-xs-12 col-sm-12">
		<?php echo $form->textAreaGroup($model,'carga_descripcion', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'')))); ?>
	</div>
</div>

<div class="col-xs-12 col-sm-6">
    <br><?php echo $form->fileFieldGroup($model, 'carga_nombre_archivo',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-5',
                ),
            )
        ); ?>
    <?php echo $form->error($model, 'carga_nombre_archivo');?>
    <br>
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

