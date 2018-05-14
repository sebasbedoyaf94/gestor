<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<h1>Bienvenido a <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<div class="row text-center">
	<div class="row">
		<!-- USUARIOS -->
		<?php if (!empty(Yii::app()->session['permisosRol']['Usuarios'])): ?>
			<a href="../usuarios/admin" class="col-xs-12 col-sm-3">
				<h4>Usuarios</h4>
				<img src="<?php echo Yii::app()->baseUrl.'/images/usuarios.png'; ?>" class="img-responsive img-thumbnail img-menu well" alt=''/>
			</a>
		<?php endif ?>

		<!-- ROLES -->
		<?php if (!empty(Yii::app()->session['permisosRol']['Roles'])): ?>
			<a href="../roles/admin" class="col-xs-12 col-sm-3">
				<h4>Roles</h4>
				<img src="<?php echo Yii::app()->baseUrl.'/images/roles.png'; ?>" class="img-responsive img-thumbnail img-menu well" alt=''/>
			</a>
		<?php endif ?>

		<!-- CLIENTES -->
		<?php if (!empty(Yii::app()->session['permisosRol']['Clientes'])): ?>	
			<a href="../clientes/admin" class="col-xs-12 col-sm-3">
				<h4>Clientes</h4>
				<img src="<?php echo Yii::app()->baseUrl.'/images/clientes.png'; ?>" class="img-responsive img-thumbnail img-menu well" alt=''/>
			</a>
		<?php endif ?>
	</div>

	<div class="row">
		<!-- PROYECTOS -->
		<?php if (!empty(Yii::app()->session['permisosRol']['Contratos'])): ?>	
			<a href="../contratos/admin" class="col-xs-12 col-sm-3">
				<h4>Proyectos</h4>
				<img src="<?php echo Yii::app()->baseUrl.'/images/contratos.png'; ?>" class="img-responsive img-thumbnail img-menu well" alt=''/>
			</a>
		<?php endif ?>

		<!-- ANALISTAS PROYECTOS -->
		<?php if (!empty(Yii::app()->session['permisosRol']['Programas'])): ?>	
			<a href="../programas/admin" class="col-xs-12 col-sm-3">
				<h4>Analistas Proyectos</h4>
				<img src="<?php echo Yii::app()->baseUrl.'/images/programas.png'; ?>" class="img-responsive img-thumbnail img-menu well" alt=''/>
			</a>
		<?php endif ?>

		<!-- DOCUMENTACIONES -->
		<?php if (!empty(Yii::app()->session['permisosRol']['Novedades'])): ?>	
			<a href="../cargaMasiva/admin" class="col-xs-12 col-sm-3">
				<h4>Documentación</h4>
				<img src="<?php echo Yii::app()->baseUrl.'/images/novedades.png'; ?>" class="img-responsive img-thumbnail img-menu well" alt=''/>
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