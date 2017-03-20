<?php

namespace frontend\models;

use devmustafa\amqp\PhpAmqpLib\Connection\AMQPConnection;
use Yii;
use yii\mongodb\ActiveRecord;

/**
 * This is the model class for collection "zakaz".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $created
 * @property mixed $first_name
 * @property mixed $last_name
 * @property mixed $email
 * @property mixed $brand
 * @property mixed $product
 * @property integer $qty_item
 * @property double $sum_item
 * @property double $ttl_sum
 */
class Zakaz extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['test_task', 'zakaz'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'created',
            'first_name',
            'last_name',
            'email',
            'productItems',
            'qty_item',
            'sum_item',
            'brand',
            'product',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'first_name', 'last_name', 'email', 'brand', 'product', 'productItems'],
                'safe'
            ],
            [['created', 'first_name', 'last_name', 'email',
                'brand', 'product', 'productItems', 'qty_item', 'sum_item'],
                'required'
            ],
            [['qty_item'], 'integer'],
            [['sum_item'], 'double'],
            ['email', 'email'],
        ];
    }

    /**
     * Get nice Order Name
     * @return string
     */
    public function getOrderName()
    {
        return $this->created . ' by ' . $this->getFullName();
    }

    /**
     * Get Full Name
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get Total Sum of the Order
     * @return bool
     */
    public function getTtlSum()
    {
        $sum1 = $this->qty_item * $this->sum_item;
        return !empty($sum1);
    }

    /**
     * RabbitMQ
     * Function to send the messages to queue with Customer order details
     */
    public function rSend()
    {
        $fullName = $this->getFullName();
        $orderId = $this->primaryKey;
        $email = $this->email;

        $exchange = 'exchange';
        $queue = 'orderQueue';
        $dataArray = array("Order number: {$orderId}\\n Customer: {$fullName}\\n Email: {$email}");
        $message = serialize($dataArray);

        Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = true, $auto_delete = false);
        Yii::$app->amqp->declareQueue($queue, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
        Yii::$app->amqp->bindQueueExchanger($queue, $exchange, $routingKey = $queue);
        Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue, $content_type = 'applications/json', $app_id = Yii::$app->name);

    }

    /**
     * RabbitMQ
     * Function to receive the messages from queue
     */
    public function rReceive()
    {

        $exchange = 'exchange';
        $queue = 'orderQueue';
        $consumer_tag = 'consumers';

        $conn = new AMQPConnection('localhost', 5672, 'guest', 'guest', '/');
        $ch = $conn->channel();
        $ch->exchange_declare($exchange, 'direct', false, true, false);
        $ch->queue_bind($queue, $exchange);

        $processMessage = function ($msg) {
            $body = unserialize($msg->body);
        };

        $ch->basic_consume($queue, $consumer_tag, false, false, false, false, $processMessage);

        $shutdown = function ($ch, $conn) {
            $ch->close();
            $conn->close();
        };

        register_shutdown_function($shutdown, $ch, $conn);

        // Loop as long as the channel has callbacks registered
        while (count($ch->callbacks)) {
            $ch->wait();
        }
    }

}
