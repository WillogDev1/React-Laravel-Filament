# **Projeto Laravel com Filament e Inertia.js**

Este projeto é uma aplicação web construída com **Laravel**, utilizando **Filament** para o painel administrativo e **Inertia.js** para a integração entre o backend e o frontend. Ele inclui funcionalidades como autenticação, login social, gerenciamento de serviços e um painel administrativo personalizável.

---

## **Índice**
1. [Tecnologias Utilizadas](#tecnologias-utilizadas)
2. [Requisitos](#requisitos)
3. [Instalação](#instalação)
4. [Configuração](#configuração)
5. [Funcionalidades](#funcionalidades)
6. [Estrutura do Projeto](#estrutura-do-projeto)
7. [Como Contribuir](#como-contribuir)
8. [Licença](#licença)

---

## **Tecnologias Utilizadas**

- **Backend**: Laravel 10
- **Frontend**: React com Inertia.js
- **Painel Administrativo**: Filament
- **Banco de Dados**: MySQL
- **Autenticação Social**: Laravel Socialite
- **Outras Bibliotecas**:
  - Tailwind CSS
  - Chart.js (para gráficos no painel)
  - Lucide React (ícones)

---

## **Requisitos**

Antes de começar, certifique-se de ter os seguintes requisitos instalados:

- PHP >= 8.1
- Composer
- Node.js >= 16
- MySQL ou outro banco de dados compatível
- NPM ou Yarn

---

## **Instalação**

Siga os passos abaixo para configurar o projeto localmente:

1. Clone o repositório:
   ```bash
   git clone https://github.com/WillogDev1/React-Laravel-Filament.git
   cd seu-repositorio
   ```

2. Instale as dependências do Laravel:
   ```bash
   composer install
   ```

3. Instale as dependências do Node.js:
   ```bash
   npm install
   ```

4. Copie o arquivo `.env.example` para `.env`:
   ```bash
   cp .env.example .env
   ```

5. Configure as variáveis de ambiente no arquivo `.env`:
   - Banco de dados:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=seu_banco
     DB_USERNAME=seu_usuario
     DB_PASSWORD=sua_senha
     ```
   - Credenciais do Google para login social:
     ```
     GOOGLE_CLIENT_ID=seu-client-id
     GOOGLE_CLIENT_SECRET=seu-client-secret
     GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
     ```

6. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```

7. Execute as migrações e seeds:
   ```bash
   php artisan migrate --seed
   ```

8. Compile os assets do frontend:
   ```bash
   npm run dev
   ```

9. Inicie o servidor:
   ```bash
   php artisan serve
   ```

---

## **Configuração**

### **Login Social**
- Certifique-se de configurar os provedores de login social no banco de dados.
- A tabela `services` deve conter os provedores com os campos `name` e `active`.

### **Painel Administrativo**
- O painel administrativo é gerenciado pelo Filament e pode ser acessado em:
  ```
  http://localhost:8000/admin
  ```
- Use as credenciais padrão criadas pelo seeder para acessar.

---

## **Funcionalidades**

### **Autenticação**
- Login com e-mail/senha.
- Login social com Google (e outros provedores configurados no futuro).
- Redefinição de senha.

### **Painel Administrativo**
- Gerenciamento de serviços (ativar/desativar provedores).
- Exibição de gráficos e estatísticas com Chart.js.

### **Frontend**
- Integração com Inertia.js para uma experiência SPA (Single Page Application).
- Layouts reutilizáveis com Tailwind CSS.

---

## **Estrutura do Projeto**

### **Backend**
- **Controladores**:
  - `AuthenticatedSessionController`: Gerencia login e autenticação.
  - `ProviderCallbackController`: Gerencia o callback de login social.
- **Modelos**:
  - `User`: Representa os usuários do sistema.
  - `Service`: Representa os provedores de login social.
- **Recursos do Filament**:
  - `ServiceResource`: Gerencia os serviços no painel administrativo.

### **Frontend**
- **Páginas**:
  - `resources/js/pages/auth/login.tsx`: Página de login.
- **Componentes**:
  - `resources/js/components/ui`: Componentes reutilizáveis (botões, inputs, etc.).
  - `resources/js/layouts`: Layouts para autenticação e painel.

---

## **Como Contribuir**

1. Faça um fork do repositório.
2. Crie uma branch para sua feature:
   ```bash
   git checkout -b minha-feature
   ```
3. Faça suas alterações e commit:
   ```bash
   git commit -m "Adiciona minha nova feature"
   ```
4. Envie suas alterações:
   ```bash
   git push origin minha-feature
   ```
5. Abra um Pull Request.

---

## **Licença**

Este projeto está licenciado sob a [MIT License](LICENSE).