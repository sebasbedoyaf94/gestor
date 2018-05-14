<?php
/* @var $this CargaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cargas',
);

$this->menu=array(
	array('label'=>'Crear Carga', 'url'=>array('create')),
	array('label'=>'Administrar Cargas', 'url'=>array('admin')),
);
?>

<h1>Cargas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
