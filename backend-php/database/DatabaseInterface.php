<?php

namespace Database;

interface DatabaseInterface 
{
    public function select(string $colunas, string $table, string $parametros = ""): array;
    public function insert(string $table, string $colunas, array $valores): bool;
    public function closeConnection(): bool;
}