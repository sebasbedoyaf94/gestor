<?php
$this->pageTitle=Yii::app()->name . ' - Turnos Servicios';
$this->breadcrumbs=array(
	'Turnos Servicios',
);

$this->menu=array(
	array('label'=>'Crear Turno Servicio','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['TurnosServicios']['Crear']),),
	array('label'=>'Administrar Turnos Servicios','url'=>array('admin')),
);
?>

<h1>Turnos Servicios</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
