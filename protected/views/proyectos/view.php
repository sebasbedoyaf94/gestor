<?php
/* @var $this ProyectosController */
/* @var $model Proyectos */

$this->breadcrumbs=array(
	'Proyectos'=>array('index'),
	$model->proy_nombre,
);

$this->menu=array(
	array('label'=>'Listar Proyectos', 'url'=>array('index')),
	array('label'=>'Crear Proyectos', 'url'=>array('create')),
	array('label'=>'Actualizar Proyectos', 'url'=>array('update', 'id'=>$model->proy_id)),
	array('label'=>'Administrar Proyectos', 'url'=>array('admin')),
);
?>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del Proyecto</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				'proy_nombre',
				array(
			        'name'=>'proy_cli_id',
			        'value'=>$model->proyCli->cli_nombre,
			    ),
				'proy_fechaInicio',
				'proy_fechaFin',
				'proy_habilitado',
				array(
			        'name'=>'proy_creadopor',
			        'value'=>$model->proyCreadopor->usua_usuariored,
			    ),
				'proy_fechacreado',
			),
		)); ?>
	</div>
</div>
