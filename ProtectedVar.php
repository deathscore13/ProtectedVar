<?php

/**
 * ProtectedVar
 * 
 * Позволяет защитить переменную от изменений для PHP 8.0.0+
 * https://github.com/deathscore13/ProtectedVar
 */

trait ProtectedVar
{
    private static array $var;
    
    /**
     * Установка/получение значения переменной
     */
    public static function __callStatic(string $name, array $arg): mixed
    {
        if (!isset(self::$var[$name]))
        {
            if (!isset($arg[0]))
            {
                throw new Exception('Переменная не существует');
                return null;
            }
            self::$var[$name] = $arg[0];
        }
        
        return self::$var[$name];
    }
    
    /**
     * Проверяет существованиче переменной
     * 
     * @param string $name      Имя переменной
     * 
     * @return bool             true если существует, false если нет
     */
    public static function isset(string $name): bool
    {
        return isset(self::$var[$name]);
    }
}
