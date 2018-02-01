<?php
/**
 * Questão 02
 * Refatorando código
 */

/*
 * Deixei o if com uma operação inves de duas pois ambas as condiçoes redirecionavam para o mesmo destino.
 *
 * Seguindo a psr-2 para a session eu mantive a comparaçao true mudando apenas o operador de valor(==) para
 * valor e tipo(===). Tambem adicionei ao topo o session_start() para possibilitar a leitura da session.
 *
 * Com cookie eu mudei ambos já que seguindo a psr-2 e o cookie nao atribui boolean, então supondo que o cookie
 * foi atribuido desta forma: setcookie("Loggedin", true);, seu valor real é uma string(1).
 *
 * Troquei o exit(); por exit; não havia necessidade de chamalo como método pois não seria informado nenhum status.
 */
session_start();

if (
    (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) ||
    (isset($_COOKIE['Loggedin']) && $_COOKIE['Loggedin'] === '1')
) {
    header("Location: http://www.google.com");
    exit;
}