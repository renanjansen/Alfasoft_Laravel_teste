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
- [??? Gestão de Base de Dados](#?-gestão-de-base-de-dados)
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
- **??? Gestão de BD** - Comandos e seeders para administração

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
```bash
PHP >= 8.1
Composer >= 2.0
MySQL >= 8.0
Node.js (opcional, para assets)
```

### 1. Clone o Repositório
```bash
git clone https://github.com/renanjansen/Alfasoft_Laravel_teste.git
cd Alfasoft_Laravel_teste/html
```

### 2. Instalação de Dependências
```bash
composer install
npm install  # Opcional - se usar assets compilados
```

### 3. Configuração do Ambiente
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configuração da Base de Dados
Edite o arquivo `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alfasoft_contacts
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_password
```

### 5. Execução de Migrações
```bash
php artisan migrate
```

### 6. Criação do Utilizador Padrão
```bash
php artisan db:seed --class=AdminUserSeeder
```

### 7. Servidor de Desenvolvimento
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

Acesse: http://127.0.0.1:8000

## ??? Estrutura do Projeto

```
app/
??? Console/
?   ??? Commands/
?       ??? ClearDatabase.php
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
    ??? AdminUserSeeder.php
    ??? ClearDatabaseSeeder.php

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
```

## ?? Autenticação

### Credenciais Padrão
```
Email: admin@alfasoft.pt
Password: password123
```

### Políticas de Acesso
- **Público**: Listar e visualizar pessoas/contactos
- **Autenticado**: Criar, editar e eliminar registos
- **Middleware**: Proteção granular por rota

### Estrutura de Segurança
```php
Route::middleware('auth')->group(function () {
    // Rotas protegidas
    Route::resource('people', PersonController::class)->except(['index', 'show']);
});
```

## ?? API's Integradas

### REST Countries API
- **Função**: Obter dados de países e códigos telefónicos
- **Endpoint**: `https://restcountries.com/v3.1/all`
- **Cache**: 1 hora para performance
- **Fallback**: Países predefinidos em caso de falha

### Pixel Encounter API
- **Função**: Gerar avatares aleatórios em SVG
- **Endpoint**: `https://app.pixelencounter.com/api/basic/monsters/random`
- **Formato**: SVG vectorial
- **Fallback**: Avatar padrão com iniciais

## ??? Gestão de Base de Dados

### Comandos de Limpeza e Reset

```bash
# Reset completo do banco (RECOMENDADO)
php artisan migrate:fresh

# Limpar dados mantendo estrutura
php artisan db:seed --class=ClearDatabaseSeeder

# Criar/recriar usuário admin
php artisan db:seed --class=AdminUserSeeder

# Comando personalizado para limpeza
php artisan db:clear
```

### Seeders Disponíveis

- **`AdminUserSeeder`** - Cria usuário administrativo padrão
- **`ClearDatabaseSeeder`** - Limpa todas as tabelas preservando estrutura

### Estado Inicial do Sistema

Após instalação, o sistema inclui:
- ? Tabelas estruturadas
- ? Usuário admin: `admin@alfasoft.pt` / `password123`
- ? APIs configuradas e testadas

## ?? Testes

### Testes Manuais Recomendados

1. **CRUD de Pessoas**
```bash
# Criar pessoa com dados válidos
# Tentar criar com email duplicado
# Editar pessoa existente
# Soft delete e verificar invisibilidade
```

2. **CRUD de Contactos**
```bash
# Adicionar contacto com país válido
# Tentar contacto duplicado (país + número)
# Validar formato de número (9 dígitos)
```

3. **Autenticação**
```bash
# Acesso sem autenticação
# Login com credenciais válidas
# Logout e redirecionamento
```

4. **Validações**
```bash
# Nome com menos de 5 caracteres
# Email inválido
# Número com formato incorreto
```

5. **Gestão de Base de Dados**
```bash
# Testar reset completo
php artisan migrate:fresh && php artisan db:seed --class=AdminUserSeeder

# Verificar estado do banco
php artisan tinker
\App\Models\User::count(); // Deve retornar 1
```

## ?? Estatísticas e Métricas

### Métricas Disponíveis
- Total de pessoas registadas
- Total de contactos por pessoa
- Distribuição de contactos por país
- Percentagens e visualizações gráficas
- Países únicos com contactos

### Acesso às Estatísticas
```bash
# URL directa
http://127.0.0.1:8000/stats/contacts-by-country

# Through UI
Navegação ? Estatísticas
```

## ?? Comandos Artisan

### Desenvolvimento
```bash
php artisan serve                          # Servidor local
php artisan migrate                        # Executar migrações
php artisan migrate:status                 # Status das migrações
php artisan route:list                     # Listar rotas
```

### Gestão de Base de Dados
```bash
php artisan migrate:fresh                  # Reset completo do BD
php artisan db:seed --class=AdminUserSeeder # Criar usuário admin
php artisan db:seed --class=ClearDatabaseSeeder # Limpar dados
php artisan db:clear                       # Limpar dados (comando customizado)
```

### Manutenção
```bash
php artisan cache:clear                   # Limpar cache
php artisan config:clear                  # Limpar configurações
php artisan view:clear                    # Limpar views compiladas
php artisan route:clear                   # Limpar rotas em cache
```

### Troubleshooting
```bash
php artisan tinker                        # Console interativo
tail -f storage/logs/laravel.log          # Monitorar logs
composer dump-autoload                    # Recarregar autoload
```

## ?? Troubleshooting

### Problemas Comuns e Soluções

1. **Erro de migração "Table already exists"**
```bash
php artisan migrate:fresh
php artisan db:seed --class=AdminUserSeeder
```

2. **API Countries não responde**
```bash
# Verificar conectividade
curl -I https://restcountries.com/v3.1/all

# Limpar cache
php artisan cache:clear
```

3. **Erro 404 em rotas protegidas**
```bash
# Verificar autenticação
php artisan route:list | grep auth

# Verificar se usuário admin existe
php artisan tinker
\App\Models\User::where('email', 'admin@alfasoft.pt')->exists();
```

4. **Problemas de sessão**
```bash
# Limpar sessões
rm -f storage/framework/sessions/*

# Verificar configuração .env
SESSION_DRIVER=file
```

5. **Usuário admin não existe**
```bash
# Recriar usuário admin
php artisan db:seed --class=AdminUserSeeder

# Ou via tinker
php artisan tinker
\App\Models\User::create([
    'name' => 'Administrador', 
    'email' => 'admin@alfasoft.pt',
    'password' => Hash::make('password123')
]);
```

### Logs e Debug
```bash
# Nível de log (.env)
APP_DEBUG=true
APP_ENV=local

# Monitoramento em tempo real
tail -f storage/logs/laravel.log

# Verificar estado da aplicação
php artisan about
```

## ?? Contribuição

### Guidelines de Desenvolvimento

1. **Branch Strategy**
```bash
git checkout -b feature/nome-da-feature
git checkout -b fix/nome-do-fix
git checkout -b docs/nome-da-documentacao
```

2. **Commit Convention**
```bash
git commit -m "feat: adiciona gestão de avatares"
git commit -m "fix: corrige validação de email"
git commit -m "docs: atualiza README"
git commit -m "chore: adiciona seeders de BD"
```

3. **Code Standards**
- PSR-12 coding standards
- PHPStan level 8
- Laravel Pint para formatação
- Testes unitários para novas funcionalidades

### Processo de PR
1. Fork do repositório
2. Branch feature/fix/docs
3. Tests e linting
4. Atualização de documentação
5. Pull Request com descrição detalhada

## ?? Licença

Este projeto é desenvolvido para fins de avaliação técnica. Todos os direitos reservados.

---

## ????? Desenvolvido por

**Renan Jansen**  
[![GitHub](https://img.shields.io/badge/GitHub-renanjansen-181717?style=flat-square&logo=github)](https://github.com/renanjansen)

> *Sistema desenvolvido como parte do processo de avaliação técnica para posição de PHP/Laravel Developer*

---

<div align="center">

**? Se este projeto foi útil, considere dar uma estrela no repositório!**

**?? [Acessar Aplicação](http://127.0.0.1:8000) | ?? [Contactar Desenvolvedor](mailto:renanjansen-lv@recruitment.alfasoft.pt)**

</div>

---

### ?? Suporte

Em caso de problemas técnicos ou dúvidas sobre a implementação:

1. **Verifique a seção de Troubleshooting**
2. **Consulte os logs da aplicação**
3. **Teste os comandos de reset da base de dados**
4. **Entre em contacto com o desenvolvedor**

