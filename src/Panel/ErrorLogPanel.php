<?php
/**
 * ErrorLogPanel
 * @link    http://github.com/kcsoft
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace DebugKitErrorLog\Panel;

use DateTime;
use Cake\Log\Log;
use DebugKit\DebugPanel;
use DebugKitErrorLog\Log\Engine\ErrorLog;

class ErrorLogPanel extends DebugPanel
{
    public $plugin = 'DebugKitErrorLog';
    public $logEntries = 10;
    protected $logger;

    /**
     * Get the panel data
     *
     * @return array
     */
    public function data()
    {
        $this->logger = new ErrorLog();
        $errorLogConfig = Log::config('error');
        // 'className' => 'FileLog' // TODO: check engine?
        $logFilename = $errorLogConfig['path'] . $errorLogConfig['file'] . '.log';

        $file = fopen($logFilename, 'r');

        if ($file !== false) {
            $entries = 0;
            $offset = 0;
            $logContent = '';

            while (!feof($file)) {
                $content = fread($file, 8192);
                $logContent .= $content;
                $count = preg_match_all(
                    '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/',
                    $logContent,
                    $matches,
                    0,
                    $offset
                );
                $entries += $count;
                $offset += strlen($content) - 18; // datetime length - 1
                if ($entries > $this->logEntries) {
                    break;
                }
            }

            fclose($file);

            $entries = preg_match_all(
                '/(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})(?:[ ]+)([\S\s]+?)(?:\r\n|\n|\r){2,3}/',
                $logContent,
                $matches
            );

            foreach ($matches[1] as $index => $match) {
                if ($index >= $this->logEntries) {
                    break;
                }
                $date = DateTime::createFromFormat('Y-m-d H:i:s', $match);
                $this->logger->logWithTime('log', $matches[2][$index], $date->format('U'));
            }
        }
        return [
            'logger' => $this->logger
        ];
    }

    public function elementName()
    {
        return 'DebugKit.log_panel';
    }
}
