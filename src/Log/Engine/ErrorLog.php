<?php
namespace DebugKitErrorLog\Log\Engine;

use DebugKit\Log\Engine\DebugKitLog;

class ErrorLog extends DebugKitLog
{
    public function logWithTime($type, $message, $timestamp, array $context = [])
    {
        if (!isset($this->_logs[$type])) {
            $this->_logs[$type] = [];
        }
        $this->_logs[$type][] = [date('Y-m-d H:i:s', $timestamp), $this->_format($message)];
    }
}
