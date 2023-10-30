<?php

class CacheService {
    private $redis;

    public function __construct() {
        // read env filezzz
        $envFilePath = __DIR__ . '../properties.env';

        if (file_exists($envFilePath)) {
            $lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                putenv("$key=$value");
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
        // Initialize your Redis connection
        $this->redis = new Redis();
        $redisHost = $_ENV['REDIS_HOST'];
        $redisPort = $_ENV['REDIS_PORT'];
        echo $_ENV['REDIS_HOST'];
        echo $_ENV['REDIS_PORT'];

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