<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity\Operation;

use JMS\Serializer\Annotation as Serializer;
use HelpPC\ISRS\Entity\Confirmation;
use HelpPC\ISRS\Entity\ResponseData;

abstract class AttachmentResponse
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("puvodniZprava")
     */
    protected $dataMessageId;

    /**
     * @var ResponseData
     * @Serializer\Type("HelpPC\ISRS\Entity\ResponseData")
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
     * @return AttachmentResponse
     */
    public function setDataMessageId(string $dataMessageId): AttachmentResponse
    {
        $this->dataMessageId = $dataMessageId;
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
     * @return AttachmentResponse
     */
    public function setConfirmation(Confirmation $confirmation): AttachmentResponse
    {
        $this->confirmation = $confirmation;
        return $this;
    }

    /**
     * @return ResponseData
     */
    public function getResponseData(): ResponseData
    {
        return $this->responseData;
    }

    /**
     * @param ResponseData $responseData
     * @return AttachmentResponse
     */
    public function setResponseData(ResponseData $responseData): AttachmentResponse
    {
        $this->responseData = $responseData;
        return $this;
    }

}