<?php
$bodySpace = "\040";
$headSapce = "\040\040";
if ($gridColCount > 10) {
    $bodySpace = "\t";
    $headSapce = "\t";
}

echo $shotMessage;
echo PHP_EOL;
for ($i=0; $i <= $gridRowCount; $i++) {
    if ($i > 0) {
        echo $i . $headSapce;
    } else {
        echo $headSapce;
    }
}
echo PHP_EOL;
for ($row=0; $row < $gridRowCount; $row++) {
    echo chr($row+65) . $bodySpace;
    for ($col=0; $col < $gridColCount; $col++) {
        echo "{$grid[$row][$col]} {$bodySpace}";
    }
    echo PHP_EOL;
}

if (!empty($finalMessage)) {
    echo $finalMessage;
}
