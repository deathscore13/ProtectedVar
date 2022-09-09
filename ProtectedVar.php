<?php

/**
 * ProtectedVar
 * 
 * Позволяет защитить переменную от изменений для PHP 8.0.0+
 * https://github.com/deathscore13/ProtectedVar
 */

abstract class ProtectedVar
{
    private static mixed $var;
    private static bool $protected = false;
    
    /**
     * Защитить переменную от изменений
     */
    public static function protect(): void
    {
        self::$protected = true;
    }
    
    /**
     * Установка значения переменной
     */
    public static function set($var): void
    {
        if (!self::$protected)
            self::$var = $var;
    }
    
    /**
     * Получить значение переменной
     */
    public static function get(): mixed
    {
        return self::$var;
    }
}