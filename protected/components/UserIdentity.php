<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{

		//primero se consulta que exista el usuario en la aplicacion (base de datos)
		$model= Usuarios::model()->findByAttributes(
		    array('usua_usuariored'=>$this->username),
		    'usua_habilitado=:usua_habilitado',
		    array(':usua_habilitado'=>'Si')
		);
		
		if (empty($model->attributes)) {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else
		{
			//luego de validar que el usuario existe y esta habilitado, entonces se valida con directorio activo
			$username = $this->username;
			$password = $this->password;

			/* para hacer uso del controlador AutenticacionLdap
			*se debe agregar la siguiente linea en el main.php en el import
			* 'application.controllers.*',
			*/
			$autenticacionLDAP=AutenticacionLdapController::autenticacionDirectorioActivo($username,$password);

			

			if (!$autenticacionLDAP['res']) {
				$this->errorCode=$autenticacionLDAP['error'];
			}
			else{
				$this->errorCode=self::ERROR_NONE;
			}
		}
		
		return !$this->errorCode;
	}
}