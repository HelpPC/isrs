<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity\Operation;


use Doctrine\Common\Collections\ArrayCollection;
use HelpPC\ISRS\Entity\Contract;
use HelpPC\ISRS\IRequest;
use HelpPC\ISRS\ISerializable;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Disclosure
 * @package HelpPC\ISRS\Entity\Operation
 * @Serializer\XmlRoot("znepristupneni")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class Disclosure implements ISerializable, IRequest
{
    public static function getFileDescription(): string
    {
        return 'znepristupneni.xml';
    }

    public function getBaseAnnotation(): string
    {
        return 'Znepřístupnění';
    }

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("idSmlouvy")
     */
    protected $contractId;
    /**
     * @var string
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("emailProPotvrzeni")
     * @Serializer\SkipWhenEmpty
     * @Serializer\Type("string")
     */
    protected $confirmationEmail;

    /**
     * @return string
     */
    public function getConfirmationEmail(): string
    {
        return $this->confirmationEmail;
    }

    /**
     * @param string $confirmationEmail
     * @return Disclosure
     */
    public function setConfirmationEmail(string $confirmationEmail): Disclosure
    {
        $this->confirmationEmail = $confirmationEmail;
        return $this;
    }

    /**
     * @return int
     */
    public function getContractId(): int
    {
        return $this->contractId;
    }

    /**
     * @param int $contractId
     * @return Disclosure
     */
    public function setContractId(int $contractId): Disclosure
    {
        $this->contractId = $contractId;
        return $this;
    }


}