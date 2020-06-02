<?php

class Conexao
{
    /**
     * @var string
     */
    private $host = 'localhost';

    /**
     * @var string
     */
    private $dbname = 'sistema_cme';

    /**
     * @var string
     */
    private $user = 'root';

    /**
     * @var string
     */
    private $pass = '';

    /**
     * Cria uma nova conexão com o BD:
     *
     * @return PDO
     */
    public function conectar()
    {
        try {
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->pass");
            return $conexao;
        } catch (PDOException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
}