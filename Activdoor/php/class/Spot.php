<?php


class Spot{

    private $_idSpot;
    private $_nom;
    private $_description;
    private $_latitude;
    private $_longitude;
    private $_ville;
    private $_paysCode;
    private $_type;

    /**
     * Spot constructor.
     * @param $_idSpot
     * @param $_nom
     * @param $_description
     * @param $_latitude
     * @param $_longitude
     * @param $_ville
     * @param $_paysCode
     * @param $_type
     */
    public function __construct($_idSpot, $nom, $_description, $_latitude, $_longitude, $_ville, $_paysCode, $_type){
        $this->_idSpot = $_idSpot;
        $this->_nom = $nom;
        $this->_description = $_description;
        $this->_latitude = $_latitude;
        $this->_longitude = $_longitude;
        $this->_ville = $_ville;
        $this->_paysCode = $_paysCode;
        $this->_type = $_type;
    }

    /**
     * @return mixed
     */
    public function getIdSpot()
    {
        return $this->_idSpot;
    }

    /**
     * @param mixed $idSpot
     */
    public function setIdSpot($idSpot)
    {
        $this->_idSpot = $idSpot;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->_nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->_nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
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
    public function getVille()
    {
        return $this->_ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->_ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getPaysCode()
    {
        return $this->_paysCode;
    }

    /**
     * @param mixed $paysCode
     */
    public function setPaysCode($paysCode)
    {
        $this->_paysCode = $paysCode;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->_type = $type;
    }


    public function toJson(){
        $json = array("idSpot"=>$this->_idSpot,
            "nom"=>$this->_nom,
            "description"=>$this->_description,
            "latitude"=>$this->_latitude,
            "longitude"=>$this->_longitude,
            "ville"=>$this->_ville,
            "paysCode"=>$this->_paysCode,
            "type"=>$this->_type);

        return json_encode($json);
    }


}

