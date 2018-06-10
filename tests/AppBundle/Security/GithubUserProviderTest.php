<?php

namespace Tests\AppBundle\Security;

use AppBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use AppBundle\Entity\GithubUserProvider;

use PHPUnit\Framework\TestCase;
/**
 * Create the test class GithubUserProvider
 */

class GithubUserProviderTest extends TestCase
{
    private $client;
    private $serializer;
    private $streamedResponse;
    private $response;

    /**
     * The setUp method is a method from the PHPUnit_Framework_TestCase class
     * which can be overridden to execute statements before each class test.
     *You will therefore ensure that all the liners used in the unit tests
     * are initialized at the beginning of each test.
     */
    public function setUp()
    {
        /**
         * create the dependency liners needed to instantiate the GithubUserProvider class
         * then call the method to test:
         * created a $ customer object. With the method disableOriginalConstructor
         * FOR tells PHPUnit not to call the original constructor of the GuzzleHttp \ Client class. Then, with the setMethods method, I indicate which method exists in this class.
          When the get method is called, I specify what must be returned, in this case what contains the variable $ response.
         */

        $this->client = $this->getMockBuilder('GuzzleHttp\Client')
            /**
             * the disableOriginalConstructor () method
             * you make sure that PHPUnit does not use the constructor of the classes you are trying to override.
             */
            ->disableOriginalConstructor()
            ->setMethods(['get'])
            ->getMock();
        /**
         * the Serializer class constructor is complicated
         * Therefore, if you need an instance of the Serializer in a test
         * it would be easier to create a dummy by asking PHPUnit not to call the original constructor
         */
        $this->serializer = $this
            ->getMockBuilder('JMS\Serializer\Serializer')
            /**
             * the disableOriginalConstructor () method
             * you make sure that PHPUnit does not use the constructor of the classes you are trying to override.
             */
            ->disableOriginalConstructor()
            ->getMock();

        $this->streamedResponse = $this
            ->getMockBuilder('Psr\Http\Message\StreamInterface')
            ->getMock();

        $this->response = $this
            ->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->getMock();
    }
    /**
     *
       *the loadUserByUsername method above, there are two possible outcomes:
         *either return a $ user object of type AppBundle \ Entity \ User;
         *or throw an exception of type LogicException if the variable $ userData is empty.

     */
    public function testLoadUserByUsernameReturningAUser()
    {
        $this->client
            ->expects($this->once())
            ->method('get')
            ->willReturn($this->response)
        ;

        $this->response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($this->streamedResponse);

        $userData = ['login' => 'a login', 'name' => 'user name', 'email' => 'adress@mail.com', 'avatar_url' => 'url to the avatar', 'html_url' => 'url to profile'];
        $this->serializer
            ->expects($this->once())
            /**
             * duplicate When calling the deserialize method
             * you will have to make sure you get a table with all the information of a user.
             */
            ->method('deserialize')
            ->willReturn($userData);

        $githubUserProvider = new GithubUserProvider($this->client, $this->serializer);
        $user = $githubUserProvider->loadUserByUsername('an-access-token');


        $expectedUser = new User($userData['login'], $userData['name'], $userData['email'], $userData['avatar_url'], $userData['html_url']);
        $this->assertEquals($expectedUser, $user);
        $this->assertEquals('AppBundle\Entity\User', get_class($user));
    }


    public function testLoadUserByUsernameThrowingException()
    {
        $this->client
            /**
             * Nous nous attendons à ce que la méthode get soit appelée une fois
             */
            ->expects($this->once())
            ->method('get')
            ->willReturn($this->response)
        ;

        $this->response

            ->expects($this->once())
           /**
            * la méthode getBody retourne un objet de type Psr\Http\Message\StreamInterface
            * **/
            ->method('getBody')
            ->willReturn($this->streamedResponse);

        $this->serializer
            /**
             * Nous nous attendons à ce que la méthode get soit appelée une fois
             */
            ->expects($this->once())
            ->method('deserialize')
            ->willReturn([]);

        $this->expectException('LogicException');

        $githubUserProvider = new GithubUserProvider($this->client, $this->serializer);
        $githubUserProvider->loadUserByUsername('an-access-token');
    }
}