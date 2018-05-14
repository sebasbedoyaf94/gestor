<?php
$this->pageTitle=Yii::app()->name . ' - Programas';
$this->breadcrumbs=array(
	'Programas',
);

$this->menu=array(
	array(
		'label'=>'Crear Programa',
		'url'=>array('create'),
		'visible'=>!empty(Yii::app()->session['permisosRol']['Programas']['Crear']),
	),
	array('label'=>'Administrar Programas','url'=>array('admin')),
);
?>

<h1>Programas</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
