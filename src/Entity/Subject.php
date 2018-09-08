<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity;


use JMS\Serializer\Annotation as Serializer;

/**
 * Class Subject
 * @package HelpPC\ISRS\Entity\Operation
 * @Serializer\XmlRoot("subjekt")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class Subject
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("datovaSchranka")
     */
    private $dataBox;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("nazev")
     */
    private $name;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("ico")
     */
    private $identificationNumber;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("adresa")
     */
    private $address;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("utvar")
     */
    private $unit;
    /**
     * @var bool
     * @Serializer\Type("bool")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("platce")
     */
    private $payer;

    /**
     * @return string
     */
    public function getDataBox()
    {
        return $this->dataBox;
    }

    /**
     * @param string $dataBox
     * @return Subject
     */
    public function setDataBox($dataBox)
    {
        $this->dataBox = $dataBox;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Subject
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentificationNumber()
    {
        return $this->identificationNumber;
    }

    /**
     * @param string $identificationNumber
     * @return Subject
     */
    public function setIdentificationNumber($identificationNumber)
    {
        $this->identificationNumber = $identificationNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Subject
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return Subject
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPayer()
    {
        return $this->payer;
    }

    /**
     * @param bool $payer
     * @return Subject
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
        return $this;
    }


}