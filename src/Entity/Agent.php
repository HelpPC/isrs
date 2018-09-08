<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Empowerment
 * @package HelpPC\ISRS\Entity\Operation)
 * @Serializer\XmlRoot("zmocneni")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class Agent
{

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("zmocnenec")
     */
    protected $dataBoxId;

    /**
     * @return string
     */
    public function getDataBoxId(): string
    {
        return $this->dataBoxId;
    }

    /**
     * @param string $dataBoxId
     * @return Agent
     */
    public function setDataBoxId(string $dataBoxId): Agent
    {
        $this->dataBoxId = $dataBoxId;
        return $this;
    }


}