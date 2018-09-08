<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class EmpowermentData
 * @package HelpPC\ISRS\Entity
 * @Serializer\XmlRoot("data")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 * @Serializer\AccessorOrder("custom", custom={"principalDataBoxId","agentDataBoxId"})
 */
class EmpowermentData
{

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("zmocnitel")
     */
    protected $principalDataBoxId;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("zmocnenec")
     */
    protected $agentDataBoxId;

    /**
     * @return string
     */
    public function getAgentDataBoxId(): string
    {
        return $this->agentDataBoxId;
    }

    /**
     * @param string $agentDataBoxId
     * @return EmpowermentData
     */
    public function setAgentDataBoxId(string $agentDataBoxId): EmpowermentData
    {
        $this->agentDataBoxId = $agentDataBoxId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrincipalDataBoxId(): string
    {
        return $this->principalDataBoxId;
    }

    /**
     * @param string $principalDataBoxId
     * @return EmpowermentData
     */
    public function setPrincipalDataBoxId(string $principalDataBoxId): EmpowermentData
    {
        $this->principalDataBoxId = $principalDataBoxId;
        return $this;
    }


}