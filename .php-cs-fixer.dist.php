<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude(['var', 'public', 'vendor'])
;

return (new PhpCsFixer\Config())
    ->setRules([
            '@Symfony' => true,
            '@PSR12' => true,
            'yoda_style' => false,
            'concat_space' => false,
            'phpdoc_align' => false,
            'increment_style' => false,
            'binary_operator_spaces' => false,
            'single_line_throw' => false,
    ])
    ->setFinder($finder)
;
