<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity;


use JMS\Serializer\Annotation as Serializer;

/**
 * Class Hash
 * @package HelpPC\ISRS\Entity
 * @Serializer\XmlRoot("hash")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")

 */
class Hash
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlValue
     * @Serializer\XmlElement(cdata=false)
     */
    protected $value;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlAttribute
     * @Serializer\SerializedName("algoritmus")
     */
    protected $algorithm;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    /**
     * @param string $value
     * @return Hash
     */
    public function setValue(string $value): Hash
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $algorithm
     * @return Hash
     */
    public function setAlgorithm(string $algorithm): Hash
    {
        $this->algorithm = $algorithm;
        return $this;
    }


}