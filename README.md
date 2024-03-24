# Quadro Societário

*Tecnologias Usadas*
1. PHP 8.2
2. Symfony
3. Twig
4. Doctrine ORM
5. API Rest
6. Swagger UI
7. Swagger PHP
8. JQuery
9. Boostrap

*Documentação API*

Você pode acessar a documentação e testar a API no endpoint `http://localhost:8000/docs`.

*O que foi feito?*

Autenticação, Permissionamento, API, Documentação da API, CRUD de Empresa, CRUD de Sócio, CRUD de Usuário.

*Funcionamento Básico*

Assim que você abrir o sistema vai se deparar com uma tela de login, onde você pode cadastrar um usuário e 
conceder uma permissão (Usuário, Administrador, Empresa, Sócio) a ele. Cadastrado o usuário você pode 
navegar dentro do sistema. 

Você pode Criar umar uma Empresa e Logo após Criar um Sócio e associa-lo a empresa, pode ver a lista de 
empresas, a lista de sócios e a lista de usuário - caso o Usuário logado tenha permissão para isso. Além
do mais na listagem de empresas você pode ver o quadro de sócios da empresa. Em todas as listagem você
pode editar e excluir um registro.

## Pré-requisitos

Antes de começar, verifique se sua máquina atende aos seguintes pré-requisitos:

- PHP >= 8.2.*
- Symfony 5.8
- Composer instalado (https://getcomposer.org/)
- Extensões PHP necessárias (consulte o arquivo `composer.json` para mais detalhes)
- PostgreSQL 16 (usuario: postgres, senha: postgres)

## Instalação

1. Clone este repositório para o seu ambiente local
2. Navegue até o diretório, abra o cmd e execute os seguintes comandos:

```PowerShell
composer install
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
symfony server:start
```

