<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-19 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

abstract class NF_Validate_Core
{

  public $value;

  public $messages = array();

  public $breakIfInvalid = true;

  public $breakIfValid = false;

  public function __construct(array $options=array())
  {
    foreach ($options as $key => $value) {
      $method = 'set'.ucfirst($key);
      if (method_exists($this, $method)) {
        $this->$method($value);
      } else {
        $this->$key = $value;
      }
    }
  }

  public function getMessages()
  {
    return $this->messages;
  }

  protected function _addMessage()
  {
    $args = func_get_args();
    if (count($args) > 0) {
      $args[0] = str_replace('{value}', (string) $this->value, $args[0]);
    }
    $message = @call_user_func_array('sprintf', $args);
    if ($message === FALSE) {
      $message = 'Unsuccessfully validation. Error not set.';
    }
    $this->messages[] = $message;
  }

  public function setValue($value)
  {
    $this->value    = $value;
    $this->messages = array();
  }

  abstract public function isValid($value);
}
nf_loadclass('NF_Validate_Core');

class SGN_ValidateChain extends NF_Validate_Core
{
  protected $validators = array();

  protected $validate;

  public $code;

  public $message;


  public function add($code, $message, $validate, $args=array())
  {
    $this->validators[$code] = array(
      'message' => $message,
      'validate' => $validate,
      'args' => $args);
    return $this;
  }

  public function reset()
  {
    $this->validators = array();
    $this->validate = null;
    $this->messages = array();
    return $this;
  }

  public function isValid($value)
  {
    if (empty($this->validators)) {
      return true;
    }
    foreach ($this->validators as $code => $element) {
      // reset the code
      $this->code = '';

      $validateClass = $element['validate'];
      nf_loadclass($validateClass);
      $reflection = new ReflectionClass($validateClass);
      if (!$reflection->isInstantiable()) {
        require_once 'NF/Validate/Exception.php';
        throw new NF_Validate_Exception("'$validateClass' class not instantiable");
      }
      if (count($element['args']) == 0) {
        $this->validate = $reflection->newInstance();
      } else {
        $this->validate = $reflection->newInstanceArgs(array($element['args']));
      }
      if ($this->validate->isValid($value) === false) {
        foreach ($this->validate->getMessages() as $message) {
          $this->_addMessage($message);
        }
        if ($this->validate->breakIfInvalid) {
          $this->code = $code;
          $this->message = $element['message'];
          break;
        }
      } else {
        if ($this->validate->breakIfValid) {
          break;
        }
      }
    }
    return empty($this->code);
  }

}
