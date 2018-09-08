<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\ISRS\Exception;


use HelpPC\ISRS\Entity\Error;
use Throwable;

class ErrorResponse extends \Exception
{

    /** @var Error */
    private $errorEntity;

    /**
     * ErrorResponse constructor.
     * @param Error $error
     */
    public function __construct(Error $error)
    {
        $this->errorEntity = $error;
        parent::__construct($error->getErrorMessage(), intval($error->getErrorCode()));
    }
}