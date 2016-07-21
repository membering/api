<?php

class LogRequests extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $uri;

    /**
     *
     * @var string
     */
    public $input;

    /**
     *
     * @var string
     */
    public $output;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'log_requests';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return LogRequests[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return LogRequests
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
