<?php

use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->parallel();

    $ecsConfig->paths([
        __DIR__ . '/plugin.php',
    ]);

	$ecsConfig->sets([SetList::PSR_12, SetList::CLEAN_CODE, SetList::ARRAY]);

    $ecsConfig->ruleWithConfiguration(ArraySyntaxFixer::class, [
        'syntax' => 'short',
    ]);
    $ecsConfig->ruleWithConfiguration(NativeFunctionInvocationFixer::class, [
        'include' => [
            '@all',
        ],
        'scope' => 'namespaced'
    ]);
    $ecsConfig->ruleWithConfiguration(BinaryOperatorSpacesFixer::class, [
        'operators' => ['=>' => 'align_single_space'],
    ]);
};
