<?php


class Activity{

    private $_name;
    private $_environement;

    /**
     * Activity constructor.
     * @param $_name
     * @param $_environement
     */
    public function __construct($_name, $_environement)
    {
        $this->_name = $_name;
        $this->_environement = $_environement;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getEnvironement()
    {
        return $this->_environement;
    }

    /**
     * @param mixed $environement
     */
    public function setEnvironement($environement)
    {
        $this->_environement = $environement;
    }



}