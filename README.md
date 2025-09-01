# 📌 Formulário de Envio de Currículos  

Este projeto tem como objetivo disponibilizar um **formulário para envio de currículos**, aplicando boas práticas de desenvolvimento, validação de dados, integração com banco de dados e envio de e-mail.  

---

## 🚀 Descrição do Projeto  
O sistema permite que candidatos enviem seus currículos de forma simples e segura.  
As informações são registradas em banco de dados, incluindo o IP e a data/hora do envio, e um e-mail é disparado com os dados do formulário.  

---

## 📝 Funcionalidades  
- 📌 Formulário com os seguintes campos:  
  - Nome (obrigatório)  
  - E-mail (obrigatório, formato válido)  
  - Telefone (obrigatório)  
  - Cargo desejado (obrigatório, campo texto livre)  
  - Escolaridade (obrigatório, campo select)  
  - Observações (opcional)  
  - Arquivo (obrigatório, extensões permitidas: `.doc`, `.docx`, `.pdf`, máximo **1MB**)  
  - Data e hora do envio (automática)  

- ✅ Validações de campos obrigatórios e regras de negócio.  
- 🗄️ Armazenamento em banco de dados contendo:  
  - Dados do formulário  
  - IP do usuário  
  - Data e hora do envio  

- 📧 Envio de e-mail com os dados do formulário.  
- 🧪 Testes unitários para garantir a confiabilidade da aplicação.  

---

## 📂 Requisitos Técnicos  
- Padrão **PSR-4** para organização de classes.  
- Gerenciamento de dependências via **Composer**.  
- Uso de **framework** (ou não), de acordo com a preferência do desenvolvedor.  
- Banco de dados relacional para persistência das informações.  
- Testes unitários implementados.   
