<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
    'id'=>'upload-form',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>

<div class="row">
<div class="col-xs-12 col-sm-12">
            <h3 class='subtitulo'>Carga Masiva de Asesores</h3>
        </div>

        <div class="col-xs-12 col-sm-6">
            <?php echo $form->dropDownListGroup($model_servicios, 'serv_id',
                array(
                    'wrapperHtmlOptions' => array(
                        'class' => '',
                    ),
                    'widgetOptions' => array(
                        'data' => CHtml::listData(Servicios::model()->findAll(array("condition"=>"serv_habilitado='Si'")), 'serv_id', function($serv) {
                                return CHtml::encode($serv->serv_nombre.' ('.$serv->servProg->prog_nombre.' - '.$serv->servProg->progCli->cli_nombre.')');
                            }),
                        'htmlOptions' => array(
                            'empty'=>'-- Seleccione un Servicio --',
                        ),
                    ),
                )
            ); ?>
            <?php echo $form->error($model_servicios, 'serv_id');?>
        </div>

    </div>

    <div class="col-xs-12 col-sm-6">
    <br><?php echo $form->fileFieldGroup($model, 'tur_nombre_archivo',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-5',
                ),
            )
        ); ?>
    <?php echo $form->error($model, 'tur_nombre_archivo');?>
    <br>
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
    </div>

<?php $this->endWidget(); ?>