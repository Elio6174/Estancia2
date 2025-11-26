<?php
class DuplicateEmailException extends Exception {
    public function __construct($message = "El correo ya esta en uso", $code = 0, Exception $previous = null){
        parent::__construct($message, $code, $previous);
    }
}