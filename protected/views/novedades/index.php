<?php
$this->pageTitle=Yii::app()->name . ' - Novedades';
$this->breadcrumbs=array(
	'Novedades',
);

$this->menu=array(
	array('label'=>'Crear Novedad','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Novedades']['Crear'])),
	array('label'=>'Administrar Novedades','url'=>array('admin')),
);
?>

<h1>Novedades</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
