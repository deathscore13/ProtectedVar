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
     * Установка/получение значения переменной по ссылке
     * 
     * @param string $name      Имя переменной
     * @param mixed &$value     Значение переменной (только при инициализации)
     * @param bool $ref         Синхронизация значения с переменной переданной в параметр $value (только при инициализации)
     * @param bool $clone       Возвращать значение не по ссылке (только при инициализации)
     * 
     * @return mixed            Значение переменной
     */
    public static function &var(string $name, mixed &$value = 0, bool $ref = false, bool $clone = true): mixed
    {
        static $vars = [];
        static $clones = [];

        if (!isset($vars[$name]))
        {
            if (func_num_args() === 1)
                throw new Exception('Undefined variable $'.$name);
            
            if ($ref)
                $vars[$name] = &$value;
            else
                $vars[$name] = is_object($value) ? (clone $value) : $value;

            if ($clone)
                $clones[] = $name;
        }
        
        if (in_array($name, $clones))
        {
            $buffer = is_object($vars[$name]) ? (clone $vars[$name]) : $vars[$name];
            return $buffer;
        }
        
        return $vars[$name];
    }
    
    /**
     * Проверка существования переменной
     * 
     * @param string $name      Имя переменной
     * 
     * @return bool             true если существует, false если нет
     */
    public static function isset(string $name): bool
    {
        try
        {
            self::class::var($name);
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    /**
     * Установка/получение значения переменной
     * НЕ УМЕЕТ синхронизировать значение с переменной переданной в параметр $value, если это не объект
     * НЕ УМЕЕТ возвращать значение по ссылке, если это не объект
     * Зато имеет красивый синтаксис Safe::name()
     */
    public static function __callStatic(string $name, array $arg): mixed
    {
        return self::var($name, ...$arg);
    }
}
