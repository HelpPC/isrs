<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS;


use HelpPC\ISRS\Entity\Error;
use HelpPC\ISRS\Exception\XmlDataMismatch;
use JMS\Serializer\Serializer;

class Processor implements IProcessor
{
    private $xsdName = 'Error';
    private $className = Error::class;
    /** @var Serializer */
    private $serializer;

    public function getClassName()
    {
        return $this->className;
    }

    public function setClassName($className)
    {
        $this->className = $className;
        return $this;
    }

    public function setXsdName($xsdName)
    {
        $this->xsdName = $xsdName;
        return $this;
    }

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param string $parameter
     * @return ISerializable
     * @throws XmlDataMismatch
     */
    public function fromXml(string $parameter): ISerializable
    {
        $this->validate($parameter, $this->xsdName);
        return $this->getSerializer()->deserialize($parameter, $this->className, 'xml');
    }

    /**
     * @param $parameter
     * @return string
     * @throws XmlDataMismatch
     */
    public function toXml($parameter): string
    {
        return $this->validate($this->getSerializer()->serialize($parameter, 'xml'), $this->xsdName);
    }


    /**
     * @return Serializer
     */
    protected function getSerializer(): Serializer
    {
        return $this->serializer;
    }

    /**
     * @param $data
     * @param string $fileName
     * @return mixed
     * @throws XmlDataMismatch
     */
    protected function validate($data, $fileName = 'chyba')
    {
        $xml = new \DOMDocument();
        $xml->loadXML($data);
        libxml_use_internal_errors(true);
        $result = $xml->schemaValidate(dirname(__FILE__) . '/../Resources/' . $fileName . '.xsd');
        $allErrors = libxml_get_errors();
        libxml_use_internal_errors(false);
        if (!$result) {
            $errors = [];
            foreach ($allErrors as $error) {
                $errors[] = $this->libxml_display_error($error);
            }
            if (sizeof($errors) > 0) {
                throw new XmlDataMismatch(implode('. ', $errors));
            }

        }
        return $data;
    }

    function libxml_display_error($error)
    {
        $return = "<br/>\n";
        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $return .= "<b>Warning $error->code</b>: ";
                break;
            case LIBXML_ERR_ERROR:
                $return .= "<b>Error $error->code</b>: ";
                break;
            case LIBXML_ERR_FATAL:
                $return .= "<b>Fatal Error $error->code</b>: ";
                break;
        }
        $return .= trim($error->message);
        if ($error->file) {
            $return .= " in <b>$error->file</b>";
        }
        $return .= " on line <b>$error->line</b>\n";

        return $return;
    }
}