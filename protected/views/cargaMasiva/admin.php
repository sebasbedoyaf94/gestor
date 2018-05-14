<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Carga Masiva';
$this->breadcrumbs=array(
	'Carga Masiva'=>array('index'),
	'Cargas Masivas',
);

?>

<div class="row text-center">
	<h1>Cargas Masivas</h1>
</div>

<div class="row text-center">
	<div class="row">
		<!-- TURNOS -->
		<?php if (!empty(Yii::app()->session['permisosRol']['CargaMasiva'])): ?>
			<a href="turnos" class="col-xs-12 col-sm-6">
				<h4>Turnos</h4>
				<img src="<?php echo Yii::app()->baseUrl.'/images/turnos.png'; ?>" class="img-responsive img-thumbnail img-menu well" alt=''/>
			</a>
		<?php endif ?>

		<!-- ASESORES -->
		<?php if (!empty(Yii::app()->session['permisosRol']['CargaMasiva'])): ?>
			<a href="asesores" class="col-xs-12 col-sm-6">
				<h4>Asesores</h4>
				<img src="<?php echo Yii::app()->baseUrl.'/images/asesores.png'; ?>" class="img-responsive img-thumbnail img-menu well" alt=''/>
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

