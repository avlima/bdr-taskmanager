<?php
/**
 * Questão 01
 * Imprimindo números múltiplos de 3 e 5
 */

/*
 * Eu poderia ter atribuido o range a uma variável, porém como a escolha foi por "foreach" eu simplifiquei pois ele
 * mesmo trata de blindar o resultado e diferente do "for" o "foreach" processa apenas uma única vez.
 *
 * Não fiz if ternario pois a psr-2 permite caso a operação caiba em apenas uma linha, e neste caso passaria:
 * ($num % 3 === 0 && $num % 5 === 0) ? 'FizzBuzz' : (($num % 3 === 0) ? 'Fizz' : (($num % 5 === 0) ? 'Buzz' : $num));
 */
foreach (range(1, 100) as $num) {
    if ($num % 3 === 0 && $num % 5 === 0) {
        echo 'FizzBuzz' . PHP_EOL;
    } elseif ($num % 3 === 0) {
        echo 'Fizz' . PHP_EOL;
    } elseif ($num % 5 === 0) {
        echo 'Buzz' . PHP_EOL;
    } else {
        echo $num . PHP_EOL;
    }
}