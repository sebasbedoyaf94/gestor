<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Documentaciones';
$this->breadcrumbs=array(
	'Carga Masiva'=>array('index'),
	'Cargas Masivas',
);

?>

<div class="row text-center">
	<h1>Módulo de Documentación</h1>
</div>

<div class="row text-center">
	<div class="row">
		<!-- CARGA -->
		<?php if (!empty(Yii::app()->session['permisosRol']['CargaMasiva'])): ?>
			<a href="../carga/admin" class="col-xs-12 col-sm-6">
				<h4>Carga</h4>
				<img src="<?php echo Yii::app()->baseUrl.'/images/turnos.png'; ?>" class="img-responsive img-thumbnail img-menu well" alt=''/>
			</a>
		<?php endif ?>

		<!-- CHECKLIST -->
		<?php if (!empty(Yii::app()->session['permisosRol']['CargaMasiva'])): ?>
			<a href="../checklist/admin" class="col-xs-12 col-sm-6">
				<h4>Checklist</h4>
				<img src="<?php echo Yii::app()->baseUrl.'/images/contratos.png'; ?>" class="img-responsive img-thumbnail img-menu well" alt=''/>
			</a>
		<?php endif ?>

	</div>

</div>

<style type="text/css">
	.img-menu{
		max-height: 200px !important;
		max-width: 200px !important;
	}
</style>

