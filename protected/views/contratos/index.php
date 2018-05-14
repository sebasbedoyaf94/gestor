<?php
$this->pageTitle=Yii::app()->name . ' - Contratos';
$this->breadcrumbs=array(
	'Contratos',
);

$this->menu=array(
	array(
		'label'=>'Crear Contrato',
		'url'=>array('create'),
		'visible'=>!empty(Yii::app()->session['permisosRol']['Contratos']['Crear']),
	),
	array('label'=>'Administrar Contratos','url'=>array('admin')),
);
?>

<h1>Contratos</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
