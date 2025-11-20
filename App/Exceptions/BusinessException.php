<?php
namespace App\Exceptions;

class BusinessException extends \Exception
{
    protected string $errorCode;
    protected ?int $httpStatus;
    protected array $meta = [];

    public function __construct(string $message, string $errorCode = 'BUSINESS_ERROR', ?int $httpStatus = 400)
    {
        parent::__construct($message);
        $this->errorCode = $errorCode;
        $this->httpStatus = $httpStatus;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    public function getHttpStatus(): ?int
    {
        return $this->httpStatus;
    }

    public function setMeta(array $meta): self
    {
        $this->meta = $meta;
        return $this;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }
}
