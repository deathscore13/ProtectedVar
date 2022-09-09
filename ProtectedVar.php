<?php

/**
 * ProtectedVar
 * 
 * Позволяет защитить переменную от изменений для PHP 8.0.0+
 * https://github.com/deathscore13/ProtectedVar
 */

final class ProtectedVar
{
    private mixed $var;
    private bool $protected = false;

    /**
     * Можно мгновенно присвоить значение и запретить изменения
     */
	public function __construct($var = null)
	{
		if ($var !== null)
		{
			$this->var = $var;
			$this->protected = true;
		}
	}
    
    /**
     * Установка значения переменной
     */
    public function set($var): void
    {
        if (!$this->protected)
            $this->var = $var;
    }
    
    /**
     * Защитить переменную от изменений
     */
    public function protect(): void
    {
        $this->protected = true;
    }
    
    /**
     * Получить значение переменной
     */
    public function get(): mixed
    {
        return $this->var;
    }
}