<?php
$this->pageTitle=Yii::app()->name . ' - Administrar CargaMasiva';
$this->breadcrumbs=array(
	'Carga Masiva'=>array('index'),
	'Carga Masiva Asesores',
);

$this->menu=array(
	array('label'=>'Carga Masiva Turnos','url'=>array('turnos')),
	array('label'=>'Carga Masiva Asesores','url'=>array('asesores')),
);

?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'carga-masiva-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>

<?php // Stacked pills
    $this->widget(
        'booster.widgets.TbTabs',
        array(
            'type' => 'pills', // 'tabs' or 'pills'
            'tabs' => array(
                array(
                    'label' => 'Asesores creados correctamente (' . $asesores . ')',
                    'content' => $mensaje_asesor,
                ),
                array(
                    'label' => 'Asesores actualizados correctamente (' . $asesores_act . ')',
                    'content' => $mensaje_act,
                ),
                array(
                	'label' => 'Errores (' . $errores . ')', 
                	'content' => $error,
                ),
            ),
        )
    );
?>

<?php $this->endWidget(); ?>





