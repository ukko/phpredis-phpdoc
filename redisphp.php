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
     * Is a blocking lPop primitive. If at least one of the lists contains at least one element,
     * the element will be popped from the head of the list and returned to the caller.
     * Il all the list identified by the keys passed in arguments are empty, blPop will block
     * during the specified timeout until an element is pushed to one of those lists. This element will be popped.
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

    /**
     * Is a blocking rPop primitive. If at least one of the lists contains at least one element,
     * the element will be popped from the head of the list and returned to the caller.
     * Il all the list identified by the keys passed in arguments are empty, brPop will
     * block during the specified timeout until an element is pushed to one of those lists. T
     * his element will be popped.
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
    public function brPop(array $keys) {}


    /**
     * Returns the size of a list identified by Key. If the list didn't exist or is empty,
     * the command returns 0. If the data type identified by Key is not a list, the command return FALSE.
     *
     * @param type $key
     * @return LONG The size of the list identified by Key exists.
     * BOOL FALSE if the data type identified by Key is not list
     * @example
     * $redis->rPush('key1', 'A');
     * $redis->rPush('key1', 'B');
     * $redis->rPush('key1', 'C'); // key1 => [ 'A', 'B', 'C' ]
     * $redis->lSize('key1');// 3
     * $redis->rPop('key1');
     * $redis->lSize('key1');// 2
     */
    public function lSize($key) {}


    /**
     * Return the specified element of the list stored at the specified key.
     * 0 the first element, 1 the second ... -1 the last element, -2 the penultimate ...
     * Return FALSE in case of a bad index or a key that doesn't point to a list.
     * @param string    $key
     * @param int       $index
     * @return String the element at this index
     * Bool FALSE if the key identifies a non-string data type, or no value corresponds to this index in the list Key.
     * @example
     * $redis->rPush('key1', 'A');
     * $redis->rPush('key1', 'B');
     * $redis->rPush('key1', 'C'); // key1 => [ 'A', 'B', 'C' ]
     * $redis->lGet('key1', 0); // 'A'
     * $redis->lGet('key1', -1); // 'C'
     * $redis->lGet('key1', 10); // `FALSE`
     */
    public function lIndex($key, $index) {}

    /**
     * @see lIndex()
     */
    public function lGet($key, $index) {}


    /**
     * Set the list at index with the new value.
     *
     * @param string    $key
     * @param int       $index
     * @param type      $value
     * @return BOOL TRUE if the new value is setted. FALSE if the index is out of range, or data type identified by key is not a list.
     * @example
     * $redis->rPush('key1', 'A');
     * $redis->rPush('key1', 'B');
     * $redis->rPush('key1', 'C'); // key1 => [ 'A', 'B', 'C' ]
     * $redis->lGet('key1', 0); // 'A'
     * $redis->lSet('key1', 0, 'X');
     * $redis->lGet('key1', 0); // 'X'
     */
    public function lSet($key, $index, $value) {}


    /**
     * Returns the specified elements of the list stored at the specified key in
     * the range [start, end]. start and stop are interpretated as indices: 0 the first element,
     * 1 the second ... -1 the last element, -2 the penultimate ...
     * @param string    $key
     * @param int       $start
     * @param int       $end
     * @return Array containing the values in specified range.
     * @example
     * $redis->rPush('key1', 'A');
     * $redis->rPush('key1', 'B');
     * $redis->rPush('key1', 'C');
     * $redis->lRange('key1', 0, -1); // array('A', 'B', 'C')
     */
    public function lRange($key, $start, $end) {}

    /**
     * @see lRange()
     */
    public function lGetRange($key, $start, $end) {}


    /**
     * Trims an existing list so that it will contain only a specified range of elements.
     *
     * @param string    $key
     * @param int       $start
     * @param int       $stop
     * @return Array
     * Bool return FALSE if the key identify a non-list value.
     * @example
     * $redis->rPush('key1', 'A');
     * $redis->rPush('key1', 'B');
     * $redis->rPush('key1', 'C');
     * $redis->lRange('key1', 0, -1); // array('A', 'B', 'C')
     * $redis->lTrim('key1', 0, 1);
     * $redis->lRange('key1', 0, -1); // array('A', 'B')
     */
    public function lTrim($key, $start, $stop) {}

    /**
     * @see lTrim()
     */
    public function listTrim($key, $start, $stop) {}


    /**
     * Removes the first count occurences of the value element from the list.
     * If count is zero, all the matching elements are removed. If count is negative,
     * elements are removed from tail to head.
     *
     * @param string    $key
     * @param type      $value
     * @param int       $count
     * @return LONG the number of elements to remove
     * BOOL FALSE if the value identified by key is not a list.
     * @example
     * $redis->lPush('key1', 'A');
     * $redis->lPush('key1', 'B');
     * $redis->lPush('key1', 'C');
     * $redis->lPush('key1', 'A');
     * $redis->lPush('key1', 'A');
     *
     * $redis->lRange('key1', 0, -1); // array('A', 'A', 'C', 'B', 'A')
     * $redis->lRem('key1', 'A', 2); // 2
     * $redis->lRange('key1', 0, -1); // array('C', 'B', 'A')
     */
    public function lRem($key, $value, $count) {}

    /**
     * @see lRem
     */
    public function lRemove($key, $value, $count) {}


    /**
     * Insert value in the list before or after the pivot value. the parameter options
     * specify the position of the insert (before or after). If the list didn't exists,
     * or the pivot didn't exists, the value is not inserted.
     *
     * @param string    $key
     * @param type      $position Redis::BEFORE | Redis::AFTER
     * @param string    $pivot
     * @param type      $value
     * @return The number of the elements in the list, -1 if the pivot didn't exists.
     * @example
     * $redis->delete('key1');
     * $redis->lInsert('key1', Redis::AFTER, 'A', 'X'); // 0
     *
     * $redis->lPush('key1', 'A');
     * $redis->lPush('key1', 'B');
     * $redis->lPush('key1', 'C');
     *
     * $redis->lInsert('key1', Redis::BEFORE, 'C', 'X'); // 4
     * $redis->lRange('key1', 0, -1); // array('A', 'B', 'X', 'C')
     *
     * $redis->lInsert('key1', Redis::AFTER, 'C', 'Y'); // 5
     * $redis->lRange('key1', 0, -1); // array('A', 'B', 'X', 'C', 'Y')
     *
     * $redis->lInsert('key1', Redis::AFTER, 'W', 'value'); // -1
     */
    public function lInsert($key, $position, $pivot, $value) {}


    /**
     * Adds a value to the set value stored at key. If this value is already in the set, FALSE is returned.
     *
     * @param string    $key
     * @param type      $value
     * @return BOOL TRUE if value didn't exist and was added successfully, FALSE if the value is already present.
     * @example
     * $redis->sAdd('key1' , 'set1'); // TRUE, 'key1' => {'set1'}
     * $redis->sAdd('key1' , 'set2'); // TRUE, 'key1' => {'set1', 'set2'}
     * $redis->sAdd('key1' , 'set2'); // FALSE, 'key1' => {'set1', 'set2'}
     */
    public function sAdd($key, $value) {}


    /**
     * Removes the specified member from the set value stored at key.
     *
     * @param string $key
     * @param string $member
     * @return BOOL TRUE if the member was present in the set, FALSE if it didn't.
     * @example
     * $redis->sAdd('key1' , 'set1');
     * $redis->sAdd('key1' , 'set2');
     * $redis->sAdd('key1' , 'set3'); // 'key1' => {'set1', 'set2', 'set3'}
     * $redis->sRem('key1', 'set2');  // 'key1' => {'set1', 'set3'}
     */
    public function sRem($key, $member) {}

    /**
     * @see sRem()
     */
    public function sRemove($key, $member) {}


    /**
     * Moves the specified member from the set at srcKey to the set at dstKey.
     *
     * @param type $srcKey
     * @param type $dstKey
     * @param type $member
     * @return BOOL If the operation is successful, return TRUE.
     * If the srcKey and/or dstKey didn't exist, and/or the member didn't exist in srcKey, FALSE is returned.
     * @example
     * $redis->sAdd('key1' , 'set11');
     * $redis->sAdd('key1' , 'set12');
     * $redis->sAdd('key1' , 'set13');          // 'key1' => {'set11', 'set12', 'set13'}
     * $redis->sAdd('key2' , 'set21');
     * $redis->sAdd('key2' , 'set22');          // 'key2' => {'set21', 'set22'}
     * $redis->sMove('key1', 'key2', 'set13');  // 'key1' =>  {'set11', 'set12'}
     *                                          // 'key2' =>  {'set21', 'set22', 'set13'}
     */
    public function sMove($srcKey, $dstKey, $member) {}


    /**
     * Checks if value is a member of the set stored at the key key.
     *
     * @param string    $key
     * @param type      $value
     * @return BOOL TRUE if value is a member of the set at key key, FALSE otherwise.
     * @example
     * $redis->sAdd('key1' , 'set1');
     * $redis->sAdd('key1' , 'set2');
     * $redis->sAdd('key1' , 'set3'); // 'key1' => {'set1', 'set2', 'set3'}
     *
     * $redis->sIsMember('key1', 'set1'); // TRUE
     * $redis->sIsMember('key1', 'setX'); // FALSE
     */
    public function sIsMember($key, $value) {}

    /**
     * @see sIsMember()
     */
    public function sContains($key, $value) {}

    /**
     * Returns the cardinality of the set identified by key.
     * @param type $key
     * @param type $value
     * @return LONG the cardinality of the set identified by key, 0 if the set doesn't exist.
     * @example
     * $redis->sAdd('key1' , 'set1');
     * $redis->sAdd('key1' , 'set2');
     * $redis->sAdd('key1' , 'set3');   // 'key1' => {'set1', 'set2', 'set3'}
     * $redis->sCard('key1');           // 3
     * $redis->sCard('keyX');           // 0
     */
    public function sCard($key, $value) {}


    /**
     * Removes and returns a random element from the set value at Key.
     * @param string $key
     * @return String "popped" value
     * Bool FALSE if set identified by key is empty or doesn't exist.
     * @example
     * $redis->sAdd('key1' , 'set1');
     * $redis->sAdd('key1' , 'set2');
     * $redis->sAdd('key1' , 'set3');   // 'key1' => {'set3', 'set1', 'set2'}
     * $redis->sPop('key1');            // 'set1', 'key1' => {'set3', 'set2'}
     * $redis->sPop('key1');            // 'set3', 'key1' => {'set2'}
     */
    public function sPop($key) {}


    /**
     * Returns a random element from the set value at Key, without removing it.
     * @param string $key
     * @return String value from the set
     * Bool FALSE if set identified by key is empty or doesn't exist.
     * @example
     * $redis->sAdd('key1' , 'set1');
     * $redis->sAdd('key1' , 'set2');
     * $redis->sAdd('key1' , 'set3');   // 'key1' => {'set3', 'set1', 'set2'}
     * $redis->sRandMember('key1');     // 'set1', 'key1' => {'set3', 'set1', 'set2'}
     * $redis->sRandMember('key1');     // 'set3', 'key1' => {'set3', 'set1', 'set2'}
     */
    public function sRandMember($key) {}

    /**
     * Returns the members of a set resulting from the intersection of all the sets
     * held at the specified keys. If just a single key is specified, then this command
     * produces the members of this set. If one of the keys is missing, FALSE is returned.
     *
     * @param type $key1  keys identifying the different sets on which we will apply the intersection.
     * @param type $key2  ...
     * @param type $keyN  ...
     * @return Array, contain the result of the intersection between those keys.
     * If the intersection beteen the different sets is empty, the return value will be empty array.
     * @example
     * $redis->sAdd('key1', 'val1');
     * $redis->sAdd('key1', 'val2');
     * $redis->sAdd('key1', 'val3');
     * $redis->sAdd('key1', 'val4');
     *
     * $redis->sAdd('key2', 'val3');
     * $redis->sAdd('key2', 'val4');
     *
     * $redis->sAdd('key3', 'val3');
     * $redis->sAdd('key3', 'val4');
     *
     * var_dump($redis->sInter('key1', 'key2', 'key3'));
     *
     * //array(2) {
     * //  [0]=>
     * //  string(4) "val4"
     * //  [1]=>
     * //  string(4) "val3"
     * //}
     */
    public function sInter($key1, $key2, $keyN) {}

    /**
     * Performs a sInter command and stores the result in a new set.
     *
     * @param type $dstKey the key to store the diff into.
     * @param type $key1 are intersected as in sInter.
     * @param type $key2 ...
     * @param type $keyN ...
     * @return INTEGER: The cardinality of the resulting set, or FALSE in case of a missing key.
     * @example
     * $redis->sAdd('key1', 'val1');
     * $redis->sAdd('key1', 'val2');
     * $redis->sAdd('key1', 'val3');
     * $redis->sAdd('key1', 'val4');
     *
     * $redis->sAdd('key2', 'val3');
     * $redis->sAdd('key2', 'val4');
     *
     * $redis->sAdd('key3', 'val3');
     * $redis->sAdd('key3', 'val4');
     *
     * var_dump($redis->sInterStore('output', 'key1', 'key2', 'key3'));
     * var_dump($redis->sMembers('output'));
     *
     * //int(2)
     * //
     * //array(2) {
     * //  [0]=>
     * //  string(4) "val4"
     * //  [1]=>
     * //  string(4) "val3"
     * //}
     */
    public function sInterStore($dstKey, $key1, $key2, $keyN) {}

    /**
     * Performs the union between N sets and returns it.
     *
     * @param type $key1 Any number of keys corresponding to sets in redis.
     * @param type $key2 ...
     * @param type $keyN ...
     * @return Array of strings: The union of all these sets.
     * @example
     * $redis->delete('s0', 's1', 's2');
     *
     * $redis->sAdd('s0', '1');
     * $redis->sAdd('s0', '2');
     * $redis->sAdd('s1', '3');
     * $redis->sAdd('s1', '1');
     * $redis->sAdd('s2', '3');
     * $redis->sAdd('s2', '4');
     *
     * var_dump($redis->sUnion('s0', 's1', 's2'));
     *
     * array(4) {
     * //  [0]=>
     * //  string(1) "3"
     * //  [1]=>
     * //  string(1) "4"
     * //  [2]=>
     * //  string(1) "1"
     * //  [3]=>
     * //  string(1) "2"
     * //}
     */
    public function sUnion($key1, $key2, $keyN) {}

    /**
     * Performs the same action as sUnion, but stores the result in the first key
     *
     * @param type $dstKey  the key to store the diff into.
     * @param type $key1    Any number of keys corresponding to sets in redis.
     * @param type $key2    ...
     * @param type $keyN    ...
     * @return Any number of keys corresponding to sets in redis.
     * @example
     * $redis->delete('s0', 's1', 's2');
     *
     * $redis->sAdd('s0', '1');
     * $redis->sAdd('s0', '2');
     * $redis->sAdd('s1', '3');
     * $redis->sAdd('s1', '1');
     * $redis->sAdd('s2', '3');
     * $redis->sAdd('s2', '4');
     *
     * var_dump($redis->sUnionStore('dst', 's0', 's1', 's2'));
     * var_dump($redis->sMembers('dst'));
     *
     * //int(4)
     * //array(4) {
     * //  [0]=>
     * //  string(1) "3"
     * //  [1]=>
     * //  string(1) "4"
     * //  [2]=>
     * //  string(1) "1"
     * //  [3]=>
     * //  string(1) "2"
     * //}
     */
    public function sUnionStore($dstKey, $key1, $key2, $keyN) {}

    /**
     * Performs the difference between N sets and returns it.
     *
     * @param string $key1 Any number of keys corresponding to sets in redis.
     * @param string $key2 ...
     * @param string $keyN ...
     * @return Array of strings: The difference of the first set will all the others.
     * @example
     * $redis->delete('s0', 's1', 's2');
     *
     * $redis->sAdd('s0', '1');
     * $redis->sAdd('s0', '2');
     * $redis->sAdd('s0', '3');
     * $redis->sAdd('s0', '4');
     *
     * $redis->sAdd('s1', '1');
     * $redis->sAdd('s2', '3');
     *
     * var_dump($redis->sDiff('s0', 's1', 's2'));
     *
     * //array(2) {
     * //  [0]=>
     * //  string(1) "4"
     * //  [1]=>
     * //  string(1) "2"
     * //}
     */
    public function sDiff($key1, $key2, $keyN) {}

    /**
     * Performs the same action as sDiff, but stores the result in the first key
     *
     * @param string $dstKey    the key to store the diff into.
     * @param string $key1      Any number of keys corresponding to sets in redis
     * @param string $key2      ...
     * @param string $keyN      ...
     * @return  INTEGER: The cardinality of the resulting set, or FALSE in case of a missing key.
     * @example
     * $redis->delete('s0', 's1', 's2');
     *
     * $redis->sAdd('s0', '1');
     * $redis->sAdd('s0', '2');
     * $redis->sAdd('s0', '3');
     * $redis->sAdd('s0', '4');
     *
     * $redis->sAdd('s1', '1');
     * $redis->sAdd('s2', '3');
     *
     * var_dump($redis->sDiffStore('dst', 's0', 's1', 's2'));
     * var_dump($redis->sMembers('dst'));
     *
     * //int(2)
     * //array(2) {
     * //  [0]=>
     * //  string(1) "4"
     * //  [1]=>
     * //  string(1) "2"
     * //}
     */
    public function sDiffStore($dstKey, $key1, $key2, $keyN) {}

    /**
     * Returns the contents of a set.
     *
     * @param type $key
     * @return An array of elements, the contents of the set.
     * @example
     * $redis->delete('s');
     * $redis->sAdd('s', 'a');
     * $redis->sAdd('s', 'b');
     * $redis->sAdd('s', 'a');
     * $redis->sAdd('s', 'c');
     * var_dump($redis->sMembers('s'));
     *
     * //array(3) {
     * //  [0]=>
     * //  string(1) "c"
     * //  [1]=>
     * //  string(1) "a"
     * //  [2]=>
     * //  string(1) "b"
     * //}
     * // The order is random and corresponds to redis' own internal representation of the set structure.
     */
    public function sMembers($key) {}

    /**
     * @see sMembers()
     */
    public function sGetMembers($key) {}

    /**
     * Sets a value and returns the previous entry at that key.
     *
     * @param string $key
     * @param string $value
     * @return A string, the previous value located at this key.
     * @example
     * $redis->set('x', '42');
     * $exValue = $redis->getSet('x', 'lol');   // return '42', replaces x by 'lol'
     * $newValue = $redis->get('x')'            // return 'lol'
     */
    public function getSet($key, $value) {}

    /**
     * Returns a random key.
     *
     * @return STRING: an existing key in redis.
     * @example
     * $key = $redis->randomKey();
     * $surprise = $redis->get($key);  // who knows what's in there.
     */
    public function randomKey() {}


    /**
     * Switches to a given database.
     *
     * @param int $dbindex
     * @return TRUE in case of success, FALSE in case of failure.
     * @example
     * $redis->select(0);  // switch to DB 0
     * $redis->set('x', '42'); // write 42 to x
     * $redis->move('x', 1);   // move to DB 1
     * $redis->select(1);  // switch to DB 1
     * $redis->get('x');   // will return 42
     */
    public function select($dbindex) {}

    /**
     * Moves a key to a different database.
     *
     * @param string    $key
     * @param int       $dbindex
     * @return BOOL: TRUE in case of success, FALSE in case of failure.
     * @example
     * $redis->select(0);  // switch to DB 0
     * $redis->set('x', '42'); // write 42 to x
     * $redis->move('x', 1);   // move to DB 1
     * $redis->select(1);  // switch to DB 1
     * $redis->get('x');   // will return 42
     */
    public function move($key, $dbindex) {}

    /**
     * Renames a key.
     *
     * @param string $srcKey
     * @param string $dstKey
     * @return BOOL: TRUE in case of success, FALSE in case of failure.
     * @example
     * $redis->set('x', '42');
     * $redis->rename('x', 'y');
     * $redis->get('y');   // → 42
     * $redis->get('x');   // → `FALSE`
     */
    public function rename($srcKey, $dstKey) {}

    /**
     * @see rename()
     */
    public function renameKey($srcKey, $dstKey) {}

    /**
     * Renames a key.
     * 
     * Same as rename, but will not replace a key if the destination already exists.
     * This is the same behaviour as setNx.
     *
     * @param string $srcKey
     * @param string $dstKey
     * @return BOOL: TRUE in case of success, FALSE in case of failure.
     * @example
     * $redis->set('x', '42');
     * $redis->rename('x', 'y');
     * $redis->get('y');   // → 42
     * $redis->get('x');   // → `FALSE`
     */
    public function renameNx($srcKey, $dstKey) {}
    
    /**
     * Sets an expiration date (a timeout) on an item.
     * @param string    $key    The key that will disappear.
     * @param int       $ttl    The key's remaining Time To Live, in seconds.
     * @return bool: TRUE in case of success, FALSE in case of failure.
     * @example
     * $redis->set('x', '42');
     * $redis->setTimeout('x', 3);  // x will disappear in 3 seconds.
     * sleep(5);                    // wait 5 seconds
     * $redis->get('x');            // will return `FALSE`, as 'x' has expired.
     */
    public function setTimeout($key, $ttl) {}
    
    /**
     * @see setTimeout()
     */
    public function expire($key, $ttl) {}
    
    /**
     * Sets an expiration date (a timestamp) on an item.
     * @param strin     $key        The key that will disappear.
     * @param integer   $timestamp  Unix timestamp. The key's date of death, in seconds from Epoch time.
     * @return bool: TRUE in case of success, FALSE in case of failure.
     * @example
     * $redis->set('x', '42');
     * $now = time(NULL);               // current timestamp
     * $redis->expireAt('x', $now + 3); // x will disappear in 3 seconds.
     * sleep(5);                        // wait 5 seconds
     * $redis->get('x');                // will return `FALSE`, as 'x' has expired.
     */
    public function expireAt($key, $timestamp) {}
    
    /**
     * Returns the keys that match a certain pattern.
     * @param string $pattern pattern, using '*' as a wildcard.
     * @return Array of STRING: The keys that match a certain pattern.
     * @example
     * $allKeys = $redis->keys('*');   // all keys will match this.
     * $keyWithUserPrefix = $redis->keys('user*');
     */
    public function keys($pattern) {}
    
    /**
     * @see keys()
     */
    public function getKeys($pattern) {}

    /**
     * Returns the current database's size.
     * @return INTEGER: DB size, in number of keys.
     * @example
     * $count = $redis->dbSize();
     * echo "Redis has $count keys\n";
     */
    public function dbSize() {}
    
    /**
     * Authenticate the connection using a password. 
     * Warning: The password is sent in plain-text over the network.
     * @param string $password
     * @return BOOL: TRUE if the connection is authenticated, FALSE otherwise.
     * @example
     * $redis->auth('foobared');
     */
    public function auth($password) {}
    
    /**
     * Starts the background rewrite of AOF (Append-Only File)
     * @return BOOL: TRUE in case of success, FALSE in case of failure.
     * @example
     * $redis->bgrewriteaof();
     */
    public function bgrewriteaof() {}
    
    /**
     * Changes the slave status
     * Either host and port, or no parameter to stop being a slave.
     * @param string    $host [optional]
     * @param int       $port [optional]
     * @return BOOL: TRUE in case of success, FALSE in case of failure.
     * @example
     * $redis->slaveof('10.0.1.7', 6379);
     * // ... 
     * $redis->slaveof();
     */
    public function slaveof($host = '', $port = '') {}
    
    /**
     * Describes the object pointed to by a key.
     * The information to retrieve (string) and the key (string). 
     * Info can be one of the following:
     * - "encoding"
     * - "refcount"
     * - "idletime"
     * 
     * @param string $key
     * @param string $value
     * @return STRING for "encoding", LONG for "refcount" and "idletime", FALSE if the key doesn't exist.
     * @example
     * $redis->object("encoding", "l"); // → ziplist
     * $redis->object("refcount", "l"); // → 1
     * $redis->object("idletime", "l"); // → 400 (in seconds, with a precision of 10 seconds).
     */
    public function object($key = '', $value = '') {}
    
    /**
     * Performs a synchronous save.
     * @return BOOL: TRUE in case of success, FALSE in case of failure. 
     * If a save is already running, this command will fail and return FALSE.
     * @example
     * $redis->save();
     */
    public function save() {}
    
    /**
     * Performs a background save.
     * @return BOOL: TRUE in case of success, FALSE in case of failure. 
     * If a save is already running, this command will fail and return FALSE.
     * @example
     * $redis->bgSave();
     */
    public function bgsave() {}
    
    /**
     * Returns the timestamp of the last disk save.
     * @return INT: timestamp.
     * @example
     * $redis->lastSave();
     */
    public function lastSave() {}
    
    
    /**
     * Returns the type of data pointed by a given key.
     * @param string $key
     * @return Depending on the type of the data pointed by the key, 
     * this method will return the following value:
     * - string: Redis::REDIS_STRING
     * - set: Redis::REDIS_SET
     * - list: Redis::REDIS_LIST
     * - zset: Redis::REDIS_ZSET
     * - hash: Redis::REDIS_HASH
     * - other: Redis::REDIS_NOT_FOUND 
     * @example
     * $redis->type('key');
     */
    public function type() {}
    
    /**
     * Append specified string to the string stored in specified key.
     * @param string $key 
     * @param string $value
     * @return INTEGER: Size of the value after the append
     * @example
     * $redis->set('key', 'value1');
     * $redis->append('key', 'value2'); // 12
     * $redis->get('key');              // 'value1value2'
     */
    public function append() {}





}
