<h1 align="center">
  <img alt="cgapp logo" src="https://i.imgur.com/uuNxqx8.png" width="224px"/><br/>
  Onfly Rest | API Rest
</h1>
<p align="center">
    Um teste técnico com <b>backend</b> (Laravel), <b>ambiente de desenvolvimento facilitado</b> (Docker, Sail), <b>requisições prontas</b> (Insomnia) e <b>documentação impecável</b> (Swagger).
    <br/>
    <br/>
    Código <b>limpo</b>, <b>bem feito</b>, bem <b>documentado</b> e <b>performático</b>! É tudo isso e mais um pouco.
</p>

<hr>

<br />

<div align="center">

**[FILOSOFIA DO PROJETO](https://github.com/gabriellaporte/onfly) •
[TECH STACK](https://github.com/gabriellaporte/onfly) •
[CONSIDERAÇÕES FINAIS](https://github.com/gabriellaporte/onfly)**

</div>

<br />

# ☄ Filosofia do projeto
> O Onfly Rest foi desenvolvido como um teste técnico para a empresa Onfly, para concorrer à vaga de Desenvolvedor Pleno backend.
>
> A proposta é uma API, seguindo a arquitetura REST, que deverá conter um CRUD simples de despesas relacionadas a um usuário.
>
> E isso qualquer um faz. O diferencial do projeto, é que ele desenvolvido e pensado totalmente em: usar <b>Design Patterns</b>, seguir as boas práticas de <b>Clean Code</b> (SOLID, Object Calisthenics, etc.), seguir a filosofia <b>TDD</b> (Test Driven Development) e muito mais.
> Um outro foco do projeto foi fazer a documentação e a aplicação de comentários de forma organizada, tanto no código, quanto neste README que você está acessando, quanto em outros locais, como o Swagger (documentação da API), etc.

<br />

# 💻 Tech Stack
<br>
Aqui está uma breve visão geral de alto nível da Tech Stack utilizada no projeto:
<br /><br />


- Este projeto utiliza [o framework Laravel](https://laravel.com). Laravel é um framework backend em PHP poderosíssimo que segue a arquitetura MVC, deixando o desenvolvedor livre do fardo de lidar com "pequenos detalhes" de uma aplicação.
- Como banco de dados, o projeto utiliza o [MySQL](https://www.mysql.com), mas pode facilmente ser adaptado a outros RDBMS.
- Para os testes, é utilizado o [PHPUnit](https://phpunit.de), que já está incluido no Laravel.
- Para o versionamento, foi utilizado o CVS [Git](https://git-scm.com).
- Para o set-up no ambiente de desenvolvimento, foi utilizado o [Docker](https://www.docker.com) com o [Sail](https://laravel.com/docs/10.x/sail) (já incluso no Laravel)
- Para o servidor de e-mail, foi utilizado o [MailHog](https://github.com/mailhog/MailHog).
- Claramente, devido à necessidade de ferramentas de alto-nível, foi utilizado o Linux, com a distro [Ubuntu](https://ubuntu.com).

<br />

# ⚡️ Como Instalar
<br>

- Primeiramente, [instale](https://www.php.net/downloads.php) o PHP 8^.
> 🐱‍💻 Se você estiver procurando por uma instalação via CLI, no Ubuntu por exemplo, você pode encontrar [aqui](https://tecadmin.net/how-to-install-php-on-ubuntu-22-04/).

- [Baixe e instale](https://getcomposer.org/download/), também, o Composer como gerenciador de dependências.
> 🐱‍💻 Como dito acima, se você procura algo mais específico e rápido para CLI, você pode encontrar um tutorial [aqui](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04).

- Acesse algum diretório de sua preferência e baixe o projeto, usando:
```
git clone https://github.com/gabriellaporte/onfly.git .
```
> 🎈 Se você tiver problemas com a autenticação do Github (o token), você pode ver um tutorial [aqui](https://docs.github.com/pt/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token).

- Agora que os arquivos foram devidamente baixados para o seu diretório, configure o seu arquivo .env com base no arquivo .env.example:
```
cp .env.example .env
```

- Gere uma chave (APP_KEY) no seu .env
```
php artisan key:generate
```

- Instale todas as dependências e pacotes necessários para o projeto poder rodar:
```
composer update
```

- Se você estiver no Linux, MacOS ou no WSL2 pelo Windows, você pode facilmente ligar o projeto utilizando:
```
sail up -d
```
> ⏳ Isto pode levar algum tempo para buildar as imagens, caso você não tenha usado o Docker antes. Não se preocupe, acabará antes que você perceba.
>
> 🤔 Note que, daqui em diante, comandos PHP serão substituídos por "sail" (`alias sail="./vendor/bin/sail"`) , porém se você não usar Docker, utilize "php" mesmo.

- Crie as tabelas e popule elas com as Seeds de factories do Laravel, usando migrations:
```
sail artisan migrate --seed
```

- Lembre-se de deixar um "[worker](https://laravel.com/docs/10.x/queues#running-the-queue-worker)" rodando para o envio de e-mail assíncrono 🚨
```
sail artisan queue:work
```
> 📩 Você pode acessar o envio de e-mails [aqui](http://localhost:8025), com o Docker/Sail. Ou sinta-se livre para configurar um novo em .env.

✅ Pronto! Agora você está pronto para usar o projeto na sua máquina com essas etapas simples.
