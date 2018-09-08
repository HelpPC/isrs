<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity\Operation;


use HelpPC\ISRS\Entity\Confirmation;
use HelpPC\ISRS\Entity\EmpowermentData;
use HelpPC\ISRS\IResponse;
use HelpPC\ISRS\ISerializable;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class CancelEmpowermentResponse
 * @package HelpPC\ISRS\Entity
 * @Serializer\XmlRoot("odpovedZruseniZmocneni")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class CancelEmpowermentResponse implements ISerializable, IResponse
{
    public static function getFileDescription(): string
    {
        return 'odpoved_zruseni_zmocneni.xml';
    }

    public function getBaseAnnotation(): string
    {
        return 'Zrušení zmocnění';
    }

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("puvodniZprava")
     */
    protected $dataMessageId;
    /**
     * @var EmpowermentData
     * @Serializer\Type("HelpPC\ISRS\Entity\EmpowermentData")
     * @Serializer\XmlElement(namespace="http://portal.gov.cz/rejstriky/ISRS/1.2/")
     * @Serializer\SerializedName("data")
     */
    protected $responseData;
    /**
     * @var Confirmation
     * @Serializer\Type("HelpPC\ISRS\Entity\Confirmation")
     * @Serializer\XmlElement(namespace="http://portal.gov.cz/rejstriky/ISRS/1.2/")
     * @Serializer\SerializedName("potvrzeni")
     */
    protected $confirmation;

    /**
     * @return string
     */
    public function getDataMessageId(): string
    {
        return $this->dataMessageId;
    }

    /**
     * @param string $dataMessageId
     * @return CancelEmpowermentResponse
     */
    public function setDataMessageId(string $dataMessageId): CancelEmpowermentResponse
    {
        $this->dataMessageId = $dataMessageId;
        return $this;
    }

    /**
     * @return EmpowermentData
     */
    public function getResponseData(): EmpowermentData
    {
        return $this->responseData;
    }

    /**
     * @param EmpowermentData $responseData
     * @return CancelEmpowermentResponse
     */
    public function setResponseData(EmpowermentData $responseData): CancelEmpowermentResponse
    {
        $this->responseData = $responseData;
        return $this;
    }

    /**
     * @return Confirmation
     */
    public function getConfirmation(): Confirmation
    {
        return $this->confirmation;
    }

    /**
     * @param Confirmation $confirmation
     * @return CancelEmpowermentResponse
     */
    public function setConfirmation(Confirmation $confirmation): CancelEmpowermentResponse
    {
        $this->confirmation = $confirmation;
        return $this;
    }


}