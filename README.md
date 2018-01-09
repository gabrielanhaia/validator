[![Jenkins](https://img.shields.io/jenkins/s/https/jenkins.qa.ubuntu.com/view/Precise/view/All%20Precise/job/precise-desktop-amd64_default.svg)]()
[![PHP from Packagist](https://img.shields.io/packagist/php-v/symfony/symfony.svg)]()
[![Validator](https://img.shields.io/badge/Validator-Quality-green.svg)]()
[![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)]()


# Request Validator
Permite executar a validação de campos passados em qualquer request.


## Installation (Instalação)

Installation by composer (Instalação pelo composer):
```sh
composer require gabrielanhaia/validator
```
or add the dependency on your **composer.json** and: (ou adicione a denpendência em seu **composer.json** e:)
```sh
composer install
```

## Use (Uso)
### 1 - Criando um novo RequestValidator (simples)

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

Algumas regras de validação possuem parâmetros obrigatórios a serem passados, as regras são:
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

### 3 - Mensagens de validação e idioma

Por padrão uma mensagem pré-configurada é lançada caso a regra não passe na validação.

É possível sobreescrever a mensagem de validação ao seu gosto, basta sobreescrever o método 'getMessages(): array' em sua classe de request, este método deve retornar um array com as mensagens customizadas.

Exemplo:

```php
/**
 * Class TestRequestValidator
 */
class TestRequestValidator extends \Validator\RequestValidator
{
    /**
     * @return array
     */
    public function getRules(): array
    {
        return [
            'mail' =>  'email;required',
        ];
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return [
            'mail.email' => 'Não é um e-mail válido.',
            'mail.required' => 'O preenchimento do e-mail é obrigatório.'
        ];
    }
}
```

No indice do array existe uma separação por ponto, antes do ponto está no nome do campo passa do request, depois é o nome da regra de validação.

TODO: Edit

### 4 - Nomes de parâmetro e apelidos nas mensagens

Muitas vezes  necessário que na mensagem de validação seja também informado o nome do campo que falhou no teste, com isso existem duas opções:

1 '{fieldName}' = Nome do campo.
2 '{fieldAlias}' = Apelido criado para o nome do campo.

Para utilizar o '{fieldName}' basta inseri-lo dentro da string na qual se queira customizar, exemplo:
```php
    /**
     * @return array
     */
    public function getMessages(): array
    {
        return [
            'mail.required' => 'O campo {fieldName} é de preenchimento do e-mail é obrigatório.'
        ];
    }
```
a saída será: "O campo mail é de preenchimento do e-mail é obrigatório."

Para que não seja exibido o nome bruto do campo é possível utilizar a tag '{fieldAlias}', porém é necessário sobreescrever o método 'getAlias(): array', exemplo:
```php
    /**
     * @return array
     */
    public function getMessages(): array
    {
        return [
            'mail.required' => 'O campo {fieldName} é de preenchimento do e-mail é obrigatório.'
        ];
    }
    
    /**
     * @return array
     */
    public function getAlias(): array
    {
        return [
            'mail' => 'E-mail'
        ];
    }
```
a saída será: "O campo E-mail é de preenchimento do e-mail é obrigatório."

Obs: Caso o alias não seja definido, o próprio nome do campo será usado.

### 5 - Entendendo a classe 'Validation\Profile'

#### 5.1 - Alteração de idioma

O sistema suporta multi-idiomas de mensagens de validação, por padro está definido com 'Inglês (en)', porém é possível configurar em 'Português Brasil (pt-br)'. Basta passar para o primeiro parâmetro do construtor de 'Validation\Profile' ou usar o método 'setLanguage(string language)'.

### 7 - Criando validações personalizadas

## Regras prontas de validação

Regra de validação    | parametros      | Descrição
----------------------| --------------- | ------
Email                 | Não possui      | Valida se o campo está em um formato de email padrão (#####@###.####).
Interval              | (inicio, fim)   | Valida se o campos está dentro de um intervalo de dois números.
MinimunSize           | (minimo)        | Valida se o campo atinge um tamanho mínimo do parâmetro.
MaximumSize           | (máximo)        | Valida se o campo não ultrapassa o tamanho máximo do parâmetro.
Required              | Não possui      | Valida se um campo foi preenchido.
