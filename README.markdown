You need to add the path to a class of global include path.

After that, your IDE, when you declare a class Redis will display a hint which methods of this object can be used.

### For example:

    $redis = new Redis();
    $redis->con<press Tab or press Ctrl+Space>

### Warning:

Do not forget to declare a variable type $ redis

    /**
     * Please do not forget to specify the variable type
     * @var Redis
     */
    public $redis = null;

![Example of use](https://github.com/ukko/phpredis-phpdoc/raw/master/redisphp.png)

### Install

 * Install [redis-server](http://redis.io/download)
 * Install [phpredis extension](https://github.com/nicolasff/phpredis)
 * The simpliest way to install and use phpredis-phpdoc is to use Composer, as there is a [package on Packagist](https://packagist.org/packages/ukko/phpredis-phpdoc). Just add this to your project composer.json file :

    {
        "require": {
            "ukko/phpredis-phpdoc": "*"
        },
        "minimum-stability": "dev"
    }

 * Or direct download [phpredis-phpdoc](https://github.com/ukko/phpredis-phpdoc/tarball/master)

### Setup in IDE PhpStorm

 Menu "File" -> "Settings" -> "PHP" -> _Select path to folder "phpredis-phpdoc"_

### Setup in IDE NetBeans

 * Right click your project -> "Properties"
 * Select the "PHP Include Path" category
 * Click "Add Folder..."
 * Select your checkout of phpredis-phpdoc
 * Click "Open"
 * Click "OK"

### Setup in Zend Studio IDE (Eclipse PDT)

 * Open "Window" -> "Preferences"
 * In preferences dialog open "PHP" -> "PHP Libriaries"
 * Click "New" button, in "User library name" enter "Redis", click "OK"
 * Select newly created "Redis", library Click "Add external folder", select path to the folder which contains your checkout of phpredis-phpdoc or you can download single "Redis.php" file https://raw.github.com/ukko/phpredis-phpdoc/master/src/Redis.php
 * Include your custom library in your project: open "Project" -> "Properties" -> "PHP Include Path", click add library, select "User library", click "Next", check "Redis", click "Finish"

