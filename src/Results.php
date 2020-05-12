<?php


namespace SIGA;


class Results extends \ArrayObject
{

    public function __construct($input = array(), $flags = 0, $iterator_class = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iterator_class);
    }

}
