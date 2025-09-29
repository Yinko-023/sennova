<?php
/**
 * Sistema de contadores por cliente
 * Mantiene el mismo ID de cliente para todos los formularios de un mismo cliente
 */

class ClientCounter {
    private static $counterDir;
    private static $clientCounterFile;
    
    public static function init() {
        $root = dirname(__DIR__, 2);
        self::$counterDir = $root . '/sennova/storage/counters';
        self::$clientCounterFile = self::$counterDir . '/client_counter.counter';
        
        if (!is_dir(self::$counterDir)) {
            @mkdir(self::$counterDir, 0775, true);
        }
    }
    
    /**
     * Obtiene el siguiente número de cliente disponible
     * @return int
     */
    public static function getNextClientId(): int {
        self::init();
        
        $readCounter = function (): int {
            if (!is_file(self::$clientCounterFile)) return 0;
            $v = @file_get_contents(self::$clientCounterFile);
            $n = is_string($v) ? (int)trim($v) : 0;
            return max(0, $n);
        };
        
        $saveCounter = function (int $n): void {
            @file_put_contents(self::$clientCounterFile, (string)max(0, $n), LOCK_EX);
        };
        
        $current = $readCounter();
        $next = $current + 1;
        $saveCounter($next);
        
        return $next;
    }
    
    /**
     * Obtiene el ID de cliente actual sin incrementarlo
     * @return int
     */
    public static function getCurrentClientId(): int {
        self::init();
        
        if (!is_file(self::$clientCounterFile)) return 0;
        $v = @file_get_contents(self::$clientCounterFile);
        $n = is_string($v) ? (int)trim($v) : 0;
        return max(0, $n);
    }
    
    /**
     * Establece un ID de cliente específico (para casos especiales)
     * @param int $clientId
     */
    public static function setClientId(int $clientId): void {
        self::init();
        
        $saveCounter = function (int $n): void {
            @file_put_contents(self::$clientCounterFile, (string)max(0, $n), LOCK_EX);
        };
        
        $saveCounter($clientId);
    }
    
    /**
     * Reinicia el contador de clientes a 0
     */
    public static function resetClientCounter(): void {
        self::init();
        @file_put_contents(self::$clientCounterFile, '0', LOCK_EX);
    }
    
    /**
     * Formatea el ID de cliente con ceros a la izquierda
     * @param int $clientId
     * @return string
     */
    public static function formatClientId(int $clientId): string {
        return sprintf('%04d', max(0, $clientId));
    }
}
