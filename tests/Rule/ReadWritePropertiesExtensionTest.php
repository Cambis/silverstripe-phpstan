<?php

declare(strict_types=1);

namespace Syntro\SilverstripePHPStan\Tests\Rule;

use PHPStan\Rules\DeadCode\UnusedPrivatePropertyRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/**
 * @extends RuleTestCase<UnusedPrivatePropertyRule>
 */
final class ReadWritePropertiesExtensionTest extends RuleTestCase
{
    /**
     * @return string[]
     */
    public static function getAdditionalConfigFiles(): array
    {
        return [__DIR__ . '/../../phpstan.neon'];
    }

    public function testRuleConfigurableClass(): void
    {
        $this->analyse([__DIR__ . '/data/ConfigurableClass.php'], [
            [
                'Property Syntro\SilverstripePHPStan\Tests\Rule\data\ConfigurableClass::$unconfigurable_property is never read, only written.',
                14,
                'See: https://phpstan.org/developing-extensions/always-read-written-properties',
            ],
            [
                'Static property Syntro\SilverstripePHPStan\Tests\Rule\data\ConfigurableClass::$blocklisted_property is never read, only written.',
                19,
                'See: https://phpstan.org/developing-extensions/always-read-written-properties',
            ],
        ]);
    }

    public function testRuleConfigurableExtension(): void
    {
        $this->analyse([__DIR__ . '/data/ConfigurableExtension.php'], [
            [
                'Property Syntro\SilverstripePHPStan\Tests\Rule\data\ConfigurableExtension::$unconfigurable_property is never read, only written.',
                12,
                'See: https://phpstan.org/developing-extensions/always-read-written-properties',
            ],
            [
                'Static property Syntro\SilverstripePHPStan\Tests\Rule\data\ConfigurableExtension::$blocklisted_property is never read, only written.',
                17,
                'See: https://phpstan.org/developing-extensions/always-read-written-properties',
            ],
        ]);
    }

    protected function getRule(): Rule
    {
        return self::getContainer()->getByType(UnusedPrivatePropertyRule::class);
    }
}
