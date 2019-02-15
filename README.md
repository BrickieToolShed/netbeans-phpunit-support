Netbeans Phpunit Support
========================
This package provides another phpunit support to netbeans than the original one. 

##### Health status
[![Travis CI - Build Status](https://travis-ci.org/BrickieToolShed/netbeans-phpunit-support.svg)](https://travis-ci.org/BrickieToolShed/netbeans-phpunit-support)
[![Github - Last tag](https://img.shields.io/github/tag/BrickieToolShed/netbeans-phpunit-support.svg)](https://github.com/BrickieToolShed/netbeans-phpunit-support/tags)

Supported PHPUnit versions
==========================
* version 0.1.0 supports PHPUnit 4
* version 0.2.0 supports PHPUnit >= 7

Installation
------------
### Locally
Run `composer require brickie-toolshed/netbeans-phpunit-support` within your project directory.    
### Globally
Run `composer global require brickie-toolshed/netbeans-phpunit-support` within your project directory.    

NetBeans configuration
----------------------
1. create a phpunit configuration file named `phpunit.xml` at the root of your project directory
2. enable phpunit support in the _NetBeans Project Properties > Testing_ panel
3. check the _Use Custom Test Suite_ checkbox in the _NetBeans Project Properties > Testing > PHPUnit_ panel
4. click _Browse..._ and select the test suite provider file: `./src/TestSuiteProvider.php` of this package
5. click _OK_

> Note    
> you can specify the path of a custom phpunit configuration file using `TestSuiteProvider::setConfigurationFile("/path/to/config.xml")` method in a bootstrap file

Why this package
----------------
The `TestSuiteProvider` class uses the test suite set in your phpunit configuration file.    
The default behaviour of the `NetBeansSuite` class provided by NetBeans is to create the test suite by looking for files in the test directory.   
The problem is that the test case lookup lies on hard coded file naming patterns and the phpunit configuration file is not used.   

License
-------
This project is licensed under the terms of the [MIT License](/LICENSE)    
