<?php declare(strict_types=1);

namespace HelpPC\Test;

use HelpPC\ISRS\Entity\{Attachment,
    AttachmentHash,
    Confirmation,
    Contract,
    ContractingParty,
    Hash,
    Identification,
    Operation\PublicationResponse,
    ResponseData,
    Subject};
use HelpPC\ISRS\Entity\Operation\Publication;
use HelpPC\ISRS\Exception\XmlDataMismatch;
use HelpPC\ISRS\Manager;
use HelpPC\Serializer\Utils\SplFileInfo;
use Tester\{Assert, Environment, TestCase};

require __DIR__ . '/../vendor/autoload.php';
Environment::setup();
date_default_timezone_set('Europe/Prague');
\Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace(
    'JMS\Serializer\Annotation', __DIR__ . '/../vendor/jms/serializer/src'
);

class PublishTest extends TestCase
{

    /** @var Publication */
    private $publicationEntity;
    /** @var PublicationResponse */
    private $publicationResponseEntity;
    /** @var Manager */
    private $isrsManager;

    private $xmlFileName = 'zverejneni.xml';
    private $xmlResponseFileName = 'zverejneni-smlouvy_response.xml';

    protected function setUp()
    {
        $this->isrsManager = Manager::create();
        $this->isrsManager->setDefaultProcessors();
        $this->publicationEntity = new Publication();

        $this->publicationEntity->setContract((new Contract()));
        $this->publicationEntity->getContract()->setSubject((new Subject()));
        $this->publicationEntity->addAttachment((new Attachment()));
        $this->publicationEntity->addAttachment((new Attachment()));
        $this->publicationEntity->getContract()->getSubject()->setDataBox('unhfjvx');
        $this->publicationEntity->getContract()->setConclusionDate(new \DateTime())
            ->setPriceWithWat(650.0)
            ->setAnnotation('Testovaci smlouva')
            ->addContractingParty((new ContractingParty()));
        $this->publicationEntity->getContract()->getContractingParty()->first()->setName('Pokusný subjekt');
        $this->publicationEntity->getAttachments()->get(0)->setName('testovaciDokument.pdf');
        $this->publicationEntity->getAttachments()->get(1)->setName('testovaciDokument2.pdf');


    }

    public function testPublish()
    {
        $obj = $this;
        $xml = file_get_contents(__DIR__ . '/data/' . $this->xmlFileName);
        $xmlEntity = $this->isrsManager->toXml($this->publicationEntity);
        Assert::type('string', $xmlEntity, 'Konvertovana entita publikace neni string');
        Assert::type('string', $xml, 'Nactena hodnota publikace (xml) neni v poradku');

        Assert::type(Publication::class, $this->isrsManager->getPublicationObject($xml), 'XML se nepodarilo deserializovat na objekt');
        Assert::exception(
            function () use ($obj, $xml) {
                $obj->isrsManager->getErrorObject($xml);

            }, XmlDataMismatch::class
        );
        //otestovani, ze selze XSD validace v pripade, ze neexistuji prilohy
        Assert::exception(
            function () use ($obj) {
                $testException = clone ($obj->publicationEntity);
                $testException->getAttachments()->clear();
                $obj->isrsManager->toXml($testException);
            }, XmlDataMismatch::class);
    }

    public function testPublishResponse()
    {
        $this->publicationResponseEntity = new PublicationResponse();
        $this->publicationResponseEntity->setDataMessageId('6570859');
        $this->publicationResponseEntity->setConfirmation((new Confirmation()));
        $this->publicationResponseEntity->setResponseData((new ResponseData()));
        $this->publicationResponseEntity->getResponseData()->setContract($this->publicationEntity->getContract());
        $this->publicationResponseEntity->getResponseData()->setContractUrl('https://testrs.gov.cz/smlouva/125224')
            ->setPublicationTime(new \DateTime('2018-09-03T20:16:30+02:00'))
            ->setIdentification((new Identification()))
            ->getIdentification()
            ->setContractId(112068)
            ->setVersionId(125224);
        $this->publicationResponseEntity->getConfirmation()
            ->setHash((new Hash()))
            ->setElectronicTag((SplFileInfo::createInTemp('asdasd')))
            ->getHash()
            ->setValue('asdasd')
            ->setAlgorithm('sha256');

        $this->publicationResponseEntity->getResponseData()->getContract()
            ->getSubject()
            ->setName('IS Datové schránky')
            ->setIdentificationNumber('00272663')
            ->setAddress('Na Jízdárně 3025/12, 70200 Ostrava, CZ');

        $this->publicationResponseEntity->getResponseData()
            ->addAttachment((new AttachmentHash()))
            ->addAttachment((new AttachmentHash()));
        $this->publicationResponseEntity->getResponseData()->getAttachments()->get(0)->setName('testovaciDokument.pdf');
        $this->publicationResponseEntity->getResponseData()->getAttachments()->get(0)->setHash((new Hash()));
        $this->publicationResponseEntity->getResponseData()->getAttachments()->get(0)->getHash()
            ->setValue('e8287a2b16380594dd85ab21787bd52bdd08f6b349987c6b38daf6e537773fa3')
            ->setAlgorithm('sha256');
        $this->publicationResponseEntity->getResponseData()->getAttachments()->get(1)->setName('testovaciDokument.pdf');
        $this->publicationResponseEntity->getResponseData()->getAttachments()->get(1)->setHash((new Hash()));
        $this->publicationResponseEntity->getResponseData()->getAttachments()->get(1)->getHash()
            ->setValue('e8287a2b16380594dd85ab21787bd52bdd08f6b349987c6b38daf6e537773fa3')
            ->setAlgorithm('sha256');
        $obj = $this;
        $xml = file_get_contents(__DIR__ . '/data/' . $this->xmlResponseFileName);
        $xmlEntity = $this->isrsManager->toXml($this->publicationResponseEntity);
        Assert::type('string', $xmlEntity, 'Konvertovana entita publikace neni string');
        Assert::type('string', $xml, 'Nactena hodnota publikace (xml) neni v poradku');

        Assert::type(PublicationResponse::class, $this->isrsManager->getPublicationResponseObject($xml), 'XML se nepodarilo deserializovat na objekt');
        Assert::exception(
            function () use ($obj, $xml) {
                $obj->isrsManager->getErrorObject($xml);

            }, XmlDataMismatch::class);
        //otestovani, ze selze XSD validace v pripade, ze neexistuji prilohy
        Assert::exception(
            function () use ($obj) {
                $testException = clone ($obj->publicationResponseEntity);
                $testException->getResponseData()->getAttachments()->clear();
                $obj->isrsManager->toXml($testException);
            }, XmlDataMismatch::class);
    }
}

(new PublishTest())->run();