<?php
$envFile = __DIR__ . 'properties.env';  // Specify the path to your .env file
if (file_exists($envFile)) {
    $env = parse_ini_file($envFile, false, INI_SCANNER_RAW);
    foreach ($env as $key => $value) {
        $_ENV[$key] = $value;
    }
}
class CacheService {
    private $redis;

    public function __construct() {
        // Initialize your Redis connection
        $this->redis = new Redis();
        $redisHost = $_ENV['REDIS_HOST'];
        $redisPort = $_ENV['REDIS_PORT'];
        $this->redis->connect($redisHost, $redisPort);// Use the actual connection details for your ElastiCache cluster
    }

    public function getFromCacheOrDatabase($query, $callback) {
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
            $this->redis->set($key, json_encode($data));

            return $data;
        }
    }
}

?>