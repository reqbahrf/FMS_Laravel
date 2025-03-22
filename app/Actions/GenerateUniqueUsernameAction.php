<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;

class GenerateUniqueUsernameAction
{
    /**
     * Generate a unique and memorable username based on the first name
     *
     * @param string $firstName
     * @return string
     */
    public function execute(string $firstName): string
    {
        // Sanitize the first name (remove special characters, convert to lowercase)
        $cleanFirstName = strtolower(preg_replace('/[^a-zA-Z]/', '', $firstName));

        // Ensure we have at least 3 characters for the name part
        if (strlen($cleanFirstName) < 3) {
            // Pad with consonants if the name is too short
            $consonants = ['b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'z'];
            while (strlen($cleanFirstName) < 3) {
                $cleanFirstName .= $consonants[array_rand($consonants)];
            }
        }

        // Limit name length to avoid excessively long usernames
        $cleanFirstName = substr($cleanFirstName, 0, 10);

        // Use a more secure random generator
        $attempts = 0;
        $maxAttempts = 10;

        while ($attempts < $maxAttempts) {
            // Generate a more secure random string
            $randomBytes = random_bytes(4);
            $randomHex = bin2hex($randomBytes);
            $randomSuffix = substr($randomHex, 0, 6);

            // Add a random separator from a set of allowed characters
            $separators = ['-', '_', '.'];
            $separator = $separators[array_rand($separators)];

            // Combine parts to create username
            $username = "{$cleanFirstName}{$separator}{$randomSuffix}";

            // Check if username already exists
            $existingUser = DB::table('coop_users_info')
                ->where('user_name', $username)
                ->first();

            if (!$existingUser) {
                return $username;
            }

            $attempts++;
        }

        // If we've exhausted our attempts, create a highly unique fallback
        // by using a timestamp and more random bytes
        $timestamp = time();
        $randomBytes = random_bytes(6);
        $randomHex = bin2hex($randomBytes);
        $randomSuffix = substr($randomHex, 0, 8);

        return "{$cleanFirstName}_{$timestamp}{$randomSuffix}";
    }
}
