<?php
$this->pageTitle=Yii::app()->name . ' - Carga Masiva';
$this->breadcrumbs=array(
	'Carga Masiva',
);

$this->menu=array(
	array('label'=>'Cargar turnos','url'=>array('turnos')),
	array('label'=>'Cargar asesores','url'=>array('asesores')),
	array('label'=>'Administrar CargaMasiva','url'=>array('admin')),
);
?>

<h1>Carga Masiva</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
