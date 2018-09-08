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
 * Class ModificationResponse
 * @package HelpPC\ISRS\Entity
 * @Serializer\XmlRoot("odpovedModifikace")
 * @Serializer\XmlNamespace("http://portal.gov.cz/rejstriky/ISRS/1.2/")
 */
class ModificationResponse extends AttachmentResponse implements ISerializable, IResponse
{
    public static function getFileDescription(): string
    {
        return 'odpoved_modifikace.xml';
    }

    public function getBaseAnnotation(): string
    {
        return 'Modifikace smlouvy';
    }
}