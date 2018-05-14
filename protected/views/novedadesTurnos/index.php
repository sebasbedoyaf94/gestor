<?php
$this->pageTitle=Yii::app()->name . ' - Novedades Turnos';
$this->breadcrumbs=array(
	'Novedades Turnos',
);

$this->menu=array(
	array('label'=>'Crear NovedadesTurnos','url'=>array('create')),
	array('label'=>'Administrar NovedadesTurnos','url'=>array('admin')),
);
?>

<h1>Novedades Turnos</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
