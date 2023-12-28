<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{
    /**
     * Check value is null.
     * @throws EntityValidationException
     */
    public static function notNull(
        string      $value,
        string|null $exceptMessage = null
    ): void
    {
        if (empty($value)) {
            throw new EntityValidationException($exceptMessage ?? 'Should not be empty!');
        }
    }
}
