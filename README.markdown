You need to add the path to a class of global include path.

After that, your IDE, when you declare a class Redis will display a hint which methods of this object can be used.

### For example:

	$redis = new Redis();
	$redis->con <press Tab or press Ctrl+Space>

### Warning:

Do not forget to declare a variable type $ redis

	/**
	 * @ Var Redis
	 */
	public $redis = null;

![Example of use](https://github.com/ukko/phpredis-phpdoc/raw/master/redisphp.png)
