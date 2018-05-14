<?php
$this->pageTitle=Yii::app()->name . ' - Usuarios';
$this->breadcrumbs=array(
	'Usuarios',
);

$this->menu=array(
	array(
		'label'=>'Crear Usuario',
		'url'=>array('create'),
		'visible'=>!empty(Yii::app()->session['permisosRol']['Usuarios']['Crear']),
	),
	array('label'=>'Administrar Usuarios','url'=>array('admin')),
);
?>

<h1>Usuarios</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
