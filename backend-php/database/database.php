<?php

namespace database;

use mysqli;
use App\Controllers\EnvController;
use Database\DatabaseInterface;
use Exception;
use PDO;
use PDOException;


/**
 * Classe que lida com a base de dados
 * inserindo, recuperando valores
 * @extends App\Controllers\EnvController
 */
class Database extends EnvController implements DatabaseInterface{
    private array $env;
    public static $instance;
    public ?PDO $connection = null;

    public function __construct ()
    {
        return $this->env = $this->getEnvFile();
    }

    private function getInstance ()
    {
        if (self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function connect (): void
    {
        if ($this->connection === null)
        {
            try
            {
                $dsn = sprintf(
                    "mysql:host=%s;dbname=%s;charset=utf8mb4",
                    $this->env["DB_HOSTNAME"],
                    $this->env["DB_NAME"]
                );

                $this->connection = new PDO(
                    $dsn,
                    $this->env["DB_USERNAME"],
                    $this->env["DB_PASSWORD"],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            }catch (PDOException $e)
            {
                throw new PDOException("Erro na conexão: ".$e->getMessage());
            }
        }
    }

    public function select (string $colunas, string $table, string $parametros = ""): array
    {
        try
        {
            $this->connect();
            $query = "SELECT $colunas FROM $table $parametros";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll();
        }catch (PDOException $e)
        {
            throw new PDOException("Erro na consulta: ".$e->getMessage());
        }
    }

    public function insert (string $table, string $colunas, array $valores): bool
    {
        try
        {
            $this->connect();
            $placeholders = str_repeat("?,", count($valores) - 1)."?";
            $query = "INSERT INTO $table (".$colunas.") VALUES (".$placeholders.")";

            $stmt = $this->connection->prepare($query);
            return $stmt->execute(array_values($valores));
        }catch (PDOException $e)
        {
            throw new PDOException("Erro na inserção: ".$e->getMessage());
        }
    }

    public function closeConnection (): bool
    {
        if ($this->connection !== null)
        {
            $this->connection = null;
            return true;
        }
        return false;
    }

    public function __destruct()
    {
        $this->closeConnection();
    }
}