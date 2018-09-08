<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Entity\Operation;

use HelpPC\ISRS\IResponse;
use HelpPC\ISRS\ISerializable;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class DisclosureResponse
 * @package HelpPC\ISRS\Entity
 * @Serializer\XmlRoot("odpovedZnepristupneni")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class DisclosureResponse extends AttachmentResponse implements ISerializable, IResponse
{
    public static function getFileDescription(): string
    {
        return 'odpoved_znepristupneni.xml';
    }

    public function getBaseAnnotation(): string
    {
        return 'Znepřístupnění';
    }
}