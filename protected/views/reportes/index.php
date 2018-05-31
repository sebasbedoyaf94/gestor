<?php
/* @var $this ReportesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reportes',
);

$this->menu=array(
	array('label'=>'Create Reportes', 'url'=>array('create')),
	array('label'=>'Manage Reportes', 'url'=>array('admin')),
);
?>

<h1>Reportes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
