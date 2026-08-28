<?php
declare(strict_types=1);

require_once __DIR__ . '/utilitarios.php';

// Dados de teste
$clientes = [
    [
        'nome' => 'pedro carlos de oliveira',
        'email' => 'pedro@email.com',
        'cpf' => '123.456.789-00',
        'contrato' => 1500.50,
        'ativo' => true
    ],
    [
        'nome' => 'maria da silva',
        'email' => 'maria@email.com',
        'cpf' => '987.654.321-00',
        'contrato' => 2000.00,
        'ativo' => true
    ],
    [
        'nome' => 'joao santos',
        'email' => 'joao@email.com',
        'cpf' => '111.111.111-11',
        'contrato' => 1000.00,
        'ativo' => false
    ]
];

// Processamento dos testes
$nomeFormatado = formatarNome(" pedro carlos de oliveira ");
$cpfLimpo = limparCPF("123.456.789-00");
$cpfValido = validarCPF("123.456.789-00");
$emailValido = validarEmail("pedro@email.com");
$moedaFormatada = formatarMoeda(1500.50);
$clienteEncontrado = buscarCliente($clientes, "PEDRO CARLOS DE OLIVEIRA");
$totalAtivos = calcularTotalContratosAtivos($clientes);

$contrato = 1500.00;
aplicarReajuste($contrato, 10);

$quantidadeAtivos = contarClientesAtivos($clientes);
$media = calcularMediaContratos($clientes);
$maiorContrato = encontrarMaiorContrato($clientes);

$clienteValido = validarCliente(
    "Carlos Oliveira",
    "carlos@email.com",
    "123.456.789-00",
    1500.00
);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Testando as Funções - CRM Senai</title>
</head>
<body>

    <h1>Testando as Funções</h1>

    <h2>1. Formatar Nome</h2>
    <p><?= $nomeFormatado ?></p>

    <h2>2. Limpar CPF</h2>
    <p><?= $cpfLimpo ?></p>

    <h2>3. Validar CPF</h2>
    <p><?= $cpfValido ? "CPF válido" : "CPF inválido" ?></p>

    <h2>4. Validar E-mail</h2>
    <p><?= $emailValido ? "E-mail válido" : "E-mail inválido" ?></p>

    <h2>5. Formatar Moeda</h2>
    <p><?= $moedaFormatada ?></p>

    <h2>6. Buscar Cliente</h2>
    <p>
        <?php if ($clienteEncontrado !== null): ?>
            Cliente encontrado: <?= $clienteEncontrado['nome'] ?>
        <?php else: ?>
            Cliente não encontrado
        <?php endif; ?>
    </p>

    <h2>7. Total dos Contratos Ativos</h2>
    <p><?= formatarMoeda($totalAtivos) ?></p>

    <h2>8. Aplicar Reajuste</h2>
    <p>Novo valor: <?= formatarMoeda($contrato) ?></p>

    <h2>9. Clientes Ativos</h2>
    <p>Quantidade de clientes ativos: <?= $quantidadeAtivos ?></p>

    <h2>10. Média dos Contratos</h2>
    <p><?= formatarMoeda($media) ?></p>

    <h2>11. Maior Contrato</h2>
    <p><?= formatarMoeda($maiorContrato) ?></p>

    <h2>12. Validar Cliente</h2>
    <p><?= $clienteValido ? "Cliente válido" : "Cliente inválido" ?></p>

</body>
</html>
