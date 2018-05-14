<?php
$this->pageTitle=Yii::app()->name . ' - Ver Novedades';
$this->breadcrumbs=array(
	'Novedades'=>array('index'),
	$model->nov_nombre,
);

$this->menu=array(
array('label'=>'Listar Novedades','url'=>array('index')),
array('label'=>'Crear Novedad','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Novedades']['Crear'])),
array('label'=>'Modificar Novedad','url'=>array('update','id'=>$model->nov_id),'visible'=>!empty(Yii::app()->session['permisosRol']['Novedades']['Modificar'])),
array('label'=>'Administrar Novedades','url'=>array('admin')),
);
?>

<h1>Novedad <?php echo $model->nov_nombre; ?></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del Novedades</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				'nov_nombre',
				'nov_abreviatura',
				'nov_descripcion',
				'nov_paga',
				'nov_habilitado',
				'nov_fechacreado',
				array(
			        'name'=>'nov_creadopor',
			        'value'=>$model->novCreadopor->usua_usuariored,
			    ),
				'nov_fechamodificado',
				array(
			        'name'=>'nov_modificadopor',
			        'value'=>$model->novModificadopor->usua_usuariored,
			    ),
			),
		)); ?>
	</div>
</div>
