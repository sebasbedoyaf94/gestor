<?php
/* @var $this CargaController */
/* @var $model Carga */

$this->breadcrumbs=array(
	'Cargas'=>array('index'),
	$model->carga_id,
);

$this->menu=array(
	array('label'=>'Listar Cargas', 'url'=>array('index')),
	array('label'=>'Crear Carga', 'url'=>array('create')),
	array('label'=>'Administrar Cargas', 'url'=>array('admin')),
);
?>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información de la carga</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				'carga_nombre_archivo',
				array(
					'name'=>'carga_proy_id',
					'value'=>$model->cargaProy->proy_nombre,
				),
				'carga_fase',
				'carga_descripcion',
				array(
					'name'=>'carga_creadopor',
					'value'=>$model->cargaCreadopor->usua_usuariored,
				),
				'carga_fechacreado',
				array(
					'name'=>'carga_modificadopor',
					'value'=>$model->cargaModificadopor->usua_usuariored,
				),
				'carga_fechamodificado',
			),
		)); ?>
	</div>
</div>

