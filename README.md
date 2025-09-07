# SpotRate

[![CI](https://github.com/pedromeirellesc/spotrate/actions/workflows/ci.yaml/badge.svg)](https://github.com/pedromeirellesc/spotrate/actions/workflows/ci.yaml) [![codecov](https://codecov.io/gh/pedromeirellesc/spotrate/graph/badge.svg)](https://codecov.io/gh/pedromeirellesc/spotrate) ![PHP Version](https://img.shields.io/badge/PHP-8.3-blue)

SpotRate é uma aplicação web para avaliação de locais.

- **Laravel**
- **Tailwind**
- **Alpine.js**
- **MySQL**
- **Redis**
- **Nginx**
- **Docker**
- **Pest**

### Instalação

1.  **Clone do repositório:**
    ```bash
    git clone https://github.com/pedromeirellesc/spotrate.git
    cd spotrate-app
    ```

2.  **Copie o arquivo `.env.example` para `.env`:**
    ```bash
    cp .env.example .env
    ```

3.  **Inicie os containers Docker:**
    ```bash
    docker-compose up -d
    ```

4.  **Instale as dependências do Composer:**
    ```bash
    docker-compose exec app composer install
    ```

5.  **Gere a chave aleatória:**
    ```bash
    docker-compose exec app php artisan key:generate
    ```

6.  **Rode as migrations:**
    ```bash
    docker-compose exec app php artisan migrate
    ```

7.  **Instale as dependências do Node:**
    ```bash
    node npm install
    ```

### Acessar a aplicação

-   **URL:** [http://localhost:8000](http://localhost:8000)

Para compilar os assets, execute o seguinte comando fora do container:
```bash
npm run build
```

### Rodar os testes

Para rodar os testes, execute o seguinte comando dentro do container:
```bash
docker-compose exec app php artisan test
