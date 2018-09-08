<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity\Operation;


use Doctrine\Common\Collections\ArrayCollection;
use HelpPC\ISRS\Entity\Attachment;
use HelpPC\ISRS\Entity\Contract;
use HelpPC\ISRS\IRequest;
use HelpPC\ISRS\ISerializable;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Modification
 * @package HelpPC\ISRS\Entity\Operation
 * @Serializer\XmlRoot("modifikace")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class Modification implements ISerializable, IRequest
{
    public static function getFileDescription(): string
    {
        return 'modifikace.xml';
    }

    public function getBaseAnnotation(): string
    {
        return 'Modifikace smlouvy';
    }

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("idSmlouvy")
     */
    protected $contractId;
    /**
     * @var Contract
     * @Serializer\Type("HelpPC\ISRS\Entity\Contract")
     * @Serializer\XmlElement(namespace="http://portal.gov.cz/rejstriky/ISRS/1.2/")
     * @Serializer\SerializedName("smlouva")
     */
    protected $contract;
    /**
     * @var ArrayCollection
     * @Serializer\Type("ArrayCollection<HelpPC\ISRS\Entity\Attachment>")
     * @Serializer\XmlList(entry="priloha", inline=false, skipWhenEmpty=false)
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("prilohy")
     */
    protected $attachment;
    /**
     * @var string
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("emailProPotvrzeni")
     * @Serializer\SkipWhenEmpty
     * @Serializer\Type("string")
     */
    protected $confirmationEmail;

    public function __construct()
    {
        $this->attachment = new ArrayCollection();
    }

    public function addAttachment(Attachment $attachment): Modification
    {
        if (!$this->getAttachments()->contains($attachment)) {
            $this->getAttachments()->add($attachment);
        }
        return $this;
    }

    public function getAttachments(): ArrayCollection
    {
        return $this->attachment;
    }

    /**
     * @return Contract
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * @param mixed $contract
     * @return Modification
     */
    public function setContract($contract)
    {
        $this->contract = $contract;
        return $this;
    }

    /**
     * @return string
     */
    public function getConfirmationEmail(): string
    {
        return $this->confirmationEmail;
    }

    /**
     * @param string $confirmationEmail
     * @return Modification
     */
    public function setConfirmationEmail(string $confirmationEmail): Modification
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
     * @return Modification
     */
    public function setContractId(int $contractId): Modification
    {
        $this->contractId = $contractId;
        return $this;
    }


}