<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Carga Masiva';
$this->breadcrumbs=array(
	'Carga Masiva'=>array('index'),
	$model->tur_id=>array('view','id'=>$model->tur_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar CargaMasiva','url'=>array('index')),
	array('label'=>'Crear CargaMasiva','url'=>array('create')),
	array('label'=>'Ver CargaMasiva','url'=>array('view','id'=>$model->tur_id)),
	array('label'=>'Administrar CargaMasiva','url'=>array('admin')),
);
?>

	<h1>Modificar CargaMasiva <?php echo $model->tur_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>