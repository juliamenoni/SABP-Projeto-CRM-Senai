## Requisitos e Casos de Teste (Analista: Miguel G.)

**Equipe:** Julia, Felipe e Miguel

### Objetivo

Esta seção reúne os requisitos do projeto e os casos de teste usados para construir e conferir o sistema, servindo de referência para quem implementa `utilitarios.php` e `index.php`.

### Contexto do problema

Uma empresa de serviços controla seus clientes em planilha, mas os dados estão desorganizados: nomes com formatação inconsistente, CPFs com pontuação, valores de contrato não padronizados e lógica repetida em várias telas. O objetivo é organizar esses dados por meio de uma biblioteca de funções PHP (`utilitarios.php`), reutilizável e sem repetição de código (princípio DRY), usada por uma tela de relatório (`index.php`).

### Requisitos funcionais

| ID | Requisito | Descrição / Critério de aceite | Prioridade |
|----|-----------|--------------------------------|------------|
| RF01 | Listagem de clientes | Percorre `$clientes` com `foreach` e exibe nome, CPF, e-mail, contrato (formatado) e situação. Todos os clientes devem aparecer, sem omissões. | Alta |
| RF02 | Busca por nome | Recebe um nome e retorna os dados do cliente via `buscarCliente()`. Se não existir, informa "cliente não encontrado". | Alta |
| RF03 | Cadastro de cliente | Insere/simula um novo cliente validando nome, e-mail, CPF e contrato. Só aceita se tudo for válido. | Alta |
| RF04 | Limpeza de dados | Remove espaços extras do nome (`trim`/`str_replace`) e pontuação do CPF, deixando só dígitos. | Média |
| RF05 | Formatação de saída | Nome padronizado e contrato em formato de moeda brasileira via `formatarMoeda()` (ex.: `R$ 1.500,00`). | Média |
| RF06 | Resumo financeiro | Soma os contratos apenas dos clientes ativos (`calcularTotalContratosAtivos`) e calcula a média geral. | Alta |
| RF07 | Reajuste por referência | `aplicarReajuste(&$contrato, $percentual)` altera o valor original do cliente via passagem por referência. | Alta |
| RF08 | Relatório final | Exibe total de clientes (`count`), total de ativos (`contarClientesAtivos`) e o maior contrato cadastrado. | Alta |

### Requisitos técnicos obrigatórios

- `declare(strict_types=1);` em todos os arquivos PHP
- Funções com parâmetros tipados e tipo de retorno explícito
- Ao menos uma função com retorno `void` (ex.: `aplicarReajuste`)
- Ao menos uma função `bool` (ex.: `validarCPF`) e uma `?array` (ex.: `buscarCliente`)
- Uso de `foreach` para percorrer os clientes
- Uso de `count()`, `strlen()`, `str_replace()`, `trim()` e `number_format()`
- Uso de `if` / `elseif` / `else` nas validações
- Uso de passagem por referência (`&`) para alterar valor original
- Uso de `require_once` para importar `utilitarios.php`
- Separação entre funções de processamento e código de apresentação

### Modelagem dos dados

Cada cliente é um array associativo com as chaves: `nome` (string), `cpf` (string, com ou sem pontuação), `email` (string), `contrato` (float) e `ativo` (bool).

### Casos de teste

| ID | Caso de teste | Entrada | Resultado esperado | Requisito |
|----|---------------|---------|---------------------|-----------|
| CT01 | Listar clientes com dados válidos | Array com 4 clientes (2 ativos, 2 inativos) | Tabela exibe os 4 clientes corretamente | RF01 |
| CT02 | Buscar cliente existente | `nome = "Ana Clara Silva"` | Retorna o array do cliente (não null) | RF02 |
| CT03 | Buscar cliente inexistente | `nome = "Fulano de Tal"` | Retorna `null`; mensagem "cliente não encontrado" | RF02 |
| CT04 | Cadastrar cliente válido | Dados válidos; contrato = 2000.00 | Cliente adicionado, sem erro | RF03 |
| CT05 | Cadastrar com campo vazio | `nome = ""` | Cadastro rejeitado, nome obrigatório | RF03 |
| CT06 | Cadastrar com CPF inválido | `cpf = "111.111.111-11"` | `validarCPF()` retorna `false`, cadastro rejeitado | RF03 |
| CT07 | Cadastrar com e-mail inválido | `email = "ana.clara#email"` | `validarEmail()` retorna `false` | RF03 |
| CT08 | Limpar nome com espaços extras | `"  ANA CLARA SILVA  "` | Retorna `"Ana Clara Silva"` sem espaços nas pontas | RF04 |
| CT09 | Limpar CPF com pontuação | `"123.456.789-00"` | Retorna `"12345678900"` | RF04 |
| CT10 | Formatar valor em moeda | `1500.5` | Retorna `"R$ 1.500,50"` | RF05 |
| CT11 | Contrato igual a zero | `contrato = 0.00` | Sistema aceita sem erro/rejeita conforme regra definida, sem quebrar | RF03/RF06 |
| CT12 | Somar contratos ativos | 2 ativos (1500.00 e 850.50), 1 inativo (2000.00) | Retorna `2350.50` | RF06 |
| CT13 | Aplicar reajuste por referência | `contrato = 1000.00`, `percentual = 10` | Valor original no array vira `1100.00` | RF07 |
| CT14 | Contar clientes ativos | 4 clientes, 3 ativos | Retorna `3` | RF08 |
| CT15 | Relatório final consistente | Array completo de teste | Total, ativos e maior contrato batem com os dados reais | RF08 |

### Pontos para a apresentação

- **Princípio DRY:** toda regra de negócio (limpeza, validação, cálculo, formatação) fica só em `utilitarios.php`; se mudar uma regra, muda em um único lugar.
- **Passagem por referência:** sem o `&`, `aplicarReajuste()` alteraria apenas uma cópia do contrato — o valor original no array `$clientes` não mudaria.
- **Retorno `?array` em `buscarCliente()`:** não encontrar um cliente é um resultado esperado, não um erro — retornar `null` permite checar com `if ($cliente === null)` sem tratamento de exceção.

##





