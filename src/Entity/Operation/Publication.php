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
 * Class Publication
 * @package HelpPC\ISRS\Entity\Operation
 * @Serializer\XmlRoot("zverejneni")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class Publication implements ISerializable, IRequest
{
    public static function getFileDescription(): string
    {
        return 'zverejneni.xml';
    }

    public function getBaseAnnotation(): string
    {
        return 'Zveřejnění smlouvy';
    }

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

    public function addAttachment(Attachment $attachment): Publication
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
     * @return Publication
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
     * @return Publication
     */
    public function setConfirmationEmail(string $confirmationEmail): Publication
    {
        $this->confirmationEmail = $confirmationEmail;
        return $this;
    }


}