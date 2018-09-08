<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ContractingParty
 * @package HelpPC\ISRS\Entity
 * @Serializer\XmlRoot("smluvniStrana")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class ContractingParty
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
     * 1=recipient; 0=payer
     * @var bool
     * @Serializer\Type("bool")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("prijemce")
     */
    private $recipient;

    /**
     * @return string
     */
    public function getDataBox(): string
    {
        return $this->dataBox;
    }

    /**
     * @param string $dataBox
     * @return ContractingParty
     */
    public function setDataBox(string $dataBox): ContractingParty
    {
        $this->dataBox = $dataBox;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ContractingParty
     */
    public function setName(string $name): ContractingParty
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentificationNumber(): string
    {
        return $this->identificationNumber;
    }

    /**
     * @param string $identificationNumber
     * @return ContractingParty
     */
    public function setIdentificationNumber(string $identificationNumber): ContractingParty
    {
        $this->identificationNumber = $identificationNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return ContractingParty
     */
    public function setAddress(string $address): ContractingParty
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return ContractingParty
     */
    public function setUnit(string $unit): ContractingParty
    {
        $this->unit = $unit;
        return $this;
    }

    public function isRecipient(): bool
    {
        return $this->recipient === true;
    }

    public function setRecipient(): ContractingParty
    {
        $this->recipient = true;
        return $this;
    }

    public function isPayer(): bool
    {
        return $this->recipient === false;
    }

    public function setPayer(): ContractingParty
    {
        $this->recipient = false;
        return $this;
    }
}