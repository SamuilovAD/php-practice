<?php
declare(strict_types=1);

namespace App\LeetCode\A_LongestPalindromicSubstring;

/**
 * Given a string s, return the longest palindromic substring in s.
 *
 * Example 1:
 *
 * Input: s = "babad"
 * Output: "bab"
 * Explanation: "aba" is also a valid answer.
 * Example 2:
 *
 * Input: s = "cbbd"
 * Output: "bb"
 */

class Solution
{
    /**
     * @param string $inputString
     * @return string
     */
    function findLongestPalindrome(string $inputString): string
    {
        $inputStringLength = strlen($inputString);
        if ($inputStringLength < 2) {
            return $inputString;
        }
        $bestStart = 0;
        $bestLength = 1;
        $expand = function (int $leftPosition, int $rightPosition) use (
            $inputString,
            $inputStringLength,
            &$bestStart,
            &$bestLength
        ): void {
            while (
                $leftPosition >= 0
                && $rightPosition < $inputStringLength
                && $inputString[$leftPosition] === $inputString[$rightPosition]
            ) {
                $leftPosition--;
                $rightPosition++;
            }
            $iterationLength = $rightPosition - $leftPosition - 1;
            if ($iterationLength > $bestLength) {
                $bestStart = $leftPosition + 1;
                $bestLength = $iterationLength;
            }
        };
        for ($i = 0; $i < $inputStringLength; $i++) {
            // odd length (center in i e.g. aba)
            $expand($i, $i);
            // even length (center in i and i+1 e.g. abba)
            $expand($i, $i + 1);
        }
        return substr($inputString, $bestStart, $bestLength);
    }
}

$inputString = "babab";
$solution = new Solution();
echo "Input string: $inputString, Longest palindrome: " . $solution->findLongestPalindrome("babab");
