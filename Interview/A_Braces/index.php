<?php
declare(strict_types=1);

namespace App\Interview\A_Braces;

/**
 * Task: Validate Brackets (Parentheses)
 *
 * Description:
 * Given a string containing only the characters '(', ')', '{', '}', '[', and ']',
 * determine if the input string is valid.
 *
 * A string is considered valid if:
 * 1.    Every opening bracket has a corresponding closing bracket of the same type.
 * 2.    Brackets are closed in the correct order.
 *
 * Input: "()"
 * Output: true
 *
 * Input: "([{}])"
 * Output: true
 *
 * Input: "(]"
 * Output: false
 *
 * Input: "([)]"
 * Output: false
 *
 * Input: "{[]}"
 * Output: true
 */
function isValidBrackets(string $inputString): bool
{
    $stack = [];
    $symbolsMap = [
        ')' => '(',
        ']' => '[',
        '}' => '{',
    ];
    for ($i = 0; $i < strlen($inputString); ++$i) {
        $char = $inputString[$i];
        if (isset($symbolsMap[$char])) {
            $lastSymbolInStack = array_pop($stack) ?? '';
            if ($lastSymbolInStack !== $symbolsMap[$char]) {
                return false;
            }
        }else {
            $stack[] = $char;
        }
    }
    return empty($stack);
}

var_dump(isValidBrackets("()"));      // true
var_dump(isValidBrackets("([)]"));    // false
var_dump(isValidBrackets("{[]}"));