<?php
$this->pageTitle=Yii::app()->name . ' - Asesores Servicios';
$this->breadcrumbs=array(
	'Asesores Servicios',
);

$this->menu=array(
	array('label'=>'Crear Asesor Servicio','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['AsesoresServicios']['Crear']),),
	array('label'=>'Administrar Asesores Servicios','url'=>array('admin')),
);
?>

<h1>Asesores Servicios</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
