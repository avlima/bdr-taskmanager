<?php
/**
 * Questão 03
 * Refatorando código
 */

/*
 * Importante **
 * ==================================================================================================
 *  - O nome do arquivo deixei como issue-03.php apenas para melhor identificação do avaliador.
 *  - Porem se essa classe for utilizar namespace, então eu renomearia o arquivo para MyUserClass.php
 * ==================================================================================================
 *
 *
 * Supondo que a DatabaseConnection seja uma classe de conexao "MySQLi Object-Oriented" já pronta. Eu nao manteria os dados de conexao como
 * parametros a serem passados da classe de requisição, eu deixaria tudo como private dentro da classe DatabaseConnection
 * e utilizaria um construct pra isso.
 *
 * Não sabendo se classe DatabaseConnection trata erros ou não, entao fiz uma verificação de connect_error para garantir
 * a execução.
 *
 * Verifico com num_rows para ter certeza se a query retornou resultado e com isso eu utilizo o fetch_assoc e retorno
 * o array com valores
 *
 * Usando php 7.1 estou definindo que o método getUserList sempre retornará um array.
 */

class MyUserClass
{
    private $dbconn;

    /**
     * MyUserClass constructor.
     */
    public function __construct()
    {
        $this->dbconn = new DatabaseConnection();

        if ($this->dbconn->connect_error) {
            die("Connection failed: " . $this->dbconn->connect_error);
        }
    }

    /**
     * getUserList - User list
     *
     * @return array
     */
    public function getUserList(): array
    {
        $sql = "SELECT name FROM user";
        $result = $this->dbconn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        } else {
            $users = [];
        }

        $this->dbconn->close();

        return $users;
    }
}