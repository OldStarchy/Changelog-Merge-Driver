<?php

// Get more info and examples by running "php-cs-fixer describe rule_name"

$rules = [
    '@PSR2' => true,

    /*
     * Each line of multi-line DocComments must have an asterisk [PSR-5] and must
     * be aligned with the first one.
     */
    'align_multiline_comment' => [
        // whether to fix PHPDoc comments only (phpdocs_only), any multi-line comment whose lines all start with an asterisk (phpdocs_like) or any multi-line comment (all_multiline)
        // Allowed values: 'all_multiline', 'phpdocs_like', 'phpdocs_only'
        'comment_type' => 'all_multiline',
    ],

    /*
     * PHP arrays should be declared using the configured syntax.
     */
    'array_syntax' => [
        // whether to use the long or short array syntax
        // Allowed values: 'long', 'short'
        'syntax' => 'short',
    ],

    /*
     * Binary operators should be surrounded by space as configured.
     */
    'binary_operator_spaces' => [ // [@Symfony]
        // default fix strategy
        // Allowed values: 'align', 'align_single_space', 'align_single_space_minimal', 'single_space', NULL
        'default' => 'single_space',

        // dictionary of binary operator => fix strategy values that differ from the default strategy
        // 'operators' => [],
    ],

    /*
     * Ensure there is no code on the same line as the PHP open tag and it is
     * followed by a blank line.
     */
    'blank_line_after_opening_tag' => true, // [@Symfony]

    /*
     * An empty line feed must precede any configured statement.
     */
    'blank_line_before_statement' => [ // [@Symfony]
        // list of statements which must be preceded by an empty line
        'statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try'],
    ],

    /*
     * A single space or none should be between cast and variable.
     */
    'cast_spaces' => [ // [@Symfony]
        // spacing to apply between cast and variable
        // Allowed values: 'none', 'single'
        'space' => 'none',
    ],

    /*
     * Class, trait and interface elements must be separated with one blank line.
     */
    // 'class_attributes_separation' => [ // [@Symfony]
    //     // list of classy elements; 'const', 'method', 'property'
    //     'elements' => ['const', 'method', 'property'],
    // ],

    /*
     * Concatenation should be spaced according configuration.
     */
    'concat_space' => [ // [@Symfony]
        // spacing to apply around concatenation operator
        // Allowed values: 'none', 'one'
        'spacing' => 'one',
    ],

    /*
     * Converts implicit variables into explicit ones in double-quoted strings or
     * heredoc syntax.
     */
    'explicit_string_variable' => true,

    /*
     * Add missing space between function's argument and its typehint.
     */
    'function_typehint_space' => true, // [@Symfony]

    /*
     * Include/Require and file path should be divided with a single space. File
     * path should not be placed under brackets.
     */
    'include' => true, // [@Symfony]

    /*
     * Cast should be written in lower case.
     */
    'lowercase_cast' => true, // [@Symfony]

    /*
     * Magic constants should be referred to using the correct casing.
     */
    'magic_constant_casing' => true, // [@Symfony]

    /*
     * Method chaining MUST be properly indented. Method chaining with different
     * levels of indentation is not supported.
     */
    // 'method_chaining_indentation' => true,

    /*
     * Forbid multi-line whitespace before the closing semicolon or move the
     * semicolon to the new line for chained calls.
     */
    'multiline_whitespace_before_semicolons' => [
        // forbid multi-line whitespace or move the semicolon to the new line for chained calls
        // Allowed values: 'new_line_for_chained_calls', 'no_multi_line'
        'strategy' => 'no_multi_line',
    ],

    /*
     * Function defined by PHP should be called using the correct casing.
     */
    'native_function_casing' => true, // [@Symfony]

    /*
     * All instances created with new keyword must be followed by braces.
     */
    'new_with_braces' => true, // [@Symfony]

    /*
     * There should be no empty lines after class opening brace.
     */
    'no_blank_lines_after_class_opening' => true, // [@Symfony]

    /*
     * There should not be blank lines between docblock and the documented
     * element.
     */
    'no_blank_lines_after_phpdoc' => true, // [@Symfony]

    /*
     * There should not be any empty comments.
     */
    'no_empty_comment' => true, // [@Symfony]

    /*
     * There should not be empty PHPDoc blocks.
     */
    'no_empty_phpdoc' => true, // [@Symfony]

    /*
     * Remove useless semicolon statements.
     */
    'no_empty_statement' => true, // [@Symfony]

    /*
     * The namespace declaration line shouldn't contain leading whitespace.
     */
    'no_leading_namespace_whitespace' => true, // [@Symfony]

    /*
     * Either language construct print or echo should be used.
     */
    'no_mixed_echo_print' => [ // [@Symfony]
        // the desired language construct
        // Allowed values: 'echo', 'print'
        'use' => 'echo',
    ],

    /*
     * Operator => should not be surrounded by multi-line whitespaces.
     */
    'no_multiline_whitespace_around_double_arrow' => true, // [@Symfony]

    /*
     * Single-line whitespace before closing semicolon are prohibited.
     */
    'no_singleline_whitespace_before_semicolons' => true, // [@Symfony]

    /*
     * There MUST NOT be spaces around offset braces.
     */
    'no_spaces_around_offset' => [ // [@Symfony]
        // whether spacing should be fixed inside and/or outside the offset braces
        'positions' => ['inside', 'outside'],
    ],

    /*
     * Remove trailing commas in list function calls.
     */
    'no_trailing_comma_in_list_call' => true, // [@Symfony]

    /*
     * PHP single-line arrays should not have trailing comma.
     */
    'no_trailing_comma_in_singleline_array' => true, // [@Symfony]

    /*
     * Removes unneeded parentheses around control statements.
     */
    'no_unneeded_control_parentheses' => [ // [@Symfony]
        // list of control statements to fix
        'statements' => ['break', 'clone', 'continue', 'echo_print', 'return', 'switch_case', 'yield'],
    ],

    /*
     * Unused use statements must be removed.
     */
    'no_unused_imports' => true, // [@Symfony]

    /*
     * There should not be useless else cases.
     */
    'no_useless_else' => true,

    /*
     * There should not be an empty return statement at the end of a function.
     */
    'no_useless_return' => true,

    /*
     * In array declaration, there MUST NOT be a whitespace before each comma.
     */
    'no_whitespace_before_comma_in_array' => true, // [@Symfony]

    /*
     * Remove trailing whitespace at the end of blank lines.
     */
    'no_whitespace_in_blank_line' => true, // [@Symfony]

    /*
     * Array index should always be written by using square braces.
     */
    'normalize_index_brace' => true, // [@Symfony]

    /*
     * There should not be space before or after object T_OBJECT_OPERATOR ->.
     */
    'object_operator_without_whitespace' => true, // [@Symfony]

    /*
     * Ordering use statements.
     */
    'ordered_imports' => [
        // defines the order of import types
        // 'importsOrder' => null,

        // whether the statements should be sorted alphabetically or by length
        // Allowed values: 'alpha', 'length'
        'sortAlgorithm' => 'alpha',
    ],

    /*
     * PHPUnit annotations should be a FQCNs including a root namespace.
     */
    'php_unit_fqcn_annotation' => true, // [@Symfony]

    /*
     * Phpdoc should contain @param for all params.
     */
    'phpdoc_add_missing_param_annotation' => [
        // whether to add missing @param annotations for untyped parameters only
        'only_untyped' => true,
    ],

    /*
     * All items of the given phpdoc tags must be aligned vertically.
     */
    'phpdoc_align' => [ // [@Symfony]
        // the tags that should be aligned
        'tags' => ['param', 'return', 'throws', 'type', 'var'],
        'align' => 'left',
    ],

    /*
     * Phpdocs annotation descriptions should not be a sentence.
     */
    'phpdoc_annotation_without_dot' => true, // [@Symfony]

    /*
     * Docblocks should have the same indentation as the documented subject.
     */
    'phpdoc_indent' => true, // [@Symfony]

    /*
     * Fix phpdoc inline tags, make inheritdoc always inline.
     */
    'phpdoc_inline_tag' => true, // [@Symfony]

    /*
     * No alias PHPDoc tags should be used.
     */
    'phpdoc_no_alias_tag' => [ // [@Symfony]
        // mapping between replaced annotations with new ones
        'replacements' => ['property-read' => 'property', 'property-write' => 'property', 'type' => 'var', 'link' => 'see'],
    ],

    /*
     * @return void and @return null annotations should be omitted from phpdocs.
     */
    'phpdoc_no_empty_return' => true, // [@Symfony]

    /*
     * Classy that does not inherit must not have inheritdoc tags.
     */
    'phpdoc_no_useless_inheritdoc' => true, // [@Symfony]

    /*
     * Annotations in phpdocs should be ordered so that param annotations come
     * first, then throws annotations, then return annotations.
     */
    'phpdoc_order' => true,

    /*
     * The type of @return annotations of methods returning a reference to itself
     * must the configured one.
     */
    'phpdoc_return_self_reference' => [ // [@Symfony]
        // mapping between replaced return types with new ones
        'replacements' => ['this' => '$this', '@this' => '$this', '$self' => 'self', '@self' => 'self', '$static' => 'static', '@static' => 'static'],
    ],

    /*
     * Scalar types should always be written in the same form. int not integer,
     * bool not boolean, float not real or double.
     */
    'phpdoc_scalar' => true, // [@Symfony]

    /*
     * Annotations in phpdocs should be grouped together so that annotations of
     * the same type immediately follow each other, and annotations of a different
     * type are separated by a single blank line.
     */
    'phpdoc_separation' => true, // [@Symfony]

    /*
     * Single line @var PHPDoc should have proper spacing.
     */
    'phpdoc_single_line_var_spacing' => true, // [@Symfony]

    /*
     * Docblocks should only be used on structural elements.
     */
    'phpdoc_to_comment' => true, // [@Symfony]

    /*
     * Phpdocs should start and end with content, excluding the very first and
     * last line of the docblocks.
     */
    'phpdoc_trim' => true, // [@Symfony]

    /*
     * The correct case must be used for standard PHP types in phpdoc.
     */
    'phpdoc_types' => true, // [@Symfony]

    /*
     * There should be one or no space before colon, and one space after it in
     * return type declarations, according to configuration.
     */
    'return_type_declaration' => [ // [@Symfony]
        // spacing to apply before colon
        // Allowed values: 'none', 'one'
        'space_before' => 'none',
    ],

    /*
     * Instructions must be terminated with a semicolon.
     */
    'semicolon_after_instruction' => true, // [@Symfony]

    /*
     * Cast (boolean) and (integer) should be written as (bool) and (int),
     * (double) and (real) as (float).
     */
    'short_scalar_cast' => true, // [@Symfony]

    /*
     * A return statement wishing to return void should not return null.
     */
    'simplified_null_return' => true,

    /*
     * There should be exactly one blank line before a namespace declaration.
     */
    'single_blank_line_before_namespace' => true, // [@Symfony]

    /*
     * Single-line comments and multi-line comments with only one line of actual
     * content should use the // syntax.
     */
    'single_line_comment_style' => [ // [@Symfony]
        // list of comment types to fix
        'comment_types' => ['hash'],
    ],

    /*
     * Convert double quotes to single quotes for simple strings.
     */
    'single_quote' => true, // [@Symfony]

    /*
     * Fix whitespace after a semicolon.
     */
    'space_after_semicolon' => [ // [@Symfony]
        // whether spaces should be removed for empty for expressions
        'remove_in_empty_for_expressions' => true,
    ],

    /*
     * Replace all <> with !=.
     */
    'standardize_not_equals' => true, // [@Symfony]

    /*
     * Standardize spaces around ternary operator.
     */
    'ternary_operator_spaces' => true, // [@Symfony]

    /*
     * PHP multi-line arrays should have a trailing comma.
     */
    'trailing_comma_in_multiline_array' => true, // [@Symfony]

    /*
     * Arrays should be formatted like function/method arguments, without leading
     * or trailing single line space.
     */
    'trim_array_spaces' => true, // [@Symfony]

    /*
     * Unary operators should be placed adjacent to their operands.
     */
    'unary_operator_spaces' => true, // [@Symfony]

    /*
     * In array declaration, there MUST be a whitespace after each comma.
     */
    'whitespace_after_comma_in_array' => true, // [@Symfony]
];

$fixer = PhpCsFixer\Config::create()
    ->setRules($rules)
    ->setLineEnding("\n")
    ->setUsingCache(false);

$fixer
    ->getFinder()
        ->exclude(['vendor', 'node_modules']);

return $fixer;
