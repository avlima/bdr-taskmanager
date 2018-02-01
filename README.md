# bdr-taskmanager
Teste de Conhecimentos – Analista  Desenvolvedor

##27h e não 24h para entrega do teste?
Pois é, me desculpem mas eu trabalho o dia todo e chego só após as 19h em casa. E por isso, somando ontem e hoje eu tive 7h no total para realizar o teste.
<br>
Peço mais uma vez para que me desculpem pelo atraso da entrega, eu gostaria de caprichar mais no projeto porém não tive um tempo hábil, então eu não foquei muito em validações de front para dedicar meu tempo justamente no que estava proposto no teste.

## Laravel e não CakePHP?
Isso mesmo, além de ser mais flexível e ter a comunidade mais ativa entre os frameworks, a diferença de performance entres eles é gritante.

## PHP 7.1 e não PHP 5.3?
Neste caso eu já acredito que esteja desatualizado a descrição do teste de conhecimento, pois php 5.3 já está ultrapassado de mais.
Com o php 7.* temos ganhos absurdos de performance e tipagem de código que ajudam muito na orientação.

## E as questões 1, 2 e 3 do teste?
Estão na pasta `resources/views`

##Api Rest
O projeto está todo em Rest, tanto que seria mais simples fazer de uma forma direta com formulários do front as requisições.
<br>
Mas eu quis fazer em js mesmo, assim vocês conseguem ver todas as rotas utilizadas.
<br>
Também exportei o api collection do Postman para vocês fazerem requisições sem depender do front.
A collection `BDR.postman_collection` está na pasta `public/`

## Instalação

1 - Banco de dados:

Copie o arquivo `bdr_taskmanager.sql` e execute-o para montar a estrutura de banco.
O arquivo `.env` na raiz do projeto, define os dados de conexão, por tanto edite os dados de conexão de acordo com suas credenciais.

2 - Dependencias do framework

Uma das observações da avaliação era: Frameworks e bibliotecas utilizados para solução devem estar inclusos no repositório.
<br>
Por tanto não há necessidade de rodar composer, as dependências já estou no commit.


3 - Iniciando PHP Built-in web server:

Na raiz do projeto execute:
```bash
php -S 127.0.0.1:8000 -t public/
```

ou

```bash
php -S 0.0.0.0:8000 -t public/
```

Outra opção é configurar o projeto no Apache, porem não descrevo aqui pois a configuração varia entre ambientes utilizados com S.O.

##Copyright and license

Code and documentation copyright (c) 2018, Code released under the New BSD license.