<?php
declare(strict_types=1);

// 1. Formatar Nome
function formatarNome(string $nome): string {
    return mb_convert_case(trim($nome), MB_CASE_TITLE, 'UTF-8');
}

// 2. Limpar CPF
function limparCPF(string $cpf): string {
    return preg_replace('/[^0-9]/', '', $cpf);
}

// 3. Validar CPF
function validarCPF(string $cpf): bool {
    $cpf = limparCPF($cpf);
    
    if (strlen($cpf) !== 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

// 4. Validar E-mail
function validarEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// 5. Formatar Moeda
function formatarMoeda(float $valor): string {
    return "R$ " . number_format($valor, 2, ',', '.');
}

// 6. Buscar Cliente
function buscarCliente(array $clientes, string $nomeBusca): ?array {
    foreach ($clientes as $cliente) {
        if (strcasecmp(trim($cliente['nome']), trim($nomeBusca)) === 0) {
            return $cliente;
        }
    }
    return null;
}

// 7. Calcular Total Contratos Ativos
function calcularTotalContratosAtivos(array $clientes): float {
    $total = 0;
    foreach ($clientes as $cliente) {
        if ($cliente['ativo']) {
            $total += $cliente['contrato'];
        }
    }
    return $total;
}

// 8. Aplicar Reajuste
function aplicarReajuste(float &$valorContrato, float $percentual): void {
    $valorContrato += $valorContrato * ($percentual / 100);
}

// 9. Contar Clientes Ativos
function contarClientesAtivos(array $clientes): int {
    $quantidade = 0;
    foreach ($clientes as $cliente) {
        if ($cliente['ativo']) {
            $quantidade++;
        }
    }
    return $quantidade;
}

// 10. Calcular Média dos Contratos
function calcularMediaContratos(array $clientes): float {
    if (count($clientes) === 0) return 0;
    
    $total = 0;
    foreach ($clientes as $cliente) {
        $total += $cliente['contrato'];
    }
    return $total / count($clientes);
}

// 11. Encontrar Maior Contrato
function encontrarMaiorContrato(array $clientes): float {
    $maior = 0;
    foreach ($clientes as $cliente) {
        if ($cliente['contrato'] > $maior) {
            $maior = $cliente['contrato'];
        }
    }
    return $maior;
}

// 12. Validar Cliente
function validarCliente(string $nome, string $email, string $cpf, float $valor): bool {
    if (empty(trim($nome))) return false;
    if (!validarEmail($email)) return false;
    if (!validarCPF($cpf)) return false;
    if ($valor <= 0) return false;
    
    return true;
}