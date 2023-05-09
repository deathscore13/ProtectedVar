<?php

/**
 * ProtectedVar
 * 
 * Позволяет защитить переменную от изменений для PHP 8.0.0+
 * https://github.com/deathscore13/ProtectedVar
 */

trait ProtectedVar
{
    /**
     * Установка/получение значения переменной
     */
    public static function __callStatic(string $name, array $arg): mixed
    {
        static $var = [];
        static $clone = [];

        if (!isset($var[$name]))
        {
            if (!isset($arg[0]))
            {
                throw new Exception('Undefined variable "'.$name.'"');
                return null;
            }
            $var[$name] = $arg[0];

            if (isset($arg[1]) && $arg[1] === true)
                $clone[] = $name;
        }
        
        return in_array($name, $clone) ? (clone $var[$name]) : $var[$name];
    }
    
    /**
     * Проверяет существование переменной
     * 
     * @param string $name      Имя переменной
     * 
     * @return bool             true если существует, false если нет
     */
    public static function isset(string $name): bool
    {
        try
        {
            self::class::$name();
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }
}
