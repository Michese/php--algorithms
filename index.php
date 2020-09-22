<?php
echo "<h2>Task 1</h2>";
$stack = new SplStack();
$brackets = ['{' => '}', '[' => ']', '(' => ')'];
$str_all = [
    "\"Это тестовый вариант проверки (задачи со скобками). И вот еще скобки: {[][()]}\"",
    "((a + b)/ c) - 2",
    "\"([ошибка)\"",
    "\"(\")"
];
foreach ($str_all as $key => $str) {
    echo "Строчка номер $key <br>";
    echo $str;
    preg_match_all("/[\"\[\]{})(]/", $str, $strArray);
    foreach ($strArray[0] as $symbol) {
        if ($stack->isEmpty() || $stack->bottom() !== '"' && $brackets[$stack->bottom()] !== $symbol) {
            $stack->push($symbol);
        } else if ($stack->bottom() === '"' && $symbol === '"' || $brackets[$stack->bottom()] === $symbol) {
            $stack->pop();
        }
    }
    echo " - ";
    var_dump($stack->isEmpty());
    while (!$stack->isEmpty()) {
        $stack->pop();
    }
    echo "<br>";
}

echo "<h2>Task 2</h2>";

$numbersDoublyList = new SplDoublyLinkedList();
$number = 600851475143;
$seconds = microtime();
for ($count = 2; $count <= sqrt($number); $count++) {
    if ($number % $count == 0) {
        $numbersDoublyList->push($count);
    }
}

echo "<br>";
while (!$numbersDoublyList->isEmpty()) {
    $numbersDoublyList->rewind();
    $result = true;
    while ($numbersDoublyList->current() <= sqrt($numbersDoublyList->top())) {
        if ($numbersDoublyList->top() % $numbersDoublyList->current() === 0) {
            $result = false;
            $numbersDoublyList->pop();
        }
        $numbersDoublyList->next();
    }
    if ($result) {
        break;
    }
}
$seconds = microtime() - $seconds;
echo "Простой наибольший делитель числа " . $number . " = " . $numbersDoublyList->top() . "<br>";
echo "Программа работала " . $seconds . " секунд";


echo "<h2>Task 3</h2>";
if (isset($_GET["path"]) && is_dir($_GET["path"]) && $_GET["path"] !== '.') {
    $path = $_GET["path"];
} else {
    $path = "./";
}

$directoryIt = new DirectoryIterator($path);
$directoryIt->rewind();
while ($directoryIt->valid()) {
    if ($path === './' && $directoryIt->isDot()) {
        $directoryIt->next();
        continue;
    } elseif ($directoryIt->isDot()) {
        if ($directoryIt == '.') {
            echo "<a href='?path=./'> Корневая папка </a><br>";
        } else {
            $oldPath = preg_replace("/\\\[\\d\\w^\/]*$/", "", $directoryIt->getPath());
            echo "<a href='?path=" . $oldPath . "'> Вернуться </a><br>";
        }
    } else {
        echo "<a href='?path=" . $directoryIt->getPathname() . "'>" . $directoryIt . "<br>";
    }

    $directoryIt->next();
}
