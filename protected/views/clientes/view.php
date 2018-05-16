<?php
/* @var $this ClientesController */
/* @var $model Clientes */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->cli_nombre,
);

$this->menu=array(
	array('label'=>'Listar Clientes', 'url'=>array('index')),
	array('label'=>'Crear Clientes', 'url'=>array('create')),
	array('label'=>'Actualizar Clientes', 'url'=>array('update', 'id'=>$model->cli_id)),
	array('label'=>'Administrar Clientes', 'url'=>array('admin')),
);
?>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del Cliente</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				'cli_nombre',
				'cli_habilitado',
			),
		)); ?>
	</div>
</div>

