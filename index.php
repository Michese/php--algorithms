<?php
echo "<h2>task 1</h2>";

echo "Поиск элемента массива с известным индексом - O(1)<br>
Дублирование одномерного массива через foreach - O(n)<br>
Рекурсивная функция нахождения факториала числа - O(n!)<br>
Удаление элемента массива с известным индексом - O(n)<br>";

echo "<h2>task 2</h2>";
echo "<h3>1)</h3>";
echo '<pre>
$n = 10000;
$array[]= [];

for ($i = 0; $i < $n; $i++) {
  for ($j = 1; $j < $n; $j *= 2) {
     $array[$i][$j]= true;
} }

// O(n*log(n))
</pre>';

echo "<h3>2)</h3>";
echo '<pre>
$n = 10000;
$array[] = [];

for ($i = 0; $i < $n; $i += 2) {
  for ($j = $i; $j < $n; $j++) {
   $array[$i][$j]= true;
} }

// O(n<sup>2</sup>)
</pre>';

echo "<h3>3)</h3>";

echo '<pre>
$n = 10000;
$array[] = [];
foo(n);

function foo()  {
while(n > 0) {
  for ($j = sqrt(n); $j < $n; $j++) {
        n--;
        foo(n);
   } } }
   
   // O(n!)
   </pre>';

echo "<h2>task 3</h2>";
$rows = 3;
$columns = 10;
$arr1 = newArray($rows, $columns);

$fill = 1;
$number = $rows * $columns;
while ($number > 9) {
    $fill++;
    $number /= 10;
}

for ($i = 0; $i < $rows; $i++) {
    for ($j = 0; $j < $columns; $j++) {
        $number = $arr1[$i][$j];
        for ($p = 0; $p < $fill; $p++) {
            if ($number == 0) {
                echo '0';
            } else {
                $number = (int)($number / 10);
            }
        }
        echo $arr1[$i][$j] . ' ';
    }
    echo "<br>";
}

function newArray($rows, $columns)
{
    try {
        if ($rows <= 0 || $columns <= 0) {
            throw new Exception("Ошибка!");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $arr = [];
    $count = 1;
    for ($row = 0; $row < $rows; $row++) {
        for ($column = 0; $column < $columns; $column++) {
            $arr[$row][$column] = 0;
        }
    }

    if ($rows > 1 && $columns > 1) {
        for ($row = 0; $row < $rows; $row++, $count++) {
            $arr[$row][0] = $count;
        }
        for ($column = 1; $column < $columns; $column++, $count++) {
            $arr[$rows - 1][$column] = $count;
        }
        for ($row = $rows - 2; $row >= 0; $row--, $count++) {
            $arr[$row][$columns - 1] = $count;
        }
        for ($column = $columns - 2; $column > 0; $column--, $count++) {
            $arr[0][$column] = $count;
        }

        $row = 1;
        $column = 1;

        while ($count < $rows * $columns) {
            while ($arr[$row + 1][$column] == 0) {
                $arr[$row][$column] = $count;
                $count++;
                $row++;
            }
            while ($arr[$row][$column + 1] == 0) {
                $arr[$row][$column] = $count;
                $count++;
                $column++;
            }
            while ($arr[$row - 1][$column] == 0) {
                $arr[$row][$column] = $count;
                $count++;
                $row--;
            }
            while ($arr[$row][$column - 1] == 0) {
                $arr[$row][$column] = $count;
                $count++;
                $column--;
            }
        }

        if ($arr[$row + 1][$column] == 0) {
            $arr[$row + 1][$column] = $count;
        } else if ($arr[$row - 1][$column] == 0) {
            $arr[$row - 1][$column] = $count;
        } else if ($arr[$row][$column - 1] == 0) {
            $arr[$row][$column - 1] = $count;
        } else if ($arr[$row][$column + 1] == 0) {
            $arr[$row][$column + 1] = $count;
        } else if ($arr[$row][$column] == 0) {
            $arr[$row][$column] = $count;
        }
    } else {
        $index = 0;
        while (isset($arr[0][$index + 1]) && $arr[0][$index + 1] == 0) {
            $arr[0][$index] = $count;
            $count++;
            $index++;
        }
        while (isset($arr[$index + 1][0]) && $arr[$index + 1][0] == 0) {
            $arr[$index][0] = $count;
            $count++;
            $index++;
        }
        if(isset($arr[0][$index]) && $arr[0][$index] == 0) {
            $arr[0][$index] = $count;
        } else if (isset($arr[$index][0]) && $arr[$index][0] == 0) {
            $arr[$index][0] = $count;
        }
    }

    return $arr;
}
