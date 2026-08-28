<?php
declare(strict_types=1);

// Importando nossa biblioteca
require_once 'biblioteca.php';

// Dados dos clientes:

$clientes = [

    [
        "nome" => "  ANA CLARA SILVA ",
        "cpf" => "123.456.789-00",
        "email" => "ana.clara@email.com",
        "contrato" => 1500.00,
        "ativo" => true
    ],

    [
        "nome" => "Carlos Souza",
        "cpf" => "987.654.321-00",
        "email" => "carlos.souza@email.com",
        "contrato" => 850.50,
        "ativo" => false
    ],

    [
        "nome" => "  MARIA OLIVEIRA ",
        "cpf" => "456.789.123-00",
        "email" => "maria.oliveira@email.com",
        "contrato" => 2200.00,
        "ativo" => true
    ],

    [
        "nome" => "João Santos",
        "cpf" => "321.654.987-00",
        "email" => "joao.santos@email.com",
        "contrato" => 975.75,
        "ativo" => true
    ]

];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM SENAI</title>
</head>
<body>
    <h1>CENTRAL CRM - SENAI<h1>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7e9ee;
            padding: 20px;
        }
        <h2> Lista de Clientes <h2>

    <table>

        <tr>

            <th>Nome</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Contrato</th>
            <th>Situação</th>

        </tr>
</body>
</html>
