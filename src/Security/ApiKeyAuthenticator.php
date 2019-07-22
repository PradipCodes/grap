<?php

namespace App\Security;

use App\Exception\APIKeyNotFoundException;
use App\Exception\InvalidAPIKeyException;
use App\Model\ApiTokenQuery;
use App\StatusCode\APIStatusCode;

use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;

class ApiKeyAuthenticator implements SimplePreAuthenticatorInterface
{
    public function createToken(Request $request, $providerKey)
    {
        if (!$request->headers->has('apikey')) {
            throw new APIKeyNotFoundException('No API key found', APIStatusCode::NO_API_KEY);
        }

        return new PreAuthenticatedToken(
            'anon.',
            $request->headers->get('apikey'),
            $providerKey
        );
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $provider, $providerKey)
    {
        $api_key = $token->getCredentials();

        $api_token = ApiTokenQuery::create()
            ->findOneByToken($api_key);

        if (!$api_token) {
            throw new InvalidAPIKeyException(
                sprintf('Device not found', $api_key),
                APIStatusCode::USER_NOT_FOUND
            );
        }

        return new PreAuthenticatedToken(
            $api_token->getDevices(),
            $api_key,
            $providerKey,
            array('ROLE_USER')
        );
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }
}
