# Strappberry Laravel Starter Teams

## Equipo Strappberry

La documentación y estandares de este proyecto estan nuestro sistema de proyectos, revisalo por favor.

# Instalación

# Instalación en producción

```bash
make install

# Configurar los datos en el archivo .env

make update
```

### Instalación en desarrollo

> Si trabajas en Windows asegurate de usar **git bash**
> Debes instalar make, puedes usar choco
> `choco install make`

```bash
make install_dev
```

## Comandos utiles

`make install`: 
- Instala las dependencias en **Modo producción**
- Crea el archivo _.env_
- Genera la clave app_key de laravel

`make update`:
- Ejecuta git pull
- Verifica si hay dependencias de composer que instalar **Modo producción**
- Ejecuta las migraciones
- Construye los assets (css y js)
- Extrae la versión del commit
- Limpia el cache de laravel
- Recrea el cache con las nuevas configuraciones

`make install_dev`
- Instala las dependencias de composer y node en **Modo desarrollo**
- Crea el archivo _.env_
- General la clave app_key de laravel

`make build_assets`
- Construye los archivos css y js del proyecto (app.js, app.css)

`make upstream`
- Vincula la historia del repositorio actual al respositorio origen el starter
- DEBERA TENER ACCESO AL REPOSITORIO ORIGINAL PARA PODER OBTENER LAS NUEVAS CARACTERISTICAS DEL STARTER

## Layouts

```blade
<x-first-dashboard>
    {{ Breadcrumbs::render('dashboard') }}

    aqui va tu contenido
</x-first-dashboard>


<x-second-dashboard>
    {{ Breadcrumbs::render('dashboard') }}

    aqui va tu contenido
</x-second-dashboard>
```

## Componentes

- [https://tallstackui.com/docs/get-started](https://tallstackui.com/docs/get-started)
- [Interacción, dialogos y alertas](https://tallstackui.com/docs/interaction/toast)

#### Card
```blade
<x-card class="p-4 space-y-4">
    <p>hello</p>
</x-card>
```

#### Tooltip

```blade
<x-ui.tooltip text="Texto tooltip" class="">
    Texto a mostrar
</x-ui.tooltip>
```


https://devdojo.com/pines/docs/tabs
