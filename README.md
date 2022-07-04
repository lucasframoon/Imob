# Imob

Aplicação para gerencimento de imoveis e midias.

## 📦 O que essa aplicação faz até o momento:

  Cria, Consulta, Edita e Deleta Imoveis
  
  Adiciona arquivos e suas informações, consulta e deleta, podendo estar associados a um imovel ou não.
  
  TODO: Upload do arquivo para S3 AWS e gerenciamento do mesmo.
  

## 🚀 Começando

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e teste


### 📋 Pré-requisitos

  É recomendado que tenha o docker instalado, pois há um ambiente montado para rodar o projeto sem precisar de muitas configurações
  
  Também é recomendado que tenha uma IDE para Mysql.


### 🔧 Instalação

  Clonar o ambiente docker `git clone https://github.com/lucasframoon/docker-php.git`
  
  Em: docker-php, clone esse projeto `git clone https://github.com/lucasframoon/imob.git`
  
   OBS: A pasta public deve ficar no mesmo nivel do arquivo docker-compose.yml
   
  Abra no seu editor e use o comando 'docker-compose up' para criar e rodar as imagens docker
  
  Tudo pronto.

  *localhost está configurado para localhost:45000.
  
  Para configurar o acesso da base de dados pelo Workbench ou outra ide consulte o arquivo public/app/Db/database.php
  

### 🛠️ Construído com

PHP
Javascript, Jquery
HTML, Css, Bootstrap
Google Autocomplete e Google Maps


por Lucas Franco 😊
