<?php
declare(strict_types=1);
require_once 'utilitarios.php';
?>

<?php
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
        "nome" => "Ceilton Humberto da Silva",
        "cpf" => "529.481.349-62",
        "email" => "ceilton.silva@email.com",
        "contrato" => 3300.00,
        "ativo" => true
    ],
    [
        "nome" => "Jurema Castro ",
        "cpf" => "502.342.357-06",
        "email" => "jurema.castro@email.com",
        "contrato" => 200.00,
        "ativo" => false
    ],
    [
        "nome" => "Paulo Ferreira Rocha",
        "cpf" => "321.390.287-11",
        "email" => "rocha.paulo@email.com",
        "contrato" => 2100.00,
        "ativo" => true
    ],
    [
        "nome" => "Vitor Tempestade",
        "cpf" => "930.284.959-00",
        "email" => "vitor.tempesade@email.com",
        "contrato" => 12250.00,
        "ativo" => true
    ]
];
foreach ($clientes as $index => $cliente) {
    if (trim($cliente['nome']) === "Carlos Souza") {
        aplicarReajuste($clientes[$index]['contrato'], 10.0);
    }
}

$clienteEncontrado = null;
$termoBusca = "";
if (isset($_GET['busca'])) {
    $termoBusca = $_GET['busca'];
    $clienteEncontrado = buscarCliente($clientes, $termoBusca);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CRM SENAI</title>
    
</head>
<body>

    <header>
        <hgroup>
            <h1><em>Cliente</em>s</h1>
            <img src="TESTE01/SENAI-SP.jpg" alt="Logo SENAI" class="logo-senai">
        </hgroup>

        <nav class="menu">
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="#relatorios">Informações</a></li>
                <li><a href="#contato">Contato</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="bloco-info">
            <h3>Pesquisar Cliente</h3>
            <form method="GET" action="index.php" class="busca-container">
                <select name="busca" onchange="this.form.submit()">
                    <option value="">Selecione um cliente...</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <?php $nomeFormato = formatarNome($cliente['nome']); ?>
                        <option value="<?= $nomeFormato ?>" <?= $termoBusca === $nomeFormato ? 'selected' : '' ?>>
                            <?= $nomeFormato ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <?php if ($termoBusca !== ''): ?>
                <?php if ($clienteEncontrado !== null): ?>
                    <div>
                        <p><strong>Nome:</strong> <?= formatarNome($clienteEncontrado['nome']) ?></p>
                        <p><strong>CPF:</strong> <?= limparCPF($clienteEncontrado['cpf']) ?></p>
                        <p><strong>E-mail:</strong> <?= $clienteEncontrado['email'] ?></p>
                        <p><strong>Contrato:</strong> <?= formatarMoeda($clienteEncontrado['contrato']) ?></p>
                    </div>
                <?php else: ?>
                    <p>Cliente não encontrado.</p>
                <?php endif; ?>
            <?php endif; ?>
        </section>

        <section class="bloco-info">
            <h3>Listagem Geral</h3>
            <table>
                <thead>
                    <tr>
                        <th><b>Nome</b></th>
                        <th><b>CPF</b></th>
                        <th><b>E-mail</b></th>
                        <th><b>Contrato</b></th>
                        <th><b>Status</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= formatarNome($cliente['nome']) ?></td>
                            <td><?= limparCPF($cliente['cpf']) ?></td>
                            <td><?= $cliente['email'] ?></td>
                            <td><?= formatarMoeda($cliente['contrato']) ?></td>
                            <td>
                                <?php if ($cliente['ativo']): ?>
                                    <span class="status-ativo">Ativo</span>
                                <?php else: ?>
                                    <span class="status-inativo">Inativo</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section id="relatorios" class="bloco-resumo">
            <h3>Relatório Final</h3>
            <p>Total de Clientes: <?= count($clientes) ?></p>
            <p>Clientes Ativos: <?= contarClientesAtivos($clientes) ?></p>
            <p>Total Ativos: <?= formatarMoeda(calcularTotalContratosAtivos($clientes)) ?></p>
            <p>Média Geral: <?= formatarMoeda(calcularMediaContratos($clientes)) ?> </p>
            <p>Maior Contrato: <?= formatarMoeda(obterMaiorContrato($clientes)) ?></p>
        </section>
    </main>

    <footer id="contato" style="margin-top: 40px;">
        <p>CRM Senai Americana</p>
    </footer>
</body>
</html>