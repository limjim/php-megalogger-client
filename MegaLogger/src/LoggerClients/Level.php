<?php

namespace LoggerClients;

class Level {
    const LEVEL_INFO = 'info';
    const LEVEL_DEBUG = 'debug';
    const LEVEL_WARNING = 'warning';
    const LEVEL_ERROR = 'error';
    const LEVEL_CRITICAL = 'critical';

    public function getLevelInfo() {
        return self::LEVEL_INFO;
    }

    public function getLevelDebug() {
        return self::LEVEL_DEBUG;
    }

    public function getLevelWarning() {
        return self::LEVEL_WARNING;
    }

    public function getLevelCritial() {
        return self::LEVEL_CRITICAL;
    }

    public function getLevelError() {
        return self::LEVEL_ERROR;
    }

}
