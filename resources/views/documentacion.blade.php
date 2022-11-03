@extends('adminlte::page')

@section('title', 'Documentación')

@section('content_header')

@stop

@section('content')
    <div id="app">
        <div class="content-header px-0 py-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 p-0">
                        <h1 class="m-0">
                            Documentación
                        </h1>
                    </div>
                    <div class="col-sm-6 p-0">
                        <b-breadcrumb class="float-right">
                            <b-breadcrumb-item href="#home">
                                {{-- <b-icon icon="house-fill" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon> --}}
                                {{-- {{ Auth::user()->sistema ? '(' . Auth::user()->sistema . ') ' : '' }} --}}
                                Inicio
                            </b-breadcrumb-item>
                            <b-breadcrumb-item active>Documentación</b-breadcrumb-item>
                        </b-breadcrumb>
                    </div>
                </div>
            </div>
        </div>

        <b-card no-body class="shadow-lg">
            <b-card-body>
                <div class="accordion" role="tablist">
                    <b-card no-body class="mb-1 card-round">
                        <b-card-header header-tag="header" class="hover" role="tab" v-b-toggle.accordion-1>
                            <b-button class="float-right" variant="success" size="sm">
                                <i class="fas fa-chevron-down"></i>
                            </b-button>
                            <h5>
                                Introducción:
                            </h5>

                        </b-card-header>
                        <b-collapse id="accordion-1" accordion="my-accordion" role="tabpanel">
                            <b-card-body>
                                <p class="text-justify">
                                    Esta documentación ha sido creada conforme a lo acordado con Globonet Soluciones,
                                    para el correcto mantenimiento, correción y/o modificación del sistema a nivel de
                                    código.
                                </p>
                                <p class="text-justify">
                                    Las tecnologías usadas en este sistema son las siguientes.
                                <ul>
                                    <li>
                                        <strong>
                                            PHP
                                        </strong>
                                        7.4 o superior para el correcto funcionamiento del sistema.
                                    </li>
                                    <li>
                                        <strong>
                                            Laravel
                                        </strong>
                                        Framework PHP especificamente la verion 7 de Laravel.
                                    </li>
                                    <li>
                                        <strong>
                                            Vue JS
                                        </strong>
                                        Framework de Javascript para la interactividad del fornt-end.
                                    </li>
                                    <li>
                                        <strong>
                                            Bootstrap
                                        </strong>
                                        Versión 4. Framework CSS para los estilos del sistema general.
                                    </li>
                                </ul>
                                </p>
                                <p class="text-justify">
                                    El uso de cada una de estas tecnologías está estrictamente apegada a su documentación,
                                    y estándares del lenguaje respectivo. En la siguiente sección encontrará la los links de
                                    cada librería y framework usados explicitamente, para complementar esta documentación.
                                </p>
                            </b-card-body>
                        </b-collapse>
                    </b-card>

                    <b-card no-body class="mb-1 card-round">
                        <b-card-header v-b-toggle.accordion-2 header-tag="header" class="hover" role="tab">

                            <b-button class="float-right" variant="success" size="sm">
                                <i class="fas fa-chevron-down"></i>
                            </b-button>
                            <h5>
                                Librerías:
                            </h5>



                        </b-card-header>
                        <b-collapse id="accordion-2" accordion="my-accordion" role="tabpanel">
                            <b-card-body>
                                <p>
                                    Para el sistema se han usado las siguientes librerías de desarrollo:
                                <div class="table-responsive">
                                    <table class="table striped">
                                        <thead>
                                            <tr>
                                                <th>Librería/Framework</th>
                                                <th>Versión</th>
                                                <th>Lenguaje</th>
                                                <th>Url</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        Laravel
                                                    </strong>
                                                </td>
                                                <td>
                                                    7.x
                                                </td>
                                                <td>
                                                    PHP
                                                </td>
                                                <td>
                                                    <a href="https://laravel.com/docs/7.x">
                                                        https://laravel.com/docs/7.x
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        Vue JS
                                                    </strong>
                                                </td>
                                                <td>
                                                    2.x
                                                </td>
                                                <td>
                                                    Javascript
                                                </td>
                                                <td>
                                                    <a href="https://v2.vuejs.org/">
                                                        https://v2.vuejs.org/
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        Bootstrap
                                                    </strong>
                                                </td>
                                                <td>
                                                    4.x
                                                </td>
                                                <td>
                                                    CSS
                                                </td>
                                                <td>
                                                    <a href="https://getbootstrap.com/docs/4.6/">
                                                        https://getbootstrap.com/docs/4.6/
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        Bootstrap-vue
                                                    </strong>
                                                </td>
                                                <td>
                                                    2.x
                                                </td>
                                                <td>
                                                    Javascritp, y CSS, librería de componentes para vue.
                                                </td>
                                                <td>
                                                    <a href="https://bootstrap-vue.org/docs">
                                                        https://bootstrap-vue.org/docs
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        Laravel-AdminLTE
                                                    </strong>
                                                </td>
                                                <td>
                                                    3.x
                                                </td>
                                                <td>
                                                    Complemento para Laravel, usado para la creación gráfica del tema
                                                    administrativo
                                                    de Laravel
                                                </td>
                                                <td>
                                                    <a
                                                        href="https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Installation">
                                                        https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Installation
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        econea/nusoap
                                                    </strong>
                                                </td>
                                                <td>
                                                    0.x
                                                </td>
                                                <td>
                                                    PHP
                                                </td>
                                                <td>
                                                    <a href="https://github.com/f00b4r/nusoap">
                                                        https://github.com/f00b4r/nusoap
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        Merlyna WS
                                                    </strong>
                                                </td>
                                                <td>

                                                </td>
                                                <td>
                                                    API Web Service para la consulta de datos de personas y empresas
                                                </td>
                                                <td>
                                                    <a href="https://ws.merlyna.com/app/ws/index.php?id=1">
                                                        https://ws.merlyna.com/app/ws/index.php?id=1
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        ChartJS
                                                    </strong>
                                                </td>
                                                <td>
                                                    3.*
                                                </td>
                                                <td>
                                                    Librería Javascript para generación de gráficos estadísticos.
                                                </td>
                                                <td>
                                                    <a href="https://www.chartjs.org/docs/3.7.0/">
                                                        https://www.chartjs.org/docs/3.7.0/
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        vue-jstree
                                                    </strong>
                                                </td>
                                                <td>
                                                    1.*
                                                </td>
                                                <td>
                                                    Librería Javascript para tablas con modelo de arbol, tipo sistema de
                                                    archivos.
                                                </td>
                                                <td>
                                                    <a href="https://www.npmjs.com/package/vue-jstree/v/1.0.12">
                                                        https://www.npmjs.com/package/vue-jstree/v/1.0.12
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        vue-select
                                                    </strong>
                                                </td>
                                                <td>
                                                    3.*
                                                </td>
                                                <td>
                                                    Librería Javascript para selectores con buscador.
                                                </td>
                                                <td>
                                                    <a
                                                        href="https://vue-select.org/guide/values.html#transforming-selections">
                                                        https://vue-select.org/guide/values.html#transforming-selections
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        file-saver
                                                    </strong>
                                                </td>
                                                <td>
                                                    2.*
                                                </td>
                                                <td>
                                                    Genera un documento para descargar desde javascript del cliente.
                                                </td>
                                                <td>
                                                    <a href="https://vuejscomponent.com/package?name=file-saver">
                                                        https://vuejscomponent.com/package?name=file-saver
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        momentjs
                                                    </strong>
                                                </td>
                                                <td>
                                                    2.*
                                                </td>
                                                <td>
                                                    Maneja fechas en javascript.
                                                </td>
                                                <td>
                                                    <a href="https://momentjs.com/">
                                                        https://momentjs.com/
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                </p>
                            </b-card-body>
                        </b-collapse>
                    </b-card>

                    <b-card no-body class="mb-1 card-round">
                        <b-card-header v-b-toggle.accordion-3 header-tag="header" class="hover" role="tab">
                            <b-button class="float-right" variant="success" size="sm">
                                <i class="fas fa-chevron-down"></i>
                            </b-button>
                            <h5>
                                COMPONENTES VUE:
                            </h5>

                        </b-card-header>
                        <b-collapse id="accordion-3" accordion="my-accordion" role="tabpanel">
                            <b-card-body>
                                <p>
                                    En esta sección se enlistarán los componentes Vue JS de creación implicita del sistema,
                                    junto con su forma de uso.
                                </p>

                                <hr>

                                <h3>
                                    <strong>
                                        Componente {{ '<t-general>' }}
                                    </strong>
                                </h3>
                                <p>
                                    <strong>
                                        Descripción:
                                    </strong>
                                    Es una tabla general que se conecta de forma asincrona al servidor para peticiones AJAX
                                    a travez de AXIOS.
                                </p>
                                <p>
                                    <strong>
                                        Slot:
                                    </strong>
                                    El slot de este componente se ubica en el header de la tarjeta(b-card) del componente.
                                </p>
                                <p>
                                    <strong>
                                        Propiedades:
                                    </strong>
                                    A continuación una descripción de las propiedades que debe pasarle a este componente:
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Propiedad</th>
                                                <th>Tipo</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    title
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Es el nombre con el que se mostrará la tabla.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    url
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Es la direccíon relativa(si es una dirección interna del sistema), o
                                                    absoluta
                                                    de donde se traerán los datos, este end-point debe obligatoriamente
                                                    retornar
                                                    una lista de elementos preparados para paginación.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    reloadtabla
                                                </td>
                                                <td>
                                                    number
                                                </td>
                                                <td>
                                                    Debe pasar este parametro como "sync", es usado para llamar la acción de
                                                    recargar tabla, la misma que refresca la tabla de forma asíncrona.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    prefields
                                                </td>
                                                <td>
                                                    json
                                                </td>
                                                <td>
                                                    Es el arreglo Json que representa a los cmapos de la tabla, para saber
                                                    como
                                                    funciona dirijase al siguiente link
                                                    <a
                                                        href="https://bootstrap-vue.org/docs/components/table#fields-column-definitions">https://bootstrap-vue.org/docs/components/table#fields-column-definitions</a>.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    preactions
                                                </td>
                                                <td>
                                                    json
                                                </td>
                                                <td>
                                                    Es el arreglo JSON, donde deberá declarar las acciones a ejecutar en
                                                    cada item.
                                                    Cada objeto de este array debe poseer las siguientes propiedades:
                                                    <ul>
                                                        <li>
                                                            <strong>
                                                                rapida:
                                                            </strong>
                                                            true o false, usese si nesesita que la acción se ejecute con una
                                                            pregunta
                                                            que anteceda dicha acción.
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                text:
                                                            </strong>
                                                            string, si la acción "rapida" esta activada esta será la
                                                            pregunta antecedente a
                                                            la acción, caso contrario, es el texto del boton.
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                icon:
                                                            </strong>
                                                            string, es el ícono del boton.
                                                            Para conocer qué iconos puede usar visite
                                                            <a
                                                                href="https://bootstrap-vue.org/docs/icons#icons-1">https://bootstrap-vue.org/docs/icons#icons-1</a>.
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                variant:
                                                            </strong>
                                                            string, es el color segun la guía de bootstrap que
                                                            tendrá el botón.
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                callback:
                                                            </strong>
                                                            function, es una funcion que siempre debe tener un parametro
                                                            que represente al item de la tabla, esta función es la que se
                                                            ejecutará
                                                            al presionar el botón de la accón.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    premultiactions
                                                </td>
                                                <td>
                                                    json
                                                </td>
                                                <td>
                                                    Es el arreglo JSON, donde deberá declarar las acciones a ejecutar sobre
                                                    los items seleccionados de la tabla.
                                                    Cada objeto de este array debe poseer las siguientes propiedades:
                                                    <ul>
                                                        <li>
                                                            <strong>
                                                                text:
                                                            </strong>
                                                            string, es el texto del boton.
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                icon:
                                                            </strong>
                                                            string, es el ícono del boton.
                                                            Para conocer qué iconos puede usar visite
                                                            <a
                                                                href="https://bootstrap-vue.org/docs/icons#icons-1">https://bootstrap-vue.org/docs/icons#icons-1</a>.
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                variant:
                                                            </strong>
                                                            string, es el color segun la guía de bootstrap que
                                                            tendrá el botón.
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                callback:
                                                            </strong>
                                                            function, es una funcion que siempre debe tener un parametro
                                                            que represente a un array de items, esta función es la que se
                                                            ejecutará
                                                            al presionar el botón de la accón masiva.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    prebuscadores
                                                </td>
                                                <td>
                                                    json
                                                </td>
                                                <td>
                                                    Es el arreglo JSON, donde deberá declarar los parámetros para construir
                                                    el buscador
                                                    de la tabla:
                                                    <ul>
                                                        <li>
                                                            <strong>
                                                                label:
                                                            </strong>
                                                            string, es el texto de la seccion de busqueda.
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                valor:
                                                            </strong>
                                                            string||json||number, es objeto que representa el valor
                                                            almacenado del campo de busqueda.
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                options:
                                                            </strong>
                                                            array json, es el arreglo de las opciones
                                                            para un select, si usa esta propiedad, el buscador incluirá
                                                            un select, la estructura de este arreglo la puede ver en
                                                            <a
                                                                href="https://bootstrap-vue.org/docs/components/form-select#form-select">https://bootstrap-vue.org/docs/components/form-select#form-select</a>.
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                type:
                                                            </strong>
                                                            string, usese en caso de input, define segun las definiciones de
                                                            tipo de input.
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                placeholder:
                                                            </strong>
                                                            string, es el placeholder del input del campo de busqueda.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <hr>

                                <h3>
                                    <strong>
                                        Componente {{ '<my-modal>' }}
                                    </strong>
                                </h3>
                                <p>
                                    <strong>
                                        Descripción:
                                    </strong>
                                    Es un modal de uso rápido.
                                </p>
                                <p>
                                    <strong>
                                        Slot:
                                    </strong>
                                    Es lo que va a visualizarce dentro del modal.
                                </p>
                                <p>
                                    <strong>
                                        Propiedades:
                                    </strong>
                                    A continuación una descripción de las propiedades que debe pasarle a este componente:
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Propiedad</th>
                                                <th>Tipo</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    cancelvariant
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Color bootstrap del boton cancelar.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    canceltitle
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Texto del boton cancelar.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    btnicon
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Ícono del boton que muestra el modal.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    btntxt
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Texto del boton que muestra el modal.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    btnvariant
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Color del boton que muestra el modal.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    btnsize
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Tamaño del boton que muestra el modal.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    title
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Título del modal.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    size
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Tamaño del modal.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    footer
                                                </td>
                                                <td>
                                                    boolean
                                                </td>
                                                <td>
                                                    Determina si es visible el footer del modal(indipensable si va ausar las
                                                    opciones de ok y cancelar).
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    oktitle
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Texto del boton OK
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    okvariant
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Color del boton OK
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    headvariant
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Color de la cabecera del modal
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    headvarianttext
                                                </td>
                                                <td>
                                                    string
                                                </td>
                                                <td>
                                                    Color de las letras de la cabecera del modal
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <hr>

                                <h3>
                                    <strong>
                                        Componentes {{ '<grafica-lineal> , <grafica-barras> , <grafica-donut>' }}
                                    </strong>
                                </h3>
                                <p>
                                    <strong>
                                        Descripción:
                                    </strong>
                                    Usados en la generación de datos estadísticos.
                                </p>
                                <p>
                                    <strong>
                                        Slot:
                                    </strong>
                                    Es lo que va a visualizarce dentro del modal.
                                </p>
                                <p>
                                    <strong>
                                        Propiedades:
                                    </strong>
                                    A continuación una descripción de las propiedades que debe pasarle a este componente,
                                    tome en cuenta que la forma de las propiedades para estos elementos son de la misma
                                    forma
                                    que describe la documentación oficial de chartJS para este tipo de datos especifico:
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Propiedad</th>
                                                <th>Tipo</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    prelabels
                                                </td>
                                                <td>
                                                    json
                                                </td>
                                                <td>
                                                    Objeto JSON de la forma
                                                    <strong>
                                                        labels
                                                    </strong>
                                                    descrita en la documentacion oficial de ChartJS, para los nombres
                                                    de las lineas de descripcion.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    predatasets
                                                </td>
                                                <td>
                                                    json
                                                </td>
                                                <td>
                                                    Objeto JSON de la forma
                                                    <strong>
                                                        datasets
                                                    </strong>
                                                    descrita en la documentacion oficial de ChartJS, para los valores
                                                    a representar.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </b-card-body>
                        </b-collapse>
                    </b-card>
            </b-card-body>
        </b-card>

    </div>
@stop

@section('css')

@stop

@section('js')

@stop
