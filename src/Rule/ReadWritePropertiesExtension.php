<?php

namespace Syntro\SilverstripePHPStan\Rule;

use PHPStan\Reflection\PropertyReflection;
use Syntro\SilverstripePHPStan\NodeAnalyser\ClassAnalyser;
use Syntro\SilverstripePHPStan\NodeAnalyser\PropertyAnalyser;

/**
 * Adds information about configuration properties, which are always read,
 * written and initialized.
 *
 * We check for private static properties as described in the official silverstripe docs (https://docs.silverstripe.org/en/5/developer_guides/configuration/configuration/#configuration-properties).
 */
final class ReadWritePropertiesExtension implements \PHPStan\Rules\Properties\ReadWritePropertiesExtension
{
    public function __construct(
        private readonly ClassAnalyser $classAnalyser,
        private readonly PropertyAnalyser $propertyAnalyser
    ) {
    }

    /**
     * isAlwaysRead - see https://phpstan.org/developing-extensions/always-read-written-properties
     *
     * @param  PropertyReflection $property     the reflection from the static analysis
     * @param  string             $propertyName the name of the property
     * @return bool
     */
    public function isAlwaysRead(PropertyReflection $property, string $propertyName): bool
    {
        return $this->classAnalyser->isConfigurable($property->getDeclaringClass()) &&
            $this->propertyAnalyser->isConfigurationProperty($property);
    }

    /**
     * isAlwaysWritten - see https://phpstan.org/developing-extensions/always-read-written-properties
     *
     * @param  PropertyReflection $property     the reflection from the static analysis
     * @param  string             $propertyName the name of the property
     * @return bool
     */
    public function isAlwaysWritten(PropertyReflection $property, string $propertyName): bool
    {
        return $this->classAnalyser->isConfigurable($property->getDeclaringClass()) &&
            $this->propertyAnalyser->isConfigurationProperty($property);
    }

    /**
     * isInitialized - see https://phpstan.org/developing-extensions/always-read-written-properties
     *
     * @param  PropertyReflection $property     the reflection from the static analysis
     * @param  string             $propertyName the name of the property
     * @return bool
     */
    public function isInitialized(PropertyReflection $property, string $propertyName): bool
    {
        return $this->classAnalyser->isConfigurable($property->getDeclaringClass()) &&
            $this->propertyAnalyser->isConfigurationProperty($property);
    }
}
