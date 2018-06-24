<?php

/**
 * Class Emitter
 */
class Emitter
{
    /**
     * Store for subscriptions
     *
     * @var array
     */
    protected $store = [];

    /**
     * Создает экземпляр класса Emitter.
     * @memberof Emitter
     */
    public function __construct() {}

    /**
     * связывает обработчик с событием
     *
     * @param string event - событие
     * @param Handler handler - обработчик
     */
    public function on(string $event, $handler)
    {
        $this->setStoreByKey($event, $handler);
    }

    /**
     * Генерирует событие -- вызывает все обработчики, связанные с событием и
     *                       передает им аргумент data
     *
     * @param string event
     * @param mixed data
     *
     * @return void
     */
    public function emit(string $event, $data = null)
    {
        $store = $this->getStoreByKey($event);

        if ($store) {
            foreach ($store as $callback) {
                call_user_func($callback, $data);
            }
        }
    }

    /**
     * @param string $event
     *
     * @return void
     */
    public function unsubscribe(string $event)
    {
        $store = $this->getStore();

        if (array_key_exists($event, $store)) {
            unset($store[$event]);
            $this->setStore($store);
        }

    }

    /**
     * @param string $key
     *
     * @return bool|mixed
     */
    protected function getStoreByKey(string $key)
    {
        $store = $this->getStore();
        if (array_key_exists($key, $store)) {
            return $store[$key];
        }

        return false;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    protected function setStoreByKey(string $key, $value)
    {
        $this->store[$key][] = $value;
    }

    /**
     * @return array
     */
    protected function getStore()
    {
        return $this->store;
    }

    /**
     * @param mixed $value
     *
     * @return void
     */
    protected function setStore($value)
    {
        $this->store = $value;
    }
}
