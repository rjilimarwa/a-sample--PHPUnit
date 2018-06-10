<?php

namespace AppBundle\Entity;


use AppBundle\Entity\User;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class GithubUserProvider
 * @package AppBundle\Entity
 */

class GithubUserProvider implements UserProviderInterface
{
    private $client;
    private $serializer;

    /**
     * GithubUserProvider constructor.
     * @param Client $client
     * @param Serializer $serializer
     */
    public function __construct(Client $client, Serializer $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }
    /**
     *
     *the loadUserByUsername method above, there are two possible outcomes:
         *either return a $ user object of type AppBundle \ Entity \ User;
         *or throw an exception of type LogicException if the variable $ userData is empty.

     */
    public function loadUserByUsername($username)
    {
        $response = $this->client->get('https://api.github.com/user?access_token='.$username);
        $result = $response->getBody()->getContents();

        $userData = $this->serializer->deserialize($result, 'array', 'json');

        if (!$userData) {
            throw new \LogicException('Did not managed to get your user info from Github.');
        }

        $user = new User(
            $userData['login'],
            $userData['name'],
            $userData['email'],
            $userData['avatar_url'],
            $userData['html_url']
        );

        return $user;
    }

    /**
     * @param UserInterface $user
     */
    public function refreshUser(UserInterface $user){

    }

    /**
     * @param string $class
     */
    public function supportsClass($class)
    {

    }
    // …
}