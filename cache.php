<?php

class CacheService {
    private $redis;

    public function __construct() {
        // Initialize your Redis connection
        $this->redis = new Redis();
        $redisHost = $_SERVER['REDIS_HOST'];
        $redisPort = $_SERVER['REDIS_PORT'];
        echo $_SERVER['REDIS_HOST'];
        echo $_SERVER['REDIS_PORT'];

        try {
            $this->redis->connect($redisHost, $redisPort);
            echo "Connected to Redis successfully.";
        } catch (RedisException $e) {
            echo "Failed to connect to Redis: " . $e->getMessage();
        }
    }

    public function getFromCacheOrDatabase($query, $callback, $ttl = 3600) {
        // convert query into key
        $key = md5($query);
        // Check if the data is in the cache
        $cachedData = $this->redis->get($key);

        if ($cachedData !== false) {
            return json_decode($cachedData, true);
        } else {
            // Data not found in cache, execute the callback function to fetch it
            $data = $callback();

            // Store the fetched data in the cache for future use
            $this->redis->set($key, $ttl, json_encode($data));

            return $data;
        }
    }
}

?>