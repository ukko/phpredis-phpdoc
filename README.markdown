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

 * Install redis-server
 * Install [phpredis extension](https://github.com/nicolasff/phpredis)
 * The simpliest way to install and use redisphp-phpdoc is to use Composer, as there is a package on Packagist. Just add this to your project composer.json file :

    {
        "require": {
            "ukko/redisphp-phpdoc": "*"
        },
    }

 * Or download [phpredis-phpdoc](https://github.com/ukko/phpredis-phpdoc/tarball/master)

### Setup in IDE PhpStorm

 Menu "File" -> "Settings" -> "PHP" -> _Select path to folder "phpredis-phpdoc"_

### Setup in IDE NetBeans

 * Right click your project -> "Properties"
 * Select the "PHP Include Path" category
 * Click "Add Folder..."
 * Select your checkout of phpredis-phpdoc
 * Click "Open"
 * Click "OK"

### Setup in IDE Eclipse PDT

