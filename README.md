# SpotRate

SpotRate é uma aplicação web para avaliação de locais.

## Stack

- **Backend:** PHP 8.3, Laravel
- **Frontend:** Vite, Tailwind CSS, Alpine.js
- **Database:** MySQL 8.0
- **Cache:** Redis
- **Web Server:** Nginx
- **Containerization:** Docker
- **Tests:** Pest

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
    docker-compose exec node npm install
    ```

## Uso

-   **URL:** [http://localhost:8000](http://localhost:8000)

Para compilar os assets, execute o seguinte comando fora do container:
```bash
npm run build
```

## Rodar os testes

Para rodar os testes, execute o seguinte comando dentro do container:
```bash
docker-compose exec app php artisan test
