<?php

/*
 * Complete the 'stockPairs' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. INTEGER_ARRAY stocksProfit
 *  2. LONG_INTEGER target
 */
function stockPairs(array $stocksProfit, int $target): int
{
    $uniquePairs = getUniquePairsVariations($stocksProfit);
    return countPairsEqualToSum($uniquePairs, $target);
}

/** Get pairs variation from array */
function getUniquePairsVariations(array $array): array
{
    $arraySize = count($array);
    $variations = [];
    
    for ($i=0; $i<$arraySize; $i++)
    {
        for ($j=$i+1; $j<$arraySize; $j++)
        {
            $a = $array[$i];
            $b = $array[$j];
        
            // Sort pairs by min value
            if ($a < $b)
            {
                $variations[] = [$a, $b];
            }
            else
            {
                $variations[] = [$b, $a];
            }
        }
    }

    // Return only unique pairs
    $unique = array_unique($variations, SORT_REGULAR);

    // Reset array keys 
    // 0,1,2... key=>value
    return array_values($unique);
}

/** Get pairs count where sum is equal to $target */
function countPairsEqualToSum(array $pairs, int $target): int
{
    $count = 0;
    foreach ($pairs as $pair)
    {
        $sum = 0;
        foreach ($pair as $element)
        {
            $sum += $element;
        }
        
        if ($target == $sum)
        {
        //    echo 'Found pair: ' . implode(' + ', $pair) . ' = '.$target.'<br>';
            $count++;
        }
    }

    return $count;
}

$stocksProfit_count = intval(trim(fgets(STDIN)));

$stocksProfit = array();
for ($i = 0; $i < $stocksProfit_count; $i++) {
    $stocksProfit_item = intval(trim(fgets(STDIN)));
    $stocksProfit[] = $stocksProfit_item;
}

$target = intval(trim(fgets(STDIN)));

$result = stockPairs($stocksProfit, $target);

fwrite($fptr, $result . "\n");

fclose($fptr);