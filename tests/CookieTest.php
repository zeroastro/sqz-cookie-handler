<?php
/**
 * Cookie Test Suite - This is the TestCase class for Cookie
 *
 * @author Salvatore Q Zeroastro <zeroastro@gmail.com>
 *
 * @group sqz-cookie-handler-test
 */

namespace SQZ_CookieHandler_Test;

use \SQZ_CookieHandler\Cookie;

class CookieTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Setup the Cookie Variable for Testing
     */
    public function setUp()
    {
        $this->cookie = new Cookie(
            'testName',
            'testValue',
            65535,
            'testPath',
            'testDomain',
            true,
            true,
            'strict'
        );
    }

    /**
     * Test constructor with empty name
     *
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorWithEmptyName()
    {
        $cookie = new Cookie('');
    }

    /**
     * Test constructor with invalid expires
     *
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorWithInvalidExpires()
    {
        $cookie = new Cookie('name', 'value', false);
    }

    /**
     * Test constructor with invalid SameSite value
     *
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorWithInvalidSameSite()
    {
        $cookie = new Cookie('name', 'value', 65535, '/', 'domain', true, true, 'invalidSameSite');
    }

    /**
     * Test the constructor
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(Cookie::class, $this->cookie);
    }

    /**
     * Test the costruction with a DateTime Object as Expires Time
     */
    public function testCookieWithDateTimeExpires()
    {
        $expireDT = new \DateTime();
        $cookie = new Cookie('name', 'value', $expireDT);

        $this->assertEquals($expireDT->format('U'), $cookie->getExpires());
    }

    /**
     * Test the costruction with a string as Expires Time
     */
    public function testCookieWithStringExpires()
    {
        $expireString = '+1 day';
        $expire = strtotime($expireString);
        $cookie = new Cookie('name', 'value', $expireString);

        $this->assertEquals($expire, $cookie->getExpires());
    }

    /**
     * Test getName()
     */
    public function testGetName()
    {
        $this->assertEquals($this->cookie->getName(), 'testName');
    }

    /**
     * Test getValue()
     */
    public function testGetValue()
    {
        $this->assertEquals($this->cookie->getValue(), 'testValue');
    }

    /**
     * Test getExpires()
     */
    public function testGetExpires()
    {
        $this->assertEquals($this->cookie->getExpires(), 65535);
    }

    /**
     * Test isExpired()
     */
    public function testIsExpired()
    {
        $this->assertTrue($this->cookie->isExpired());
    }

    /**
     * Test getPath()
     */
    public function testGetPath()
    {
        $this->assertEquals($this->cookie->getPath(), 'testPath');
    }

    /**
     * Test getDomain()
     */
    public function testGetDomain()
    {
        $this->assertEquals($this->cookie->getDomain(), 'testDomain');
    }

    /**
     * Test isSecure()
     */
    public function testIsSecure()
    {
        $this->assertTrue($this->cookie->isSecure());
    }

    /**
     * Test getIsHttpOnly()
     */
    public function testIsHttpOnly()
    {
        $this->assertTrue($this->cookie->isSecure());
    }

    /**
     * Test getSameSite()
     */
    public function testGetSameSite()
    {
        $this->assertEquals($this->cookie->getSameSite(), 'strict');
    }
}