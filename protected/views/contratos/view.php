<?php
$this->pageTitle=Yii::app()->name . ' - Ver Contratos';
$this->breadcrumbs=array(
	'Contratos'=>array('index'),
	$model->cont_total_horas_semana." horas Semana",
);

$this->menu=array(
	array('label'=>'Listar Contratos','url'=>array('index')),
	array('label'=>'Crear Contrato','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Contratos']['Crear'])),
	array('label'=>'Modificar Contrato','url'=>array('update','id'=>$model->cont_id),'visible'=>!empty(Yii::app()->session['permisosRol']['Contratos']['Modificar'])),
	array('label'=>'Administrar Contratos','url'=>array('admin')),
);
?>

<h1>Contrato de <?php echo $model->cont_total_horas_semana; ?> horas semana.</h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del Contrato</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				'cont_total_horas_semana',
				'cont_min_horas_dia',
				'cont_max_horas_dia',
				'cont_habilitado',
				'cont_fechacreado',
				array(
			        'name'=>'cont_creadopor',
			        'value'=>$model->contCreadopor->usua_usuariored,
			    ),
				'cont_fechamodificado',
				array(
			        'name'=>'cont_modificadopor',
			        'value'=>$model->contModificadopor->usua_usuariored,
			    ),
			),
		)); ?>
	</div>
</div>
