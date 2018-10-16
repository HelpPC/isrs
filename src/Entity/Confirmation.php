<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use HelpPC\Serializer\Utils\SplFileInfo;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Confirmation
 * @package HelpPC\ISRS\Entity
 * @Serializer\XmlRoot("potvzeni")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class Confirmation
{
    /**
     * @var Hash
     * @Serializer\Type("HelpPC\ISRS\Entity\Hash")
     */
    protected $hash;
    /**
     * @var SplFileInfo
     * @Serializer\Type("base64File")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("elektronickaZnacka")
     */
    protected $electronicTag;
    /**
     * @var ArrayCollection
     * @Serializer\Type("ArrayCollection<string>")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\XmlList(entry="text", inline=false)
     * @Serializer\SerializedName("informace")
     */
    protected $information;

    public function __construct()
    {
        $this->information = new ArrayCollection();
    }

    /**
     * @return Hash
     */
    public function getHash(): Hash
    {
        return $this->hash;
    }

    /**
     * @return SplFileInfo
     */
    public function getElectronicTag(): SplFileInfo
    {
        return $this->electronicTag;
    }

    /**
     * @return ArrayCollection
     */
    public function getInformation(): ArrayCollection
    {
        return $this->information;
    }

    /**
     * @param Hash $hash
     * @return Confirmation
     */
    public function setHash(Hash $hash): Confirmation
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @param SplFileInfo $electronicTag
     * @return Confirmation
     */
    public function setElectronicTag(SplFileInfo $electronicTag): Confirmation
    {
        $this->electronicTag = $electronicTag;
        return $this;
    }

    public function addInformation(string $information): Confirmation
    {
        $this->information->add($information);
        return $this;
    }


}