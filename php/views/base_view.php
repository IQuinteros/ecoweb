<?php

abstract class BaseView
{

    public function __construct()
    {
        return $this->htmlContent();
    }

    abstract protected function htmlContent();

    public function __toString()
    {
        return $this->htmlContent();
    }

}