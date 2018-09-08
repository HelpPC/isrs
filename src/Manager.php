<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS;

use HelpPC\ISRS\Entity\Error;
use HelpPC\ISRS\Entity\Operation\AppendAttachment;
use HelpPC\ISRS\Entity\Operation\AppendAttachmentResponse;
use HelpPC\ISRS\Entity\Operation\CancelEmpowerment;
use HelpPC\ISRS\Entity\Operation\CancelEmpowermentResponse;
use HelpPC\ISRS\Entity\Operation\Disclosure;
use HelpPC\ISRS\Entity\Operation\DisclosureResponse;
use HelpPC\ISRS\Entity\Operation\Empowerment;
use HelpPC\ISRS\Entity\Operation\EmpowermentResponse;
use HelpPC\ISRS\Entity\Operation\Modification;
use HelpPC\ISRS\Entity\Operation\ModificationResponse;
use HelpPC\ISRS\Entity\Operation\Publication;
use HelpPC\ISRS\Entity\Operation\PublicationResponse;
use HelpPC\ISRS\Exception\UnknownProcessor;
use HelpPC\Serializer\SerializerFactory;
use JMS\Serializer\Serializer;


class Manager
{

    /** @var Serializer */
    private $serializer;

    private $processors = [];

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }


    public function addProcessor(IProcessor $processor)
    {
        $this->processors[$processor->getClassName()] = $processor;
    }

    public function setDefaultProcessors()
    {
        foreach ([
                     Error::class => 'chyba',
                     AppendAttachmentResponse::class => 'odpoved_pridani_prilohy',
                     AppendAttachment::class => 'operace_pridani_prilohy',
                     CancelEmpowermentResponse::class => 'odpoved_zruseni_zmocneni',
                     CancelEmpowerment::class => 'operace_zruseni_zmocneni',
                     DisclosureResponse::class => 'odpoved_znepristupneni',
                     Disclosure::class => 'operace_znepristupneni',
                     EmpowermentResponse::class => 'odpoved_zmocneni',
                     Empowerment::class => 'operace_zmocneni',
                     ModificationResponse::class => 'odpoved_modifikace',
                     Modification::class => 'operace_modifikace',
                     PublicationResponse::class => 'odpoved_zverejneni',
                     Publication::class => 'operace_zverejneni',
                 ] as $className => $xsd) {
            $this->addProcessor((new Processor($this->serializer))->setClassName($className)->setXsdName($xsd));
        }
    }

    /**
     * @param ISerializable $obj
     * @return string
     * @throws UnknownProcessor
     */
    public function toXml(ISerializable $obj): string
    {
        if (isset($this->processors[get_class($obj)])) {
            return $this->processors[get_class($obj)]->toXml($obj);
        }
        throw new UnknownProcessor();
    }

    /**
     * @param string $xml
     * @return Error
     * @throws UnknownProcessor
     */
    public function getErrorObject(string $xml): Error
    {
        /** @var Error $response */
        $response = $this->fromXml($xml, Error::class);
        return $response;
    }

    /**
     * @param string $xml
     * @return AppendAttachmentResponse
     * @throws UnknownProcessor
     */
    public function getAppendAttachmentResponseObject(string $xml): AppendAttachmentResponse
    {
        /** @var AppendAttachmentResponse $response */
        $response = $this->fromXml($xml, AppendAttachmentResponse::class);
        return $response;
    }

    /**
     * @param string $xml
     * @return AppendAttachmentResponse
     * @throws UnknownProcessor
     */
    public function getAppendAttachmentObject(string $xml): AppendAttachmentResponse
    {
        /** @var AppendAttachmentResponse $response */
        $response = $this->fromXml($xml, AppendAttachment::class);
        return $response;
    }

    /**
     * @param string $xml
     * @return CancelEmpowermentResponse
     * @throws UnknownProcessor
     */
    public function getCancelEmpowermentResponseObject(string $xml): CancelEmpowermentResponse
    {
        /** @var CancelEmpowermentResponse $response */
        $response = $this->fromXml($xml, CancelEmpowermentResponse::class);
        return $response;
    }

    /**
     * @param string $xml
     * @return CancelEmpowerment
     * @throws UnknownProcessor
     */
    public function getCancelEmpowermentObject(string $xml): CancelEmpowerment
    {
        /** @var CancelEmpowerment $response */
        $response = $this->fromXml($xml, CancelEmpowerment::class);
        return $response;
    }

    /**
     * @param string $xml
     * @return DisclosureResponse
     * @throws UnknownProcessor
     */
    public function getDisclosureResponseObject(string $xml): DisclosureResponse
    {
        /** @var DisclosureResponse $response */
        $response = $this->fromXml($xml, DisclosureResponse::class);
        return $response;
    }

    /**
     * @param string $xml
     * @return Disclosure
     * @throws UnknownProcessor
     */
    public function getDisclosureObject(string $xml): Disclosure
    {
        /** @var Disclosure $response */
        $response = $this->fromXml($xml, Disclosure::class);
        return $response;
    }

    /**
     * @param string $xml
     * @return EmpowermentResponse
     * @throws UnknownProcessor
     */
    public function getEmpowermentResponseObject(string $xml): EmpowermentResponse
    {
        /** @var EmpowermentResponse $response */
        $response = $this->fromXml($xml, EmpowermentResponse::class);
        return $response;
    }

    /**
     * @param string $xml
     * @return Empowerment
     * @throws UnknownProcessor
     */
    public function getEmpowermentObject(string $xml): Empowerment
    {
        /** @var Empowerment $response */
        $response = $this->fromXml($xml, Empowerment::class);
        return $response;
    }

    /**
     * @param string $xml
     * @return ModificationResponse
     * @throws UnknownProcessor
     */
    public function getModificationResponseObject(string $xml): ModificationResponse
    {
        /** @var ModificationResponse $response */
        $response = $this->fromXml($xml, ModificationResponse::class);
        return $response;
    }

    /**
     * @param string $xml
     * @return Modification
     * @throws UnknownProcessor
     */
    public function getModificationObject(string $xml): Modification
    {
        /** @var Modification $response */
        $response = $this->fromXml($xml, Modification::class);
        return $response;
    }

    /**
     * @param string $xml
     * @return PublicationResponse
     * @throws UnknownProcessor
     */
    public function getPublicationResponseObject(string $xml): PublicationResponse
    {
        /** @var PublicationResponse $response */
        $response = $this->fromXml($xml, PublicationResponse::class);
        return $response;
    }

    /**
     * @param string $xml
     * @return Publication
     * @throws UnknownProcessor
     */
    public function getPublicationObject(string $xml): Publication
    {
        /** @var Publication $response */
        $response = $this->fromXml($xml, Publication::class);
        return $response;
    }

    /**
     * @param string $obj
     * @param string $objName
     * @return ISerializable
     * @throws UnknownProcessor
     */
    public function fromXml(string $obj, string $objName): ISerializable
    {
        if (in_array(ISerializable::class, class_implements($objName))) {
            return $this->processors[$objName]->fromXml($obj);
        }
        throw new UnknownProcessor();
    }

    /**
     * @return Manager
     */
    public static function create(): Manager
    {
        return new static(
            SerializerFactory::create()
        );
    }
}