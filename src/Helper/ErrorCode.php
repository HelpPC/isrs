<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Helper;


class ErrorCode
{

    public static function getErrors()
    {
        return [
            1 => 'nenalezena operace',
            2 => 'chyba XSD validace',
            3 => 'selhání kontroly zadané datové schránky v datech XML vůči ISDS',
            4 => 'chyba konzistence odkazovaných příloh smluv',
            5 => 'nepodporovaný typ přílohy smlouvy',
            6 => 'odkaz na neexistující smlouvu (při přidání přílohy nebo modifikaci smlouvy)',
            7 => 'pokus o manipulaci se znepřístupněnou smlouvou',
            8 => 'neplatné zmocnění',
            9 => 'pokus o zadání duplikujícího (aktuálně platného) zmocnění',
            10 => 'odkaz na neexistující ID datové zprávy (má význam pro operaci přidání přílohy, pokud se příloha odkazuje srze ID datové zprávy)',
            11 => 'odkazovaná datová zpráva v ISRS existuje, ale neodkazuje na publikovanou smlouvu (má význam pro operaci přidání přílohy, pokud se příloha odkazuje srze ID datové zprávy)',
        ];
    }

    public static function getErrorMsg(int $errorCode)
    {
        return self::getErrors()[$errorCode];
    }

}