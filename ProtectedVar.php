<?php

/**
 * ProtectedVar
 * 
 * Позволяет защитить переменную от изменений для PHP 8.0.0+
 * https://github.com/deathscore13/ProtectedVar
 */

trait ProtectedVar
{
    private static mixed $var;
    
    /**
     * Установка/получение значения переменной
     */
    public static function __callStatic(string $name, array $arg): mixed
    {
        if (!isset(self::$var[$name]))
            self::$var[$name] = $arg[0];
        
        return self::$var[$name];
    }
}
