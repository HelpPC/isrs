<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity;

use HelpPC\ISRS\IResponse;
use HelpPC\ISRS\ISerializable;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Error
 * @package HelpPC\ISRS\Entity\Operation
 * @Serializer\XmlRoot("chyba")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class Error implements ISerializable, IResponse
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("puvodniZprava")
     */
    protected $dataMessageId;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("kodChyby")
     */
    protected $errorCode;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("chybovyText")
     */
    protected $errorMessage;

    /**
     * @return string
     */
    public function getDataMessageId(): string
    {
        return $this->dataMessageId;
    }

    /**
     * @param string $dataMessageId
     * @return Error
     */
    public function setDataMessageId(string $dataMessageId): Error
    {
        $this->dataMessageId = $dataMessageId;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    /**
     * @param string $errorCode
     * @return Error
     */
    public function setErrorCode(string $errorCode): Error
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     * @return Error
     */
    public function setErrorMessage(string $errorMessage): Error
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }


    public function getBaseAnnotation(): string
    {
        return 'Chyba';
    }

    public static function getFileDescription(): string
    {
        return 'chyba.xml';
    }

}