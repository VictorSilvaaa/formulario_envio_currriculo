FROM node:22-alpine

WORKDIR /app

# Copiar arquivos do projeto **primeiro**
COPY frontend/ ./

# Instalar dependências dentro do container
RUN npm install

# Expor porta do Vite
EXPOSE 5173

# Rodar servidor de desenvolvimento
CMD ["npm", "run", "dev", "--", "--host"]
