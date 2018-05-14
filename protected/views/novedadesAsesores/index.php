<?php
$this->pageTitle=Yii::app()->name . ' - Novedades Asesores';
$this->breadcrumbs=array(
	'Novedades Asesores',
);

$this->menu=array(
	array('label'=>'Crear Novedad Asesor','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['NovedadesAsesores']['Crear']),),
	array('label'=>'Administrar Novedades Asesores','url'=>array('admin')),
);
?>

<h1>Novedades Asesores</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
