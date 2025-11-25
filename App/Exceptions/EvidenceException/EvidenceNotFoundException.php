<?php

namespace App\Exceptions\EvidenceException;

use App\Exceptions\BusinessException;

class EvidenceNotFoundException extends BusinessException
{
    public function __construct(string $evidence_id)
    {
        parent::__construct(
            "Evidence with ID $evidence_id not found",
            'EVIDENCE_NOT_FOUND',
            404
        );

        $this->setMeta(['evidence_id' => $evidence_id]);
    }
}