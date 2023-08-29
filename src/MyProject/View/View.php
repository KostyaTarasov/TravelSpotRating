<?php

namespace MyProject\View;

class View
{
    private $templatesPath;

    private $extraVars = [];

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }

    /*
    //*Возможность добавлять переменные еще перед рендерингом
    К примеру передавать пользователя во View. 
    */
    public function setVar(string $name, $value): void
    {
        $this->extraVars[$name] = $value;
    }

    /*
    //*Возможность получать значения еще перед рендерингом
    */
    public function getExtraVars()
    {
        return $this->extraVars;
    }

    public function renderHtml(string $templateName, array $vars = [], int $code = 200)
    {
        http_response_code($code); // По умолчанию, если мы не передадим третьим аргументом код, будет возвращён 200-ый код ответа, иначе – заданный нами.

        extract($this->extraVars);
        extract($vars); // Функция extract извлекает массив в переменные

        ob_start();
        include $this->templatesPath . '/' . $templateName; // подключаем файл с нужным шаблоном, получив путь до него, склеив пути до папки с шаблонами и именем конкретного шаблона
        $buffer = ob_get_contents(); // поток вывода(html, echo, вывод данных) положить во временный буфер вывода
        ob_end_clean();

        # профит в том, что мы можем обрабатывать ошибки, возникшие в процессе работы с шаблоном
        echo $buffer; // передать эти данные в поток вывода
    }

    # Метод для вывода JSON формата
    public function displayJson($data, int $code = 200)
    {
        header('Content-type: application/json; charset=utf-8');
        http_response_code($code);
        echo json_encode($data);
    }
}
