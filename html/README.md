# ?? Alfasoft Contacts - Sistema de Gestão de Contactos

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)
![Tailwind](https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=for-the-badge&logo=tailwind-css)

## ?? Índice

- [?? Visão Geral](#-visão-geral)
- [? Funcionalidades](#-funcionalidades)
- [??? Stack Tecnológica](#?-stack-tecnológica)
- [?? Instalação e Configuração](#-instalação-e-configuração)
- [??? Estrutura do Projeto](#?-estrutura-do-projeto)
- [?? Autenticação](#-autenticação)
- [?? API's Integradas](#-apis-integradas)
- [?? Testes](#-testes)
- [?? Estatísticas e Métricas](#-estatísticas-e-métricas)
- [?? Comandos Artisan](#-comandos-artisan)
- [?? Troubleshooting](#-troubleshooting)
- [?? Contribuição](#-contribuição)
- [?? Licença](#-licença)

## ?? Visão Geral

Sistema completo de gestão de contactos desenvolvido em Laravel 10, seguindo as melhores práticas de desenvolvimento e arquitetura MVC. A aplicação permite gerir pessoas e seus contactos telefónicos com integração de APIs externas para enriquecimento de dados.

## ? Funcionalidades

### ?? Core Features
- **?? Gestão de Pessoas** - CRUD completo com validações avançadas
- **?? Gestão de Contactos** - Associação múltipla de contactos por pessoa
- **?? Sistema de Autenticação** - Controle de acesso granular
- **??? Soft Deletes** - Eliminação segura com possibilidade de recuperação
- **?? Internacionalização** - Suporte a códigos de país internacionais

### ?? Features Avançadas
- **?? Avatares Automáticos** - Geração via API de monstros aleatórios
- **?? Dashboard Estatístico** - Métricas e analytics de utilização
- **?? Validações Complexas** - Unicidade composta e regras customizadas
- **? Performance** - Cache estratégico e eager loading
- **?? UX/UI** - Interface responsiva com Tailwind CSS

## ??? Stack Tecnológica

### Backend
- **Laravel 10.x** - Framework PHP
- **PHP 8.1+** - Linguagem de programação
- **MySQL 8.0** - Base de dados
- **Eloquent ORM** - Mapeamento objeto-relacional

### Frontend
- **Tailwind CSS** - Framework CSS utility-first
- **Font Awesome 6** - Ícones
- **JavaScript Vanilla** - Interatividade cliente

### APIs Externas
- **REST Countries API** - Dados de países e códigos
- **Pixel Encounter API** - Geração de avatares

## ?? Instalação e Configuração

### Pré-requisitos

PHP >= 8.1
Composer >= 2.0
MySQL >= 8.0
Node.js

### 1. Clone o Repositório

git clone https://github.com/renanjansen/Alfasoft_Laravel_teste.git
cd Alfasoft_Laravel_teste/html


### ??? Estrutura do Projeto

app/
??? Console/
??? Exceptions/
??? Http/
?   ??? Controllers/
?   ?   ??? AuthController.php
?   ?   ??? PersonController.php
?   ?   ??? ContactController.php
?   ?   ??? StatsController.php
?   ??? Middleware/
?   ??? Requests/
?       ??? StorePersonRequest.php
?       ??? UpdatePersonRequest.php
?       ??? StoreContactRequest.php
?       ??? UpdateContactRequest.php
??? Models/
?   ??? Person.php
?   ??? Contact.php
??? Services/
    ??? CountryService.php

database/
??? migrations/
?   ??? xxxx_create_people_table.php
?   ??? xxxx_create_contacts_table.php
?   ??? xxxx_create_users_table.php
??? seeders/

resources/
??? views/
    ??? layouts/
    ?   ??? app.blade.php
    ??? people/
    ?   ??? index.blade.php
    ?   ??? create.blade.php
    ?   ??? edit.blade.php
    ?   ??? show.blade.php
    ??? contacts/
    ?   ??? create.blade.php
    ?   ??? edit.blade.php
    ?   ??? show.blade.php
    ??? auth/
    ?   ??? login.blade.php
    ??? stats/
        ??? contacts-by-country.blade.php

### ?? Autenticação

Email: admin@alfasoft.pt
Password: password123


### ?? Licença
Este projeto é desenvolvido para fins de avaliação técnica. Todos os direitos reservados.

### ????? Desenvolvido por
Renan Jansen
https://img.shields.io/badge/GitHub-renanjansen-181717?style=flat-square&logo=github

Sistema desenvolvido como parte do processo de avaliação técnica para posição de PHP/Laravel Developer

