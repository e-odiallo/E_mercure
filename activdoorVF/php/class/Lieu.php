<?php


class Lieu{

    private $_latitude;
    private $_longitude;
    private $_nomVille;
    private $_pays;

    /**
     * Lieu constructor.
     * @param $_latitude
     * @param $_longitude
     * @param $_nomVille
     * @param $_pays
     */
    public function __construct($_latitude, $_longitude, $_nomVille, $_pays)
    {
        $this->_latitude = $_latitude;
        $this->_longitude = $_longitude;
        $this->_nomVille = $_nomVille;
        $this->_pays = $_pays;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->_latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->_latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->_longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->_longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getNomVille()
    {
        return $this->_nomVille;
    }

    /**
     * @param mixed $nomVille
     */
    public function setNomVille($nomVille)
    {
        $this->_nomVille = $nomVille;
    }

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->_pays;
    }

    /**
     * @param mixed $pays
     */
    public function setPays($pays)
    {
        $this->_pays = $pays;
    }




}