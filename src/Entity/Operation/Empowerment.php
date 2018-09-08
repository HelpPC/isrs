<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity\Operation;

use HelpPC\ISRS\Entity\Agent;
use HelpPC\ISRS\IRequest;
use HelpPC\ISRS\ISerializable;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Empowerment
 * @package HelpPC\ISRS\Entity\Operation
 * @Serializer\XmlRoot("zmocneni")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class Empowerment implements ISerializable, IRequest
{
    public static function getFileDescription(): string
    {
        return 'zmocneni.xml';
    }

    public function getBaseAnnotation(): string
    {
        return 'Zmocnění';
    }

    /**
     * @var Agent
     * @Serializer\Type("HelpPC\ISRS\Entity\Agent")
     * @Serializer\XmlElement(namespace="http://portal.gov.cz/rejstriky/ISRS/1.2/")
     * @Serializer\SerializedName("noveZmocneni")
     */
    protected $agent;
    /**
     * @var string
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("emailProPotvrzeni")
     * @Serializer\SkipWhenEmpty
     * @Serializer\Type("string")
     */
    protected $confirmationEmail;

    /**
     * @return Agent
     */
    public function getAgent(): Agent
    {
        return $this->agent;
    }

    /**
     * @param Agent $agent
     * @return Empowerment
     */
    public function setAgent(Agent $agent): Empowerment
    {
        $this->agent = $agent;
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
     * @return Empowerment
     */
    public function setConfirmationEmail(string $confirmationEmail): Empowerment
    {
        $this->confirmationEmail = $confirmationEmail;
        return $this;
    }


}