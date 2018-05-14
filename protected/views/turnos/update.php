<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Turnos';
$this->breadcrumbs=array(
	'Turnos'=>array('index'),
	$model->tur_nombre=>array('view','id'=>$model->tur_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Turnos','url'=>array('index')),
	array('label'=>'Carga Masiva','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Turnos']['Crear'])),
	array('label'=>'Ver Turno','url'=>array('view','id'=>$model->tur_id)),
	array('label'=>'Administrar Turnos','url'=>array('admin')),
);
?>


	<h1>Modificar Turno <?php echo $model->tur_nombre; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>