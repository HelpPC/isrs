<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS;


use HelpPC\ISRS\Entity\Error;
use HelpPC\ISRS\Exception\FileNotFound;
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
     * @throws FileNotFound
     * @throws XmlDataMismatch
     */
    public function fromXml(string $parameter): ISerializable
    {
        $this->validate($parameter, $this->xsdName);
        return $this->getSerializer()->deserialize($parameter, $this->className, 'xml');
    }

    /**
     * @param ISerializable $parameter
     * @return string
     * @throws FileNotFound
     * @throws XmlDataMismatch
     */
    public function toXml(ISerializable $parameter): string
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
     * @param string $data
     * @param string $fileName
     * @return string
     * @throws FileNotFound
     * @throws XmlDataMismatch
     */
    protected function validate(string $data, $fileName = 'chyba')
    {
        $filePath = dirname(__FILE__) . '/../Resources/' . $fileName . '.xsd';
        if (!file_exists($filePath)) {
            throw new FileNotFound('File (' . $filePath . ') with XSD not found');
        }
        $xml = new \DOMDocument();
        $xml->loadXML($data);
        libxml_use_internal_errors(true);
        $result = $xml->schemaValidate($filePath);
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

    private function libxml_display_error($error)
    {
        $return = null;
        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $return .= "Warning $error->code: ";
                break;
            case LIBXML_ERR_ERROR:
                $return .= "Error $error->code: ";
                break;
            case LIBXML_ERR_FATAL:
                $return .= "Fatal Error $error->code: ";
                break;
        }
        $return .= trim($error->message);
        if ($error->file) {
            $return .= " in $error->file";
        }
        $return .= " on line #$error->line" . PHP_EOL;

        return $return;
    }
}