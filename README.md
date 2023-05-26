# ProtectedVar
### Позволяет защитить переменную от изменений для PHP 8.0.0+<br><br>

Советую открыть **`ProtectedVar.php`** и почитать описания методов<br><br>
Рекомендую также ознакомиться со [справочником по ссылкам](https://www.php.net/manual/ru/language.references.php)

<br><br>
## Ограничения PHP
1. Установка значения по ссылке для не-объекта работает только через `var()`
2. Возврат значения по ссылке для не-объекта работает только через `var()`

<br><br>
## Пример использования
**`main.php`**:
```php
// подключение ProtectedVar
require('ProtectedVar.php');

// создание псевдо-области с переменными, которые нужно защитить
abstract class Safe
{
    // подключение возможностей из ProtectedVar
    use ProtectedVar;
}

// установка значения 123 переменной var1 (после установки изменения сразу блокируются)
Safe::var1(123);

// попытка установки нового значения
Safe::var1(321);

// вывод значения переменной
echo(Safe::var1().PHP_EOL);

// проверка существования переменной var1
echo((Safe::isset('var1') ? 'true' : 'false').PHP_EOL);

// тестовый класс
class BaseClass
{
    public int $var = 0;
}

// создание тестового объекта
$c = new BaseClass();

/**
 * установка значения $c переменной var2
 * второй параметр - true (по умолчанию false) указывает на синхронизацию значения с переменной $c
 * третий параметр - false (по умолчанию true) указывает на возвращение значения по ссылке
 */
Safe::var('var2', $c, true, false);

// получение значения по ссылке 
$var2 = &Safe::var('var2');

$c->var = 1;

// вывод: 1
echo($var2->var.PHP_EOL);

// для передачи по ссылке значений-объектов работает синтаксис Safe::name()
$var2 = Safe::var2();

$var2->var = 2;

// вывод: 2
echo($c->var.PHP_EOL);
```
