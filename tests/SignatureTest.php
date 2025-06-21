<?php
namespace Upyun\Tests;

use Upyun\Signature;
use Upyun\Config;
use PHPUnit\Framework\TestCase;

class SignatureTest extends TestCase
{

    /**
     * @var Config;
     */
    public $config;

    public function setUp(): void
    {
        $this->config = new Config('bucket', 'operator', 'password');
    }

    public function testGetBodySignature()
    {
        $sign = Signature::getBodySignature($this->config, 'POST', '/bucket');
        $this->assertEquals($sign, 'UPYUN operator:Xx3G6+DAvUyCL2Y2npSW/giTFI8=');
    }
}
