<?php
/**
 * @file all_in_one_demo.php
 * @desc 集成PDO、Redis、curl、RabbitMQ操作的测试用例
 * @author AI
 */

 require __DIR__ . '/vendor/autoload.php';

// PDO 测试
/**
 * 测试PDO数据库操作
 * @return void
 */
function test_pdo() {
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=test', 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('CREATE TABLE IF NOT EXISTS cat_demo (id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(32))');
        $pdo->exec("INSERT INTO cat_demo (name) VALUES ('catphp')");
        $stmt = $pdo->query('SELECT * FROM cat_demo');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "PDO查询结果：\n";
        print_r($rows);
    } catch (Exception $e) {
        echo "PDO异常: ", $e->getMessage(), "\n";
    }
}

test_pdo();

// Redis 测试
/**
 * 测试Redis操作
 * @return void
 */
function test_redis() {
    try {
        $redis = new Redis();
        $redis->connect('192.168.3.159', 16379);
        $redis->set('catphp_key', 'catphp_value');
        $val = $redis->get('catphp_key');
        echo "Redis读取：$val\n";
    } catch (Exception $e) {
        echo "Redis异常: ", $e->getMessage(), "\n";
    }
}

test_redis();

// curl 测试
/**
 * 测试curl请求
 * @return void
 */
function test_curl() {
    $url = 'http://192.168.3.110/curl_post.php';
    $data = ['foo' => 'bar'];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    if ($response === false) {
        echo "curl错误: ", curl_error($ch), "\n";
    } else {
        echo "curl响应: $response\n";
    }
    curl_close($ch);
}

test_curl();

// RabbitMQ 测试
/**
 * 测试RabbitMQ消息发送
 * @return void
 */
function test_rabbitmq() {
    try {
        if (!class_exists('PhpAmqpLib\Connection\AMQPStreamConnection')) {
            echo "未安装php-amqplib，跳过RabbitMQ测试\n";
            return;
        }
        $conn = new PhpAmqpLib\Connection\AMQPStreamConnection('192.168.3.159', 5672, 'root', 'devops666','admin_vhost');
        $channel = $conn->channel();
        $channel->queue_declare('catphp_queue', false, false, false, false);
        $msg = new PhpAmqpLib\Message\AMQPMessage('Hello CATPHP!');
        $channel->basic_publish($msg, '', 'catphp_queue');
        echo "RabbitMQ消息已发送\n";
        $channel->close();
        $conn->close();
    } catch (Exception $e) {
        echo "RabbitMQ异常: ", $e->getMessage(), "\n";
    }
}

test_rabbitmq(); 