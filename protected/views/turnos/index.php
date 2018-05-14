<?php
$this->pageTitle=Yii::app()->name . ' - Turnos';
$this->breadcrumbs=array(
	'Turnos',
);

$this->menu=array(
	array('label'=>'Administrar Turnos','url'=>array('admin')),
);
?>

<h1>Turnos</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
