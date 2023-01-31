<?php

namespace Src\Exceptions;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ErrorHandler 
{
    protected $monolog;
    private $type = 0;
    protected $msg = '';
    protected $file = '';
    protected $line = 0;

    public function __construct(int $type, string $msg, ?string $file = null, ?int $line = null)
    {
        $this->monolog = new Logger('web');
        $this->monolog->pushHandler(new StreamHandler(__DIR__ . '/../../errors.log', Logger::WARNING));
        $this->monolog->pushProcessor(function ($record) {
            $record['extra']['HTTP_HOST'] = $_SERVER['HTTP_HOST'];
            $record['extra']['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
            $record['extra']['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'];
            $record['extra']['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];

            return $record; 
        });

        $this->type = $type;
        $this->msg = $msg;
        $this->file = $file;
        $this->line = $line;
    }

    public static function control(int $type, string $msg, ?string $file = null, ?int $line = null)
    {
        $instanse = new self($type, $msg, $file, $line);
        switch($type) {
            case E_ERROR:
                $instanse->errorControl();
                return 'E_ERROR';
            case E_WARNING:
                $instanse->warningControl();
                return 'E_WARNING';
            case E_PARSE:
                $instanse->errorControl();
                return 'E_PARSE';
            case E_NOTICE:
                $instanse->noticeControl();
                return 'E_NOTICE';
            case E_CORE_ERROR:
                $instanse->errorControl();
                return 'E_CORE_ERROR';
            case E_CORE_WARNING:
                $instanse->warningControl();
                return 'E_CORE_WARNING';
            case E_COMPILE_ERROR:
                $instanse->errorControl();
                return 'E_COMPILE_ERROR';
            case E_COMPILE_WARNING:
                $instanse->warningControl();
                return 'E_COMPILE_WARNING';
            case E_USER_ERROR:
                $instanse->errorControl();
                return 'E_USER_ERROR';
            case E_USER_WARNING:
                $instanse->warningControl();
                return 'E_USER_WARNING';
            case E_USER_NOTICE:
                $instanse->noticeControl();
                return 'E_USER_NOTICE';
            case E_STRICT:
                $instanse->errorControl();
                return 'E_STRICT';
            case E_DEPRECATED:
                $instanse->errorControl();
                return 'E_DEPRECATED';
            case E_USER_DEPRECATED:
                $instanse->errorControl();
                return 'E_USER_DEPRECATED';
        }
        return '';
    }

    public static function shutdown()
    {
        $lastError = error_get_last();
        if($lastError['type'] == E_ERROR) {
            self::control(E_ERROR, $lastError['message'], $lastError['file'], $lastError['line']);
        }
    }

    protected function errorControl(): void
    {
        $content = "Arquivo: {$this->file}, Linha: {$this->line}, Mensagem: {$this->msg}";
        $this->monolog->error($content, ['logger' => true]);
        header('Location: ' . url('erro/500'));
        exit();
    }

    protected function warningControl(): bool 
    {
        $content = "Arquivo: {$this->file}, Linha: {$this->line}, Mensagem: {$this->msg}";
        $this->monolog->warning($content, ['logger' => true]);

        return true;
    }

    protected function noticeControl(): bool 
    {
        $content = "Arquivo: {$this->file}, Linha: {$this->line}, Mensagem: {$this->msg}";
        $this->monolog->notice($content, ['logger' => true]);

        return true;
    }
}