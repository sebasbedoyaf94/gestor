<?php
$this->pageTitle=Yii::app()->name . ' - Ver Programas';
$this->breadcrumbs=array(
	'Programas'=>array('index'),
	$model->prog_nombre." (".$model->progCli->cli_nombre.")",
);

$this->menu=array(
	array('label'=>'Listar Programas','url'=>array('index')),
	array('label'=>'Crear Programa','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Programas']['Crear'])),
	array('label'=>'Modificar Programa','url'=>array('update','id'=>$model->prog_id),'visible'=>!empty(Yii::app()->session['permisosRol']['Programas']['Modificar'])),
	array('label'=>'Administrar Programas','url'=>array('admin')),
);
?>

<h1>Programa <?php echo $model->prog_nombre." (".$model->progCli->cli_nombre.")"; ?></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del Programa</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				array(
			        'name'=>'prog_cli_id',
			        'value'=>$model->progCli->cli_nombre,
			    ),
				'prog_nombre',
				'prog_descripcion',
				'prog_habilitado',
				'prog_fechacreado',
				array(
			        'name'=>'prog_creadopor',
			        'value'=>$model->progCreadopor->usua_usuariored,
			    ),
				'prog_fechamodificado',
				array(
			        'name'=>'prog_modificadopor',
			        'value'=>$model->progModificadopor->usua_usuariored,
			    ),
			),
		)); ?>
	</div>
</div>
