<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity;


use JMS\Serializer\Annotation as Serializer;

/**
 * Class AttachmentHash
 * @package HelpPC\ISRS\Entity)
 * @Serializer\XmlRoot("priloha")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 * @Serializer\AccessorOrder("custom", custom={"hash","name"})
 */
class AttachmentHash extends Attachment
{
    /**
     * @var Hash
     * @Serializer\Type("HelpPC\ISRS\Entity\Hash")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("hash")
     */
    protected $hash;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("nazevSouboru")
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
     * @return Attachment
     */
    public function setName(string $name): Attachment
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Hash
     */
    public function getHash(): Hash
    {
        return $this->hash;
    }

    /**
     * @param Hash $hash
     * @return AttachmentHash
     */
    public function setHash(Hash $hash): AttachmentHash
    {
        $this->hash = $hash;
        return $this;
    }


}