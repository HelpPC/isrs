<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Identification
 * @package HelpPC\ISRS\Entity)
 * @Serializer\XmlRoot("identifikator")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class Identification
{

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("idSmlouvy")
     */
    protected $contractId;
    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("idVerze")
     */
    protected $versionId;

    /**
     * @return int
     */
    public function getContractId(): int
    {
        return $this->contractId;
    }

    /**
     * @param int $contractId
     * @return Identification
     */
    public function setContractId(int $contractId): Identification
    {
        $this->contractId = $contractId;
        return $this;
    }

    /**
     * @return int
     */
    public function getVersionId(): int
    {
        return $this->versionId;
    }

    /**
     * @param int $versionId
     * @return Identification
     */
    public function setVersionId(int $versionId): Identification
    {
        $this->versionId = $versionId;
        return $this;
    }

}