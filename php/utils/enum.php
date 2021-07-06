<?php

abstract class Enum{

    public const NONE = -1;
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }

    protected static function isValid(Enum $enum = null){
        if(!isset($enum)) return false;
        return $enum != null;
    }

    public function isEqual($value) : bool {
        if(!isset($value)) return false;
        return $this->value == $value;
    }
    
    public abstract static function emptyEnum(Enum $enum = null);

}