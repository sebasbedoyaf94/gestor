<?php
$this->pageTitle=Yii::app()->name . ' - Crear Novedades Turnos';
$this->breadcrumbs=array(
	'Novedades Turnos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar NovedadesTurnos','url'=>array('index')),
	array('label'=>'Administrar NovedadesTurnos','url'=>array('admin')),
);
?>

<h1>Crear NovedadesTurnos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>