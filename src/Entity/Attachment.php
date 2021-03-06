<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity;


use JMS\Serializer\Annotation as Serializer;
use HelpPC\Serializer\Utils\SplFileInfo;


/**
 * Class Attachment
 * @package HelpPC\ISRS\Entity)
 * @Serializer\XmlRoot("priloha")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 * @Serializer\AccessorOrder("custom",custom={"name"})
 */
class Attachment
{

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("nazevSouboru")
     */
    protected $name;

    /**
     * @var SplFileInfo
     * @Serializer\Type("base64File")
     * @Serializer\SkipWhenEmpty()
     * @Serializer\Accessor(getter="getFake", setter="setFake")
     */
    protected $binary;

    /**
     * @return null
     * @internal
     */
    public function getFake()
    {
        return null;
    }

    /**
     * @param mixed $fakeProperty
     * @return mixed
     * @internal
     */
    public function setFake($fakeProperty)
    {
        return $fakeProperty;
    }

    /**
     * @return SplFileInfo
     */
    public function getBinary(): SplFileInfo
    {
        return $this->binary;
    }

    /**
     * @param SplFileInfo $binary
     * @return Attachment
     */
    public function setBinary(SplFileInfo $binary): Attachment
    {
        $this->binary = $binary;
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
     * @return Attachment
     */
    public function setName(string $name): Attachment
    {
        $this->name = $name;
        return $this;
    }

}