# easyMVC
Arquitetura básica MVC usando MySql para desenvolvimento de software web e RESTapi.
Esse projeto possui interface CRUD com o banco de dados, função automatizada para geração de tabelas 
e usa URL amigável com o usuário.
A ideia principal é desenvolver software de maneira ágil utilizando e mantendo o código organizado e 
permitindo a automatização de funções, ou seja, a reutilização de códigos e também permitindo a 
integração de componentes de software desenvolvido por terceiros de maneira simples.


A tela CRUD de empresas que está incluida nesse projeto foi designado para demonstração do meu conhecimento e
também pode ser usado para exemplo de desenvolvimento.


A instalação é simples, basta copiar para o diretório do seu servidor WAMP ou LAMP os arquivos. Além disso você
deverá configurar os seguintes items:
  1. Deverá abilitar o módulo rewrite. 
  <br>tutorial(windows): https://imasters.com.br/artigo/5382/web-standards/url-rewriting-criando-urls-competitivas/?trace=1519021197&source=single
  <br>tutorial(ubuntu): https://www.digitalocean.com/community/tutorials/how-to-set-up-mod_rewrite-for-apache-on-ubuntu-14-04
  
  2. Na pasta do programa vá em _core/mysql abra o arquivo Mysql_con.class.php e adicione o usuario e senha do banco de dados.
  
  3. Por fim crie um banco de dados nomeado "marte" e insira a seguinte query:
  <p><code>create table empresas (
    id int(6) unsigned not null auto_increment,
    cnpj varchar(20) not null,
    socialName varchar(200) not null,
    fancyName varchar(200) not null,
    ddd int(3) not null,
    phoneNumber varchar(10) not null,
    website varchar(255) default '', 
    primary key(id));</code></p>

O software está pronto para uso.
Acesse pelo localhost e insira os primeiros registros, as outras opções CRUD estão disponíveis logo após clicar em um dado da lista de empresas.
