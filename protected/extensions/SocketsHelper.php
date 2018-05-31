<?php

/** Clase cliente para los Socket Servers usados en Allus
  @author: Tito Suarez Buitrago
  @version: 1.0
 */
class SocketsHelper {

  var $strHost = NULL;
  var $intPort = NULL;
  var $bolAutoinit = FALSE;
  private $resSocket = NULL;
  private $resLink = NULL;
  var $intMaxBytesToReceibe = 1024;

  public function __construct($arrParams)
  {

    if (is_array($arrParams)) {
      foreach ($arrParams as $key => $val) {
        $this->$key = $val;
      }
    }

    if ($this->bolAutoinit === TRUE) {
      $this->init();
    }
  }

  public function init()
  {

    if ( ! function_exists("socket_create")) {
      throw new Exception("No se encuentra la extension Sockets");
    }

    $this->resSocket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

    if ($this->resSocket === false) {
      throw new Exception("Error al crear Socket");
    }

    $arrTimeout = array("sec" => 30, "usec" => 0);

    socket_set_option($this->resSocket, SOL_SOCKET, SO_SNDTIMEO, $arrTimeout);
    socket_set_option($this->resSocket, SOL_SOCKET, SO_RCVTIMEO, $arrTimeout);
  }

  public function connect()
  {

    if ( ! is_resource($this->resSocket)) {
      $this->init();
    }

    @socket_bind($this->resSocket, $this->strHost, $this->intPort);

    $this->resLink = @socket_connect($this->resSocket, $this->strHost, $this->intPort);

    if ($this->resLink === FALSE) {
      throw new Exception("Error al conectar al Socket");
    }
  }

  public function sendData($strData)
  {

    if ( ! is_resource($this->resLink)) {
      $this->connect();
    }


    $intBytesSend = @socket_write($this->resSocket, $strData);

    if ($intBytesSend === FALSE) {
      throw new Exception("Error al enviar los Datos al Socket: " . socket_last_error($this->resSocket) . " - " . socket_strerror(socket_last_error($this->resSocket)), socket_last_error($this->resSocket));
    }
	
	//echo $intBytesSend;die;
  }

  public function getData()
  {

    $strResponse = @socket_read($this->resSocket, $this->intMaxBytesToReceibe, PHP_BINARY_READ);

    if ($strResponse === FALSE) {
      throw new Exception("Error al recibir los datos del Socket: " . utf8_encode(socket_strerror(socket_last_error($this->resSocket))), socket_last_error($this->resSocket));
    }

    return $strResponse;
  }

  public function sendAndReceive($strData)
  {

    $this->sendData($strData);
    $strResp = $this->getData();

    return $strResp;
  }

  public function typifySoftphone($strCode, $arrData)
  {

    // Crea un string separado por comas agregando el código de la empresa antes de cada dato
    if (is_array($arrData) && ! empty($arrData)) {
      foreach ($arrData as $index => $strValue) {
        $arrData[$index] = $strCode . $strValue;
      }
    }

    $strData = '108,' . implode(',', $arrData) . ',~';

    $this->sendData($strData);
  }

}
