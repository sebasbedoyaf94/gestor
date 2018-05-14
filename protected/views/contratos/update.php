<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Contrato';
$this->breadcrumbs=array(
	'Contratos'=>array('index'),
	$model->cont_total_horas_semana." horas Semana."=>array('view','id'=>$model->cont_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Contratos','url'=>array('index')),
	array('label'=>'Crear Contrato','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Contratos']['Crear'])),
	array('label'=>'Ver Contrato','url'=>array('view','id'=>$model->cont_id)),
	array('label'=>'Administrar Contratos','url'=>array('admin')),
);
?>

	<h1>Modificar Contrato de <?php echo $model->cont_total_horas_semana; ?> horas semana.</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>