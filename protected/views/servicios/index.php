<?php
$this->pageTitle=Yii::app()->name . ' - Servicios';
$this->breadcrumbs=array(
	'Servicios',
);

$this->menu=array(
	array(
		'label'=>'Crear Servicio',
		'url'=>array('create'),
		'visible'=>!empty(Yii::app()->session['permisosRol']['Servicios']['Crear']),
	),
	array('label'=>'Administrar Servicios','url'=>array('admin')),
);
?>

<h1>Servicios</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
