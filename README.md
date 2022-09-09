# ProtectedVar
### Позволяет защитить переменную от изменений для PHP 8.0.0+<br><br>

**НЕ ЗАБЫВАЙТЕ УКАЗЫВАТЬ `final`**

<br><br>
## Пример использования
**`main.php`**:
```php
// подключение ProtectedVar
require('ProtectedVar.php');

// создание псевдо-переменной, которую нужно защитить (final обязателен)
final class Var1
{
    // подключение возможностей из ProtectedVar
    use ProtectedVar;
}

// установка значения 123
Var1::set(123);

// защита переменной от изменений
Var1::protect();

// попытка установки нового значения
Var1::set(321);

// вывод значения переменной
echo(Var1::get().PHP_EOL);
```
