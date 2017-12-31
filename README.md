# Request Validator
Permite executar a validação de campos passados em qualquer request.


## Installation (Instalação)

Installation by composer (Instalação pelo composer):
```sh
composer require gabrielanhaia/masknizzer
```
or add the dependency on your **composer.json** and: (ou adicione a denpendência em seu **composer.json** e:)
```sh
composer install
```

## Use (Uso)
###1 - Criando um novo RequestValidator (simples)

Para criar um nova RequestValidartor em seu projeto basta criar uma classe que extenda de '\Validator\RequestValidator'
Exemplo:

```php
<?php

class SaveUser extends \Validator\RequestValidator
{
    /**
     * {@inheritdoc}
     */
    public function getRules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
```
Ao implementar o método 'getRules()', deve ser retornado um array na qual as chaves são no nome do campo que será passado no request ($_REQUEST, $_POST, $_GET, etc). O valor deve ser as regras de validação e seus parâmetros (caso possuam).

Para passar mais de um parâmetro por campo basta usar o separador ';', exemplo:
```php
    /**
     * {@inheritdoc}
     */
    public function getRules(): array
    {
        return [
            'account_number' => 'required;numeric'
        ];
    }
``` 

*Nota: O único método obrigatório a ser implementado pela interface é o 'getRules()'.

### 2 - Validações com parâmetros

Algumas regras de validação possuem parâmetros obrigatórios a serem passadados, as regras são:
* MinimunSize (1 parâmetro)
* MaximunSize (1 parâmetro)
* Interval (2 parâmetros)
* Regras personalizadas (n parâmetros)

```php
<?php

class SaveUser extends \Validator\RequestValidator
{
    /**
     * {@inheritdoc}
     */
    public function getRules(): array
    {
        return [
            'age' => 'interval{18, 40}',
            'account_number' => 'min{10}'
        ];
    }
}
```

### 3 - Mensagens de validação
### 4 - Nomes de parâmetro e apelidos nas mensagens
### 5 - Entendendo a classe 'Validation\Profile'
### 6 - Modificando o idioma das mensagens
### 7 - Criando validações personalizadas

## Regras prontas de validação

### Email()
- Valida se o campo está em um formato de email padrão (#####@###.####).

### Interval(inicio, fim)
- Valida se o campos está dentro de um intervalo de dois números.

### MinimunSize (minimo)
- Valida se o campo atinge um tamanho mínimo do parâmetro.

### MaximumSize (máximo)
- Valida se o campo não ultrapassa o tamanho máximo do parâmetro.

### Required()
- Valida se um campo foi preenchido.
