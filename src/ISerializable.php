<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS;


interface ISerializable
{

    public static function getFileDescription(): string;

    public function getBaseAnnotation(): string;
}