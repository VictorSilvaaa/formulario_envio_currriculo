
# 📌 Formulário de Envio de Currículos

- Este projeto permite o envio de currículos via formulário web, com validação, armazenamento em banco de dados, envio de e-mail de comprovante e testes automatizados.
- <img width="200" height="400" alt="{C4C99159-74B3-4C3D-8A3F-6ABBC0ECD6B8}" src="https://github.com/user-attachments/assets/162bdf0f-f0e8-4f5c-89d5-39e249905e99" />
---

## 🚀 Descrição do Projeto
O sistema registra os dados do candidato, armazena o currículo e dispara um e-mail de confirmação. Utiliza arquitetura separada para frontend (Vue.js) e backend (Laravel).

---

## 📝 Funcionalidades
- Formulário com os campos:
  - Nome (obrigatório)
  - E-mail (obrigatório, formato válido)
  - Telefone (obrigatório, formato brasileiro)
  - Cargo desejado (obrigatório)
  - Escolaridade (obrigatório, select dinâmico)
  - Observações (opcional)
  - Arquivo (.doc, .docx, .pdf, até 1MB)
  - Data/hora do envio (automática)
  - Ip (automática)
  
- Validação completa dos dados
- Armazenamento em banco relacional
- Envio de e-mail de comprovante
- Testes unitários e de integração

---

## ⚙️ Instalação e Configuração

### 1. Clonando o projeto
```sh
git clone https://github.com/VictorSilvaaa/formulario_envio_currriculo.git
cd formulario_envio_currriculo
```
### 3. Configurando variáveis de ambiente

Copie e ajuste o arquivo `.env` do backend conforme seu ambiente ou copie do env.example.

### 5. Instalação e Execução (via Docker)

Na raiz do projeto, execute:
```sh
docker compose up -d
```
Isso irá subir todos os serviços necessários: backend (Laravel), frontend (Vue.js), banco de dados (MySQL), nginx, mailhog e phpmyadmin.

#### Rodando migrations e seeders dentro do container

Após subir os containers, acesse o container do backend:
```sh
docker exec -it laravel-backend bash
```
Dentro do container, rode:
```sh
php artisan key:generate
php artisan migrate --seed
```
Isso irá criar as tabelas e popular as tabelas necessárias.

---

## 🌐 Rotas de acesso

### Frontend
- [http://localhost:5173](http://localhost:5173)

### API
- Enviar currículo: `POST http://localhost:8080/api/curriculos`
- Buscar escolaridades: `GET http://localhost:8080/api/escolaridades`

### Mailhog (visualizar e-mails)
- [http://localhost:8025](http://localhost:8025)

---

## 🧪 Testes

No backend:
```sh
php artisan test
```
Executa todos os testes unitários e de integração.

---

## 📚 Observações
- O projeto segue PSR-4 e boas práticas Laravel.
- As migrations e seeders estão em `backend/database/migrations` e `backend/database/seeders`.
- Testes estão em `backend/tests/Feature` e `backend/tests/Unit`.
- O frontend consome a API do backend e carrega dependências dinamicamente.
