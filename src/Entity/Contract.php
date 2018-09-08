<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Contract
 * @package HelpPC\ISRS\Entity
 * @Serializer\XmlRoot("smlouva")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class Contract
{
    /**
     * @var Subject
     * @Serializer\Type("HelpPC\ISRS\Entity\Subject")
     * @Serializer\SerializedName("subjekt")
     * @Serializer\XmlElement(namespace="http://portal.gov.cz/rejstriky/ISRS/1.2/")
     */
    private $subject;

    /**
     * @var ArrayCollection
     * @Serializer\Type("ArrayCollection<HelpPC\ISRS\Entity\ContractingParty>")
     * @Serializer\XmlList(entry="smluvniStrana", inline=true)
     * @Serializer\SerializedName("smluvniStrana")
     */
    private $contractingParty;


    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("predmet")
     */
    protected $annotation;
    /**
     * @var \DateTime
     * @Serializer\Type("DateTime<'Y-m-d'>")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("datumUzavreni")
     */
    protected $conclusionDate;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("cisloSmlouvy")
     */
    protected $contractNumber;
    /**
     * @var string|null
     * @Serializer\SkipWhenEmpty
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("schvalil")
     */
    protected $approved;
    /**
     * @var float|null
     * @Serializer\SkipWhenEmpty
     * @Serializer\Type("float")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("hodnotaBezDph")
     */
    protected $priceWithoutWat;
    /**
     * @var float|null
     * @Serializer\SkipWhenEmpty
     * @Serializer\Type("float")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("hodnotaVcetneDph")
     */
    protected $priceWithWat;
    /**
     * @var Currency
     * @Serializer\Type("HelpPC\ISRS\Entity\Currency")
     * @Serializer\XmlElement(namespace="http://portal.gov.cz/rejstriky/ISRS/1.2/")
     * @Serializer\SerializedName("ciziMena")
     */
    protected $currency;
    /**
     * @var int|null
     * @Serializer\SkipWhenEmpty()
     * @Serializer\Type("int")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("navaznyZaznam")
     */
    protected $followUpRecord;

    public function __construct()
    {
        $this->contractingParty = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getAnnotation(): string
    {
        return $this->annotation;
    }

    /**
     * @param string $annotation
     * @return Contract
     */
    public function setAnnotation(string $annotation): Contract
    {
        $this->annotation = $annotation;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getConclusionDate(): \DateTime
    {
        return $this->conclusionDate;
    }

    /**
     * @param \DateTime $conclusionDate
     * @return Contract
     */
    public function setConclusionDate(\DateTime $conclusionDate): Contract
    {
        $this->conclusionDate = $conclusionDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getContractNumber(): string
    {
        return $this->contractNumber;
    }

    /**
     * @param string $contractNumber
     * @return Contract
     */
    public function setContractNumber(string $contractNumber): Contract
    {
        $this->contractNumber = $contractNumber;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getApproved(): ?string
    {
        return $this->approved;
    }

    /**
     * @param null|string $approved
     * @return Contract
     */
    public function setApproved(?string $approved): Contract
    {
        $this->approved = $approved;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceWithoutWat(): ?float
    {
        return $this->priceWithoutWat;
    }

    /**
     * @param float|null $priceWithoutWat
     * @return Contract
     */
    public function setPriceWithoutWat(?float $priceWithoutWat): Contract
    {
        $this->priceWithoutWat = $priceWithoutWat;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceWithWat(): ?float
    {
        return $this->priceWithWat;
    }

    /**
     * @param float|null $priceWithWat
     * @return Contract
     */
    public function setPriceWithWat(?float $priceWithWat): Contract
    {
        $this->priceWithWat = $priceWithWat;
        return $this;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * @param Currency $currency
     * @return Contract
     */
    public function setCurrency(Currency $currency): Contract
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getFollowUpRecord(): ?int
    {
        return $this->followUpRecord;
    }

    /**
     * @param int|null $followUpRecord
     * @return Contract
     */
    public function setFollowUpRecord(?int $followUpRecord): Contract
    {
        $this->followUpRecord = $followUpRecord;
        return $this;
    }


    public function addContractingParty(ContractingParty $contractingParty)
    {
        if (!$this->contractingParty->contains($contractingParty)) {
            $this->contractingParty->add($contractingParty);
        }
        return $this;
    }


    /**
     * @param Subject $subject
     * @return $this
     */
    public function setSubject(Subject $subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getContractingParty(): ArrayCollection
    {
        return $this->contractingParty;
    }

    /**
     * @return Subject
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }


}