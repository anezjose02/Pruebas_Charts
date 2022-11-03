### PASOS DE EJECUCION

#### 1. clonar el repositorio, trabajar en la rama que le corresponda

```
git clone -b (AQUI LA RAMA) https://github.com/GLOBONET-SOLUCIONES/MAYASOFT.git
```

#### 2. instalar las dependencias

```
composer install
npm i
```

### 3. desplegar el servidor 

```
php artisan key:generate
php artisan serve
```

previo a esto debe crear el .env basado en el .env.example

### 4. Opcional 

Ejecute el live server de laravel-mix para trabajr con js en caliente

```
npm run dev
```# MAYASOFT
