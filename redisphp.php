<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Redis
{
    /**
     * Creates a Redis client
     * 
     * @example $redis = new Redis();
     */
    public function __construct() {}
    
    /**
     * Connects to a Redis instance.
     * 
     * @param string    $host       can be a host, or the path to a unix domain socket
     * @param int       $port       optional
     * @param float     $timeout    value in seconds (optional, default is 0 meaning unlimited)
     * @return bool                 TRUE on success, FALSE on error.
     * @example $redis->connect('127.0.0.1', 6379);
     * @example $redis->connect('127.0.0.1'); // port 6379 by default
     * @example $redis->connect('127.0.0.1', 6379, 2.5); // 2.5 sec timeout.
     * @example $redis->connect('/tmp/redis.sock'); // unix domain socket.
     */
    public function connect($host, $port = 6379, $timeout = 0) {}
    
    /**
     * @see connect() 
     */
    public function open($host, $port = 6379, $timeout = 0) {}
    
    /**
     * Connects to a Redis instance or reuse a connection already established with pconnect/popen.
     * 
     * The connection will not be closed on close or end of request until the php process ends. So be patient on to many open FD's (specially on redis server side) when using persistent connections on many servers connecting to one redis server.
     * 
     * Also more than one persistent connection can be made identified by either host + port + timeout or unix socket + timeout.
     * 
     * This feature is not available in threaded versions. pconnect and popen then working like their non persistent equivalents.
     * 
     * @param string    $host       can be a host, or the path to a unix domain socket
     * @param int       $port       optional
     * @param float     $timeout    value in seconds (optional, default is 0 meaning unlimited)
     * @return bool                 TRUE on success, FALSE on error.
     * @example $redis->connect('127.0.0.1', 6379);
     * @example $redis->connect('127.0.0.1'); // port 6379 by default
     * @example $redis->connect('127.0.0.1', 6379, 2.5); // 2.5 sec timeout.
     * @example $redis->connect('/tmp/redis.sock'); // unix domain socket.
     */    
    public function pconnect($host, $port = 6379, $timeout = 0) {}
    
    /**
     * @see pconnect()
     */
    public function popen($host, $port = 6379, $timeout = 0) {}
    
    /**
     * Disconnects from the Redis instance, except when pconnect is used.
     */
    public function close() {}
    
    /**
     * Set client option.
     * 
     * @param type $name    parameter name
     * @param type $value   parameter value
     * @return BOOL: TRUE on success, FALSE on error.
     * @example $redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_NONE);   // don't serialize data
     * @example $redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);    // use built-in serialize/unserialize
     * @example $redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_IGBINARY);   // use igBinary serialize/unserialize
     * @example $redis->setOption(Redis::OPT_PREFIX, 'myAppName:'); // use custom prefix on all keys
     */
    public function setOption($name, $value) {}
    
    /**
     * Get client option
     * 
     * @param type $name parameter name
     * @return Parameter value.
     * @example $redis->getOption(Redis::OPT_SERIALIZER);   // return Redis::SERIALIZER_NONE, Redis::SERIALIZER_PHP, or Redis::SERIALIZER_IGBINARY.
     */
    public function getOption($name) {}
    
    /**
     * Check the current connection status
     * 
     * @return string STRING: +PONG on success. Throws a RedisException object on connectivity error, as described above.
     */
    public function ping() {}
    
    
    /**
     * Get the value related to the specified key
     * 
     * @param type $key
     * @return String or Bool: If key didn't exist, FALSE is returned. Otherwise, the value related to this key is returned.
     * @example $redis->get('key');
     */
    public function get($key) {}
    
    
    /**
     * Set the string value in argument as value of the key.
     * 
     * @param string    $key
     * @param string    $value
     * @param float     $timeout    Calling SETEX is preferred if you want a timeout.
     * @return Bool TRUE if the command is successful.
     * @example $redis->set('key', 'value');
     */
    public function set($key, $value, $timeout = 0) {}
    
    /**
     * Set the string value in argument as value of the key, with a time to live.
     * 
     * @param string    $key    
     * @param int       $ttl
     * @param type      $value 
     * @return          Bool TRUE if the command is successful.
     * @example         $redis->setex('key', 3600, 'value'); // sets key → value, with 1h TTL.
     */
    public function setex($key, $ttl, $value) {}
    
    /**
     * Set the string value in argument as value of the key if the key doesn't already exist in the database.
     * 
     * @param type $key
     * @param type $value 
     * @return Bool TRUE in case of success, FALSE in case of failure.
     * @example $redis->setnx('key', 'value');  // return TRUE
     * @example  $redis->setnx('key', 'value'); // return FALSE
     */
    public function setnx($key, $value) {}
    
    /**
     * Remove specified keys.
     * 
     * @param int | array $key1 An array of keys, or an undefined number of parameters, each a key: key1 key2 key3 ... keyN
     * @param type $key2 ... 
     * @param type $key3 ... 
     * @return Long Number of keys deleted.
     * @example 
     * $redis->set('key1', 'val1');
     * $redis->set('key2', 'val2');
     * $redis->set('key3', 'val3');
     * $redis->set('key4', 'val4'); 
     * $redis->delete('key1', 'key2'); // return 2
     * $redis->delete(array('key3', 'key4')); // return 2
     */
    public function del($key1, $key2 = NULL, $key3 = NULL) {}
    
    /**
     * @see del()
     */
    public function delete($key1, $key2 = NULL, $key3 = NULL) {}
    
    /**
     * Enter and exit transactional mode.
     * 
     * @param Redis::MULTI | Redis::PIPELINE Defaults to Redis::MULTI. A Redis::MULTI block of commands runs as a single transaction; a Redis::PIPELINE block is simply transmitted faster to the server, but without any guarantee of atomicity. discard cancels a transaction.
     * @return multi() returns the Redis instance and enters multi-mode. Once in multi-mode, all subsequent method calls return the same object until exec() is called.
     * @example
     * $ret = $redis->multi()
     *      ->set('key1', 'val1')
     *      ->get('key1')
     *      ->set('key2', 'val2')
     *      ->get('key2')
     *      ->exec();
     * 
     * //$ret == array (
     * //    0 => TRUE,
     * //    1 => 'val1',
     * //    2 => TRUE,
     * //    3 => 'val2');
     */
    public function multi() {}

    /**
     * @see multi()
     */
    public function exec() {}

    /**
     * @see multi()
     */
    public function discard() {}

    /**
     * Watches a key for modifications by another client. If the key is modified between WATCH and EXEC, the MULTI/EXEC transaction will fail (return FALSE). unwatch cancels all the watching of all keys by this client.
     * @param string | array $key: a list of keys
     * @return void
     * @example
     * $redis->watch('x');
     * // long code here during the execution of which other clients could well modify `x`
     * $ret = $redis->multi()
     *          ->incr('x')
     *          ->exec();
     * // $ret = FALSE if x has been modified between the call to WATCH and the call to EXEC.
     */
    public function watch($key) {}

    /**
     * @see watch()
     */
    public function unwatch() {}
    
    /**
     * Subscribe to channels. Warning: this function will probably change in the future.
     *
     * @param array             $channels an array of channels to subscribe to
     * @param string | array    $callback either a string or an array($instance, 'method_name'). The callback function receives 3 parameters: the redis instance, the channel name, and the message.
     * @example
     * function f($redis, $chan, $msg) {
     *  switch($chan) {
     *      case 'chan-1':
     *          ...
     *          break;
     * 
     *      case 'chan-2':
     *                     ...
     *          break;
     * 
     *      case 'chan-2':
     *          ...
     *          break;
     *      }
     * }
     * 
     * $redis->subscribe(array('chan-1', 'chan-2', 'chan-3'), 'f'); // subscribe to 3 chans
     */
    public function subscribe($channels, $callback) {}
    
    /**
     * Publish messages to channels. Warning: this function will probably change in the future.
     * 
     * @param string $channel a channel to publish to
     * @param string $message string
     * @example $redis->publish('chan-1', 'hello, world!'); // send message.
     */
    public function publish($channel, $message) {}
    
    /**
     * Verify if the specified key exists.
     * 
     * @param string $key 
     * @return BOOL: If the key exists, return TRUE, otherwise return FALSE.
     * @example
     * $redis->set('key', 'value');
     * $redis->exists('key'); //  TRUE 
     * $redis->exists('NonExistingKey'); // FALSE
     */
    public function exists($key) {}
    
    /**
     * Increment the number stored at key by one. 
     * 
     * @param type $key 
     * @return INT the new value
     * @example
     * $redis->incr('key1'); // key1 didn't exists, set to 0 before the increment and now has the value 1 
     * $redis->incr('key1'); // 2
     * $redis->incr('key1'); // 3
     * $redis->incr('key1'); // 4
     */
    public function incr($key) {}
    
    /**
     * Increment the number stored at key by one. If the second argument is filled, it will be used as the integer value of the increment.
     * 
     * @param string    $key    key
     * @param int       $value  value that will be added to key (only for incrBy)
     * @return INT the new value
     * @example
     * $redis->incr('key1'); // key1 didn't exists, set to 0 before the increment and now has the value 1 
     * $redis->incr('key1'); // 2
     * $redis->incr('key1'); // 3
     * $redis->incr('key1'); // 4
     * $redis->incrBy('key1', 10); // 14
     */
    public function incrBy($key, $value) {}
    
    /**
     * Decrement the number stored at key by one.
     * 
     * @param string $key 
     * @return INT the new value
     * @example
     * $redis->decr('key1'); // key1 didn't exists, set to 0 before the increment and now has the value -1
     * $redis->decr('key1'); // -2
     * $redis->decr('key1'); // -3
     */
    public function decr($key) {}
    
    /**
     * Decrement the number stored at key by one. If the second argument is filled, it will be used as the integer value of the decrement.
     * 
     * @param string    $key 
     * @param int       $value  that will be substracted to key (only for decrBy)
     * @return INT the new value
     * @example
     * $redis->decr('key1'); // key1 didn't exists, set to 0 before the increment and now has the value -1
     * $redis->decr('key1'); // -2
     * $redis->decr('key1'); // -3
     * $redis->decrBy('key1', 10); // -13
     */
    public function decrBy($key, $value) {}
    
    /**
     * Get the values of all the specified keys. If one or more keys dont exist, the array will contain FALSE at the position of the key.
     * 
     * @param array $keys Array containing the list of the keys
     * @return Array: Array containing the values related to keys in argument
     * @example
     * $redis->set('key1', 'value1');
     * $redis->set('key2', 'value2');
     * $redis->set('key3', 'value3');
     * $redis->getMultiple(array('key1', 'key2', 'key3')); // array('value1', 'value2', 'value3');
     * $redis->getMultiple(array('key0', 'key1', 'key5')); // array(`FALSE`, 'value2', `FALSE`);
     */
    public function getMultiple(array $keys) {}
    
    /**
     * Adds the string value to the head (left) of the list. Creates the list if the key didn't exist. If the key exists and is not a list, FALSE is returned.
     * 
     * @param string $key
     * @param string $value String, value to push in key
     * @return LONG The new length of the list in case of success, FALSE in case of Failure.
     * @example 
     * $redis->delete('key1');
     * $redis->lPush('key1', 'C'); // returns 1
     * $redis->lPush('key1', 'B'); // returns 2
     * $redis->lPush('key1', 'A'); // returns 3
     * // key1 now points to the following list: [ 'A', 'B', 'C' ]
     */
    public function lPush($key, $value) {}
    
    /**
     * Adds the string value to the tail (right) of the list. Creates the list if the key didn't exist. If the key exists and is not a list, FALSE is returned.
     * 
     * @param string $key
     * @param string $value String, value to push in key
     * @return LONG The new length of the list in case of success, FALSE in case of Failure.
     * @example 
     * $redis->delete('key1');
     * $redis->rPush('key1', 'A'); // returns 1
     * $redis->rPush('key1', 'B'); // returns 2
     * $redis->rPush('key1', 'C'); // returns 3
     * // key1 now points to the following list: [ 'A', 'B', 'C' ]
     */
    public function rPush($key, $value) {}
    
    /**
     * Adds the string value to the head (left) of the list if the list exists.
     * 
     * @param type $key
     * @param type $value String, value to push in key
     * @return LONG The new length of the list in case of success, FALSE in case of Failure.
     * @example 
     * $redis->delete('key1');
     * $redis->lPushx('key1', 'A'); // returns 0
     * $redis->lPush('key1', 'A'); // returns 1
     * $redis->lPushx('key1', 'B'); // returns 2
     * $redis->lPushx('key1', 'C'); // returns 3
     * // key1 now points to the following list: [ 'A', 'B', 'C' ]
     */
    public function lPushx($key, $value) {}
    
    /**
     * Adds the string value to the tail (right) of the list if the ist exists. FALSE in case of Failure.
     * 
     * @param string $key
     * @param string $value String, value to push in key
     * @return LONG The new length of the list in case of success, FALSE in case of Failure.
     * @example
     * $redis->delete('key1');
     * $redis->rPushx('key1', 'A'); // returns 0
     * $redis->rPush('key1', 'A'); // returns 1
     * $redis->rPushx('key1', 'B'); // returns 2
     * $redis->rPushx('key1', 'C'); // returns 3
     * // key1 now points to the following list: [ 'A', 'B', 'C' ]
     */
    public function rPushx($key, $value) {}
    
    /**
     * Returns and removes the first element of the list.
     * 
     * @param type $key 
     * @return STRING if command executed successfully BOOL FALSE in case of failure (empty list)
     * @example 
     * $redis->rPush('key1', 'A');
     * $redis->rPush('key1', 'B');
     * $redis->rPush('key1', 'C'); // key1 => [ 'A', 'B', 'C' ]
     * $redis->lPop('key1'); // key1 => [ 'B', 'C' ]
     */
    public function lPop($key) {}
    
    /**
     * Returns and removes the last element of the list.
     * 
     * @param type $key 
     * @return STRING if command executed successfully BOOL FALSE in case of failure (empty list)
     * @example 
     * $redis->rPush('key1', 'A');
     * $redis->rPush('key1', 'B');
     * $redis->rPush('key1', 'C'); // key1 => [ 'A', 'B', 'C' ]
     * $redis->rPop('key1'); // key1 => [ 'A', 'B' ]
     */
    public function rPop($key) {}
    
    /**
     * Is a blocking lPop(rPop) primitive. If at least one of the lists contains at least one element, the element will be popped from the head of the list and returned to the caller. Il all the list identified by the keys passed in arguments are empty, blPop will block during the specified timeout until an element is pushed to one of those lists. This element will be popped.
     * 
     * @param array $keys Array containing the keys of the lists INTEGER Timeout Or STRING Key1 STRING Key2 STRING Key3 ... STRING Keyn INTEGER Timeout
     * @return ARRAY array('listName', 'element')
     * @example
     * // Non blocking feature
     * $redis->lPush('key1', 'A');
     * $redis->delete('key2');
     * 
     * $redis->blPop('key1', 'key2', 10); // array('key1', 'A')
     * // OR
     * $redis->blPop(array('key1', 'key2'), 10); // array('key1', 'A')
     * 
     * $redis->brPop('key1', 'key2', 10); // array('key1', 'A')
     * // OR
     * $redis->brPop(array('key1', 'key2'), 10); // array('key1', 'A')
     * 
     * // Blocking feature
     * 
     * // process 1
     * $redis->delete('key1');
     * $redis->blPop('key1', 10);
     * // blocking for 10 seconds
     * 
     * // process 2
     * $redis->lPush('key1', 'A');
     * 
     * // process 1
     * // array('key1', 'A') is returned
     */
    public function blPop(array $keys) {}
    
    
    
    
    
    
    
    
}