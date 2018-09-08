<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;

class ResponseData
{

    /**
     * @var Identification
     * @Serializer\Type("HelpPC\ISRS\Entity\Identification")
     * @Serializer\SerializedName("identifikator")
     */
    protected $identification;
    /**
     * @var string|null
     * @Serializer\Type("string")
     * @Serializer\SkipWhenEmpty
     * @Serializer\SerializedName("odkaz")
     * @Serializer\XmlElement(cdata=false)
     */
    protected $contractUrl;
    /**
     * @var \DateTime|null
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:sP','Europe/Prague'>")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SkipWhenEmpty
     * @Serializer\SerializedName("casZverejneni")
     */
    protected $publicationTime;
    /**
     * @var Contract
     * @Serializer\Type("HelpPC\ISRS\Entity\Contract")
     * @Serializer\XmlElement(namespace="http://portal.gov.cz/rejstriky/ISRS/1.2/")
     * @Serializer\SerializedName("smlouva")
     */
    protected $contract;
    /**
     * @var ArrayCollection
     * @Serializer\Type("ArrayCollection<HelpPC\ISRS\Entity\AttachmentHash>")
     * @Serializer\XmlList(entry="priloha", inline=false)
     * @Serializer\SerializedName("prilohy")
     */
    protected $attachment;

    public function __construct()
    {
        $this->attachment = new ArrayCollection();
    }

    public function addAttachment(AttachmentHash $attachment): ResponseData
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
     * @return Identification
     */
    public function getIdentification(): Identification
    {
        return $this->identification;
    }

    /**
     * @param Identification $identification
     * @return ResponseData
     */
    public function setIdentification(Identification $identification): ResponseData
    {
        $this->identification = $identification;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getContractUrl(): ?string
    {
        return $this->contractUrl;
    }

    /**
     * @param null|string $contractUrl
     * @return ResponseData
     */
    public function setContractUrl(?string $contractUrl): ResponseData
    {
        $this->contractUrl = $contractUrl;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getPublicationTime(): ?\DateTime
    {
        return $this->publicationTime;
    }

    /**
     * @param \DateTime|null $publicationTime
     * @return ResponseData
     */
    public function setPublicationTime(?\DateTime $publicationTime): ResponseData
    {
        $this->publicationTime = $publicationTime;
        return $this;
    }

    /**
     * @return Contract
     */
    public function getContract(): Contract
    {
        return $this->contract;
    }

    /**
     * @param Contract $contract
     * @return ResponseData
     */
    public function setContract(Contract $contract): ResponseData
    {
        $this->contract = $contract;
        return $this;
    }

}