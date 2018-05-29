<?php
/* @var $this UsuariosProyectosController */
/* @var $model UsuariosProyectos */

$this->breadcrumbs=array(
	'Usuarios Proyectos'=>array('index'),
	$model->usuaproy_id,
);

$this->menu=array(
	array('label'=>'Listar Usuarios Proyectos', 'url'=>array('index')),
	array('label'=>'Crear Usuarios Proyectos', 'url'=>array('create')),
	array('label'=>'Administrar Usuarios Proyectos', 'url'=>array('admin')),
);
?>

<h1>Ver proyecto de <?php echo $model->usuaproyUsua->usua_nombre; ?></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información proyecto del analista</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				array(
			        'name'=>'usuaproy_usua_id',
			        'value'=>$model->usuaproyUsua->usua_nombre . " " . $model->usuaproyUsua->usua_apellidos,
			    ),
				array(
			        'name'=>'usuaproy_proy_id',
			        'value'=>$model->usuaproyProy->proy_nombre . " (" . $model->usuaproyProy->proyCli->cli_nombre . ")",
			    ),
			),
		)); ?>
	</div>
</div>
