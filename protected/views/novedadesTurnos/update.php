<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Novedades Turnos';
$this->breadcrumbs=array(
	'Novedades Turnos'=>array('index'),
	$model->novtur_id=>array('view','id'=>$model->novtur_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar NovedadesTurnos','url'=>array('index')),
	array('label'=>'Crear NovedadesTurnos','url'=>array('create')),
	array('label'=>'Ver NovedadesTurnos','url'=>array('view','id'=>$model->novtur_id)),
	array('label'=>'Administrar NovedadesTurnos','url'=>array('admin')),
);
?>

	<h1>Modificar NovedadesTurnos <?php echo $model->novtur_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>