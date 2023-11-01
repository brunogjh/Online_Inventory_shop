<?php
// Include the AWS SDK for PHP
require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Redis;
class CacheService {
    private $redis;

    public function __construct() {    
        // read env filezzz
        $s3 = new S3Client([
            'version'     => '2006-03-01',
            'region'      => 'ap-southeast-1'
        ]);

        // Specify the S3 bucket and file path
        $bucket = 'env-var-clothesio';
        $filePath = 'properties.env';
        
        // Read the contents of the file from S3
        $configContents = $s3->getObject([
            'Bucket' => $bucket,
            'Key'    => $filePath,
        ])['Body']->getContents();

        // Parse the contents as needed (e.g., into an array of key-value pairs)
        $config = parse_ini_string($configContents);

        // Initialize your Redis connection
        // Use Predis for Redis cluster support
        $this->redis = new Redis();
        $this->$redis->flushAll();
        $redisHost = $config['REDIS_HOST'];
        $redisPort = $config['REDIS_PORT'];
        echo $config['REDIS_HOST'];
        echo $config['REDIS_PORT'];

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
            echo "found in cache.";
            return json_decode($cachedData);
        } else {
            // Data not found in cache, execute the callback function to fetch it
            echo "not found in cache.";
            $data = $callback();

            // Store the fetched data in the cache for future use
            $this->redis->set($key, json_encode($data), $ttl);

            return $data;
        }
    }
}

?>