<?php

namespace SymfonyCasts\Bundle\ResetPassword;

use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordToken;

/**
 * @author Jesse Rushlow <jr@rushlow.dev>
 * @author Ryan Weaver   <ryan@symfonycasts.com>
 */
interface ResetPasswordHelperInterface
{
    /**
     * Generate a new ResetPasswordToken that can be provided to the user.
     *
     * This method must also persist the token information to storage so that
     * the validateTokenAndFetchUser() method can verify the token validity
     * and removeResetRequest() can eventually invalidate it by removing it
     * from storage.
     */
    public function generateResetToken(object $user): ResetPasswordToken;

    /**
     * Validate a reset request and fetch the user from persistence.
     *
     * The token provided to the user from generateResetToken() is validated
     * against a token stored in persistence.
     *
     * @param string $fullToken selector string + verifier string provided by the user
     */
    public function validateTokenAndFetchUser(string $fullToken): object;

    /**
     * Remove a password reset request token from persistence.
     *
     * Intended to be used after validation - this will typically remove
     * the token from storage so that it can't be used again.
     *
     * @param string $fullToken selector string + verifier string provided by the user
     */
    public function removeResetRequest(string $fullToken): void;

    /**
     * Get the length of time in seconds a token is valid.
     */
    public function getTokenLifetime(): int;
}