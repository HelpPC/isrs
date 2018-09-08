<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity;


use JMS\Serializer\Annotation as Serializer;

/**
 * Class Currency
 * @package HelpPC\ISRS\Entity\Operation
 * @Serializer\XmlRoot("ciziMena")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class Currency
{
    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("hodnota")
     */
    protected $amount;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("mena")
     */
    protected $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Currency
     */
    public function setName(string $name): Currency
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Currency
     */
    public function setAmount(float $amount): Currency
    {
        $this->amount = $amount;
        return $this;
    }


}