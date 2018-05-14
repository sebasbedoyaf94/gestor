<?php
$this->pageTitle=Yii::app()->name . ' - Turnos Novedades';
$this->breadcrumbs=array(
	'Turnos Novedades',
);

$this->menu=array(
	array('label'=>'Crear Turno Novedad','url'=>array('create'), 'visible'=>!empty(Yii::app()->session['permisosRol']['TurnosNovedades']['Crear']),),
	array('label'=>'Administrar Turnos Novedades','url'=>array('admin')),
);
?>

<h1>Turnos Novedades</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
