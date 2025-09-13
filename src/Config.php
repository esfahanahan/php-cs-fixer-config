<?php

declare(strict_types=1);

namespace EsfahanAhan\PhpCsFixer;

use PhpCsFixer\ConfigInterface;
use PhpCsFixer\Finder;

class Config extends \PhpCsFixer\Config
{
    public static function defaultRules(): array
    {
        return [
            '@Symfony' => true,
            'declare_strict_types' => true,
            'modernize_types_casting' => true,
            'no_useless_return' => true,
            'ordered_class_elements' => [
                'order' => [
                    'use_trait',
                    'constant_public',
                    'constant_protected',
                    'constant_private',
                    'property_public_static',
                    'property_protected_static',
                    'property_private_static',
                    'method_public_static',
                    'method_protected_static',
                    'method_private_static',
                    'property_public',
                    'property_protected',
                    'property_private',
                    'case',
                    'construct',
                    'destruct',
                    'magic',
                    'method_public',
                    'method_protected',
                    'method_private',
                ],
            ],
            'php_unit_method_casing' => false,
            'protected_to_private' => true,
            'static_lambda' => true,
            'strict_param' => true,
            'single_quote' => true,
            'trailing_comma_in_multiline' => [
                'elements' => [
                    'arrays',
                ],
            ],
            'use_arrow_functions' => true,
            'whitespace_after_comma_in_array' => true,
        ];
    }

    /**
     * @param string[] $folders
     * @param string[] $exclude folder to exclude
     */
    public static function fromFolders(array $folders, ?string $target = null, array $exclude = []): ConfigInterface
    {
        $config = new static($target);

        return $config->setFinder(
            Finder::create()->in($folders)->exclude($exclude)
        );
    }

    /**
     * @param string[] $folders
     */
    public static function forLaravel(array $folders = [], ?string $target = null): ConfigInterface
    {
        $folders = array_merge(['app', 'config', 'database', 'routes', 'tests'], $folders);

        return static::fromFolders($folders, $target);
    }
    /**
     * The PHP version of the application.
     */
    protected string $target;

    /**
     * Create a new MWL configuration.
     */
    public function __construct(?string $target = null)
    {
        parent::__construct('esfahanahan');

        $this->target = $target ?: PHP_VERSION;

        $this
            ->setRiskyAllowed(true)
            ->setRules(
                static::defaultRules()
            );
    }

    /**
     * Merge a set of rules with the core ones.
     */
    public function mergeRules(array $rules): ConfigInterface
    {
        return $this->setRules(array_merge(
            $this->getRules(),
            $rules
        ));
    }

    public function enablePhpunitRules(): ConfigInterface
    {
        return $this->mergeRules([
            'php_unit_dedicate_assert' => true,
            'php_unit_dedicate_assert_internal_type' => true,
            'php_unit_expectation' => true,
            'php_unit_internal_class' => true,
            'php_unit_mock' => true,
            'php_unit_namespaced' => true,
            'php_unit_no_expectation_annotation' => true,
        ]);
    }
}
