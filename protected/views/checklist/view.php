<?php
/* @var $this ChecklistController */
/* @var $model Checklist */

$this->breadcrumbs=array(
	'Checklists'=>array('index'),
	$model->check_id,
);

$this->menu=array(
	array('label'=>'Listar Checklist', 'url'=>array('index')),
	array('label'=>'Crear Checklist', 'url'=>array('create')),
	array('label'=>'Actualizar Checklist', 'url'=>array('update', 'id'=>$model->check_id)),
	array('label'=>'Administrar Checklist', 'url'=>array('admin')),
);
?>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del Checklist</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				array(
					'name'=>'check_proy_id',
					'value'=>$model->checkProy->proy_nombre,
				),
				'check_url_pruebas',
				'check_ruta_doc_funcional',
				'check_ruta_doc_tecnica',
				'check_observaciones',
				'check_usuario_pruebas',
				'check_contrasena_pruebas',
				array(
					'name'=>'check_creadopor',
					'value'=>$model->checkCreadopor->usua_usuariored,
				),
				'check_fechacreado',
				array(
					'name'=>'check_modificadopor',
					'value'=>$model->checkModificadopor->usua_usuariored,
				),
				'check_fechamodificado',
			),
		)); ?>
	</div>
</div>
