<?php

interface Meanbee_ConfigPoweredCss_Model_LoggerInterface
{
    /**
     * System is unusable.
     *
     * @param string $message
     * @return null
     */
    public function emergency($message);

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @return null
     */
    public function alert($message);

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @return null
     */
    public function critical($message);

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @return null
     */
    public function error($message);

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @return null
     */
    public function warning($message);

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @return null
     */
    public function notice($message);

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @return null
     */
    public function info($message);

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @return null
     */
    public function debug($message);

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @return null
     */
    public function log($level, $message);
}