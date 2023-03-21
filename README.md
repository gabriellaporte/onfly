<h1 align="center">
  <img alt="cgapp logo" src="https://i.imgur.com/uuNxqx8.png" width="224px"/><br/>
  Onfly Rest | API Rest
</h1>
<p align="center">
    Um teste técnico com <b>backend</b> (Laravel), <b>ambiente de desenvolvimento facilitado</b> (Docker, Sail), <b>requisições prontas</b> e <b>documentação impecável</b> (Postman).
    <br/>
    <br/>
    Código <b>limpo</b>, <b>bem feito</b>, bem <b>documentado</b> e <b>performático</b>! É tudo isso e mais um pouco.
</p>

<hr>

<br />

<div align="center">

**[FILOSOFIA DO PROJETO](https://github.com/gabriellaporte/onfly#-filosofia-do-projeto) •
[TECH STACK](https://github.com/gabriellaporte/onfly#-tech-stack) •
[COMO INSTALAR](https://github.com/gabriellaporte/onfly#%EF%B8%8F-como-instalar) •
[DOCUMENTAÇÃO E API](https://github.com/gabriellaporte/onfly#-documenta%C3%A7%C3%A3o-e-api) •
[CONSIDERAÇÕES FINAIS](https://github.com/gabriellaporte/onfly#-considerações-finais)**

</div>

<br />

# ☄ Filosofia do projeto
> O Onfly Rest foi desenvolvido como um teste técnico para a empresa Onfly, para concorrer à vaga de Desenvolvedor Pleno backend.
>
> A proposta é uma API, seguindo a arquitetura REST, que deverá conter um CRUD simples de despesas relacionadas a um usuário.
>
> E isso qualquer um faz. O diferencial do projeto, é que ele desenvolvido e pensado totalmente em: usar <b>Design Patterns</b>, seguir as boas práticas de <b>Clean Code</b> (SOLID, Object Calisthenics, etc.) e muito mais.
> Um outro foco do projeto foi fazer a documentação e a aplicação de comentários de forma organizada, tanto no código, quanto neste README que você está acessando, quanto em outros locais, como o Postman (documentação da API, requests prontos), etc.

<br />

# 💻 Tech Stack
<br>
Aqui está uma breve visão geral de alto nível da Tech Stack utilizada no projeto:
<br /><br />


- Este projeto utiliza o [framework Laravel](https://laravel.com). Laravel é um framework backend em PHP poderosíssimo que segue a arquitetura MVC, deixando o desenvolvedor livre do fardo de lidar com "pequenos detalhes" de uma aplicação.
- Como banco de dados, o projeto utiliza o [MySQL](https://www.mysql.com), mas pode facilmente ser adaptado a outros RDBMS.
- Para os testes, é utilizado o [PHPUnit](https://phpunit.de), que já está incluido no Laravel.
- Para o versionamento, foi utilizado o CVS [Git](https://git-scm.com).
- Para o set-up no ambiente de desenvolvimento, foi utilizado o [Docker](https://www.docker.com) com o [Sail](https://laravel.com/docs/10.x/sail) (já incluso no Laravel)
- Para o servidor de e-mail, foi utilizado o [MailHog](https://github.com/mailhog/MailHog).
- Claramente, devido à necessidade de ferramentas de alto-nível, foi utilizado o Linux, com a distro [Ubuntu](https://ubuntu.com).
- Para gerar documentação e ter uma Collection pronta para uso da API, foi utilizado o [Postman](https://www.postman.com/).

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

- Instale todas as dependências e pacotes necessários para o projeto poder rodar:
```
composer update
```

- Gere uma chave (APP_KEY) no seu .env
```
php artisan key:generate
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

<br />

# 📃 Documentação e API
<br>

O uso do [Postman](https://www.postman.com/) é extremamente encorajado, uma vez que a documentação e os recursos prontos estão disponíveis de modo fácil e rápido lá.

- Toda a documentação está disponível em https://documenter.getpostman.com/view/25007742/2s93K1pzYM, e você pode acessá-la para entender um pouco mais de como o sistema funciona.
- [Clique aqui para baixar](https://drive.google.com/file/d/1RlalOQHGfhJO-irNlZuxPEC6Y9tdNzfA/view?usp=sharing) os recursos já pré-definidos e prontos no Postman. Importe o arquivo no seu cliente ou na web.

> Se você tem alguma dúvida sobre o import/export no Postman, você pode consultar [este guia](https://learning.postman.com/docs/getting-started/importing-and-exporting-data/).

Os scripts já estão devidamente configurados para setar os headers, token, ID de usuário, data atual, etc. de maneira automática. É só baixar e usar! 🚀

<br />

# 👋 Considerações Finais
<br>

Os requisitos do projeto foram poucos, por ser uma API Rest bastante enxuta e com poucas necessidades. No entanto, o projeto teve o máximo de capricho e utilizou de ferramentas/técnicas como (clique nos links para ver o processo de desenvolvimento):

- [Whimiscal](https://whimsical.com/diagrama-de-banco-de-dados-onfly-rest-L2qukKgZrpHTNSXGaMz2Dt) para planejamento do schema de banco de dados;
- PHPUnit para testes unitários e de features (`sail artisan test`);
- [Trello](https://trello.com/invite/b/D7Ud8L0i/ATTIab29113f3447ebb863bcde2af33e53c999744EAF/dev-tasks) para metodologia ágil Kanban;
- Clean Code e Clean Architecture (SOLID, Object Calisthenics, etc.);
- Design Patterns (Builder, Facade, Strategy, Repository, etc.);
- API Resources;
- Route Resources;
- Middlewares;
- Policies para ACL;
- Events e Listeners;
- Notifications;
- Queues;
- Exception Handlers;
- Traits;
- Form Requests;
- Providers (EventServiceProvider e RouteServiceProvider customizados)
- Muito mais... 🚀

> ❌ Alguns outros conceitos como Services, Factory, etc. poderiam ser aplicados, mas não houve a necessidade. [Saiba um pouco mais de overengineering](https://musli.hashnode.dev/laravel-lesson-of-the-week-how-to-avoid-over-engineering) e o porquê de evitar a aplicação de alguns conceitos desnecessários.

> 🔎 Além do mais, na API, poderíamos ter usado filtros, paginação, ordenação (sort) etc. facilmente com pacotes como o [Laravel Query Builder by Spatie](https://spatie.be/index.php/docs/laravel-query-builder/v5/introduction); porém não foi informado como requisito no Teste Técnico.

<br />

# 💙 Agradecimentos
<br>

Em primeiro lugar, a Deus. SDG! Em segundo lugar, à minha melhor amiga e amada noiva: Ana. Em terceiro lugar, à minha família e amigos. Todos me deram o devido suporte em cada etapa, incluindo todo o desenvolvimento deste Teste Técnico.

Também, aos funcionários da Onfly: por me "emprestarem" o seu precioso tempo em analisar esse projeto (agradecimentos especiais à Selena, que tão gentilmente me incluiu no processo).

<br>

💡 "O gênio é 1% de inspiração e 99% de transpiração" - Thomas Edison.
