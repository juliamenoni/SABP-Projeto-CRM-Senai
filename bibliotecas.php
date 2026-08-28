<?php
declare(strict_types=1);

// 1. Muda o nome do cliente.
// Remove espaços desnecessários e deixa e deixa a primeira letra de cada palavra maiuscula por exemplo: Pedro Carlos De Oliveira.

function formatarNome(string $nome): string {
    $nome = trim($nome);
    $nome = strtolower($nome);
    $nome = ucwords($nome);

    return $nome;
}

// 2. Limpa o CPF:
// Ele ira remover pontos e traços, deixando somente os numeros. ex: 123.456.789-00 -> 12345678900

function limparCPF(string $cpf): string {
    return str_replace(['.', '-'], '', $cpf);
}

// 3. Verifica o CPF:
// Verifica se o CPF possui 11 números e se não são todos numeros iguais.

function validarCPF(string $cpf): bool {
    $cpf = limparCPF($cpf);

    if (strlen($cpf) != 11) {
        return false;
    } elseif (preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    } else {
        return true;
    }
}


// 4. Verifica o e-mail.
// Verifica se o e-mail esta correto.
function validarEmail(string $email): bool {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}


// 5. Coloca o valor em reais.
// Exemplo: 1500.50 -> R$ 1.500,50
function formatarMoeda(float $valor): string {
    return "R$ " . number_format($valor, 2, ',', '.');
}


// 6. Busca um cliente pelo nome.
// Retorna o cliente encontrado caso não encontre, retorna null.

function buscarCliente(array $clientes, string $nome): ?array {
    $nome = formatarNome($nome);

    foreach ($clientes as $cliente) {
        $nomeCliente = formatarNome($cliente['nome']);

        if ($nomeCliente == $nome) {
            return $cliente;
        }
    }

    return null;
}


// 7. Calcula o total dos contratos ativos.
// Soma somente os contratos dos clientes ativos.

function calcularTotalContratosAtivos(array $clientes): float {
    $total = 0.0;

    foreach ($clientes as $cliente) {
        if ($cliente['ativo'] == true) {
            $total += $cliente['contrato'];
        }
    }

    return $total;
}


// 8. Aplica um reajuste no contrato.
// O & permite alterar o valor original.

function aplicarReajuste(float &$contrato, float $percentual): void {
    $reajuste = $contrato * ($percentual / 100);
    $contrato += $reajuste;
}


// 9. Conta a quantidade de clientes ativos.

function contarClientesAtivos(array $clientes): int {
    $quantidade = 0;

    foreach ($clientes as $cliente) {
        if ($cliente['ativo'] == true) {
            $quantidade++;
        }
    }

    return $quantidade;
}


// 10. Calcula a média dos contratos.
// Função extra para o resumo financeiro.

function calcularMediaContratos(array $clientes): float {
    if (count($clientes) == 0) {
        return 0.0;
    }

    $total = 0.0;

    foreach ($clientes as $cliente) {
        $total += $cliente['contrato'];
    }

    return $total / count($clientes);
}


// 11. Encontra o maior contrato.
// Função extra para o relatório final.

function encontrarMaiorContrato(array $clientes): float {
    if (count($clientes) == 0) {
        return 0.0;
    }

    $maior = 0.0;

    foreach ($clientes as $cliente) {
        if ($cliente['contrato'] > $maior) {
            $maior = $cliente['contrato'];
        }
    }

    return $maior;
}


// 12. Valida os dados de um cliente.
// Função extra para ajudar no cadastro.

function validarCliente(
    string $nome,
    string $email,
    string $cpf,
    float $contrato
): bool {
    $nome = trim($nome);
    $email = trim($email);

    if ($nome == '') {
        return false;
    } elseif (strlen($nome) < 3) {
        return false;
    } elseif (!validarEmail($email)) {
        return false;
    } elseif (!validarCPF($cpf)) {
        return false;
    } elseif ($contrato <= 0) {
        return false;
    } else {
        return true;
    }

}

