<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 03/04/2015
 * Time: 13:56
 */

namespace MattCannon\Collections\Exceptions;


use Exception;

class InvalidTypeException extends Exception{
    /**
     * @var null
     */
    private $type;
    /**
     * @var null
     */
    private $object;
    /**
     * @var null
     */
    private $key;

    /**
     * @param string $message
     * @param null $type
     * @param null $object
     * @param null $key
     * @param int $code
     * @param Exception $previous
     */
    public function __construct($message = "",$type= null,$object = null,$key = null, $code = 0, Exception $previous = null)
    {
        
        parent::__construct($message, $code, $previous);
        $this->type = $type;
        $this->object = $object;
        $this->key = $key;
    }

}