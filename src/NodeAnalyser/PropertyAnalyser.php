<?php

declare(strict_types=1);

namespace Syntro\SilverstripePHPStan\NodeAnalyser;

use PHPStan\Reflection\PropertyReflection;
use function str_contains;

final class PropertyAnalyser
{
    public function isConfigurationProperty(PropertyReflection $property): bool
    {
        if (!$property->isPrivate()) {
            return false;
        }

        if (!$property->isStatic()) {
            return false;
        }

        return !str_contains((string) $property->getDocComment(), '@internal');
    }
}
