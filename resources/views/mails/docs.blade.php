<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        p,
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Helvetica';
            font-weight: 400;
            margin-bottom: 5px !important;
            margin-top: 5px !important;
            line-height: 1 !important;
        }

        .logo {
            max-height: 90px;

        }
    </style>
</head>

<body>
    <div style="border:solid 1px rgb(206, 206, 206);border-radius:10px; max-width: 520px;padding: 30px;">

        <div style="text-align: center;">
            @if ($logoEmpresa)
                <img class="logo" src="{{ $message->embed(public_path('files/img/' . $logoEmpresa)) }}" />
            @endif
        </div>

        <h2>
            Factura por la compra en: {{ $empresa->nombreComercial }}

        </h2>
        <br>

        <h4>

            @if (isset($proveddor))
                <strong>Proveedor:</strong>
                {{ $proveddor->razonsocial }}
            @elseif (isset($cliente) and $cliente)
                <strong>Cliente:</strong>
                {{ $cliente->razonsocial }}
            @else
                <strong>Cliente:</strong>
                Consumidor Final
            @endif

        </h4>
        {{-- <h4> <strong>Fecha:</strong>
            {{ $documento->fecha_emision }}
        </h4> --}}
        <br>
        <p>Más detalles en los archivos adjuntos </p>
        <br>
        <p> <small>Este mensaje fue enviado de forma automática, no responda este mensaje</small> </p>
    </div>

</body>

</html>
