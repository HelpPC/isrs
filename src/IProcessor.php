<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS;


use HelpPC\ISRS\Exception\XmlDataMismatch;

interface IProcessor
{

    public function getClassName();

    public function setClassName($className);

    public function setXsdName($xsdName);

    /**
     * @param string $parameter
     * @return ISerializable
     * @throws XmlDataMismatch
     */
    public function fromXml(string $parameter);

    /**
     * @param $parameter
     * @return string
     * @throws XmlDataMismatch
     */
    public function toXml($parameter): string;

}