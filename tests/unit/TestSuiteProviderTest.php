<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * The MIT License
 *
 * Copyright 2015 Eric VILLARD <dev@eviweb.fr>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package     netbeans\phpunit\support
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright   (c) 2015 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */

namespace netbeans\phpunit\support;

use netbeans\phpunit\support\exceptions\FileNotFoundException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestSuite;

/**
 * TestSuiteProviderTest
 *
 * @package     netbeans\phpunit\support
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright   (c) 2015 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */
class TestSuiteProviderTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        TestSuiteProvider::setConfigurationFile(null);
    }

    public function testSuiteReturnsCorrectType()
    {
        $this->assertInstanceOf(TestSuite::class, TestSuiteProvider::suite());
    }

    public function testSuiteUsesConfigFileFromCurrentWorkingDir()
    {
        $olddir = getcwd();
        chdir(__DIR__);
        $this->assertEquals(
            $this->getExpectedTestSuiteName(), TestSuiteProvider::suite()->tests()[0]->getName()
        );
        chdir($olddir);
    }

    public function testSetConfigurationFile()
    {
        TestSuiteProvider::setConfigurationFile(__DIR__ . DIRECTORY_SEPARATOR . 'phpunit.xml');
        $this->assertEquals(
            $this->getExpectedTestSuiteName(), TestSuiteProvider::suite()->tests()[0]->getName()
        );
    }

    public function testEmptySuite()
    {
        TestSuiteProvider::setConfigurationFile(__DIR__ . DIRECTORY_SEPARATOR . 'empty-suite-phpunit.xml');
        $this->assertEmpty(TestSuiteProvider::suite()->tests());
    }

    public function testSuiteThrowsExceptionIfConfigurationFileIsNotFound()
    {
        $this->expectException(FileNotFoundException::class);

        TestSuiteProvider::setConfigurationFile('undefined.xml');
        TestSuiteProvider::suite();
    }

    /**
     * get the expected test suite name
     *
     * @return string
     */
    private function getExpectedTestSuiteName()
    {
        return 'DummyTestSuite';
    }

}
