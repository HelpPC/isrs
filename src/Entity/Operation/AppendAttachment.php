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
 * Class AppendAttachment
 * @package HelpPC\ISRS\Entity\Operation
 * @Serializer\XmlRoot("pridaniPrilohy")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 * @Serializer\AccessorOrder("custom", custom={"contractId","dataMessageId","attachment","confirmationEmail"})
 */
class AppendAttachment implements ISerializable, IRequest
{
    public static function getFileDescription(): string
    {
        return 'pridani_prilohy.xml';
    }

    public function getBaseAnnotation(): string
    {
        return 'Přidání přílohy do smlouvy';
    }

    /**
     * @var int
     * @Serializer\Type("int")
     * @Serializer\SkipWhenEmpty
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("idSmlouvy")
     */
    protected $contractId;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SkipWhenEmpty
     * @Serializer\SerializedName("datovaZprava")
     */
    protected $dataMessageId;
    /**
     * @var ArrayCollection
     * @Serializer\Type("ArrayCollection<HelpPC\ISRS\Entity\Attachment>")
     * @Serializer\XmlList(entry="priloha", inline=false)
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

    public function addAttachment(Attachment $attachment): AppendAttachment
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
     * @return int
     */
    public function getContractId(): int
    {
        return $this->contractId;
    }

    /**
     * @param int $contractId
     * @return AppendAttachment
     */
    public function setContractId(int $contractId): AppendAttachment
    {
        $this->contractId = $contractId;
        return $this;
    }

    /**
     * @return string
     */
    public function getDataMessageId(): string
    {
        return $this->dataMessageId;
    }

    /**
     * @param string $dataMessageId
     * @return AppendAttachment
     */
    public function setDataMessageId(string $dataMessageId): AppendAttachment
    {
        $this->dataMessageId = $dataMessageId;
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
     * @return AppendAttachment
     */
    public function setConfirmationEmail(string $confirmationEmail): AppendAttachment
    {
        $this->confirmationEmail = $confirmationEmail;
        return $this;
    }


}