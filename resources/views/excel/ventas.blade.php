<table>
    <thead>
        <tr>

        </tr>
        <thead>
        <tbody>
            <tr>
                <th colspan="13" style="text-align: center;font-size:18px;font-weight:600;text-transform: uppercase;">
                    Ventas
                </th>
            </tr>
    <tbody>

</table>

<table style="">
    <thead>
        <tr>
            <th style="background: blue; color: white;">
                N. documento
            </th>
            <th style="background: blue; color: white;">
                Tipo de documento
            </th>
            <th style="background: blue; color: white;">
                Razón Social
            </th>

            <th style="background: blue; color: white;">
                Nombre comercial
            </th>
            <th style="background: blue; color: white;">
                RUC
            </th>
            <th style="background: blue; color: white;">
                Clave de acceso
            </th>
            <th style="background: blue; color: white;">
                Dirección matriz
            </th>
            <th style="background: blue; color: white;">
                Subtotal sin impuestos
            </th>
            <th style="background: blue; color: white;">
                Subtotal 0%
            </th>
            <th style="background: blue; color: white;">
                Subtotal IVA
            </th>
            <th style="background: blue; color: white;">
                Descuento
            </th>
            <th style="background: blue; color: white;">
                Propina
            </th>
            <th style="background: blue; color: white;">
                Total
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($filas as $f)
            <tr>
                <td>
                    {{ $f->numeroDocumento }}
                </td>
                <td>
                    @if ($f->codDoc == "01") 
                        FACTURA
                    @elseif ($f->codDoc == "03")
                        LIQUIDACIÓNE COMPRA DE BIENES Y PRESTACIÓN DE SERVICIOS
                    @elseif ($f->codDoc == "04")
                        NOTAE CRÉDITO
                    @elseif ($f->codDoc == "05")
                        NOTAE DÉBITO
                    @elseif ($f->codDoc == "06")
                        GUÍAE REMISIÓN
                    @elseif ($f->codDoc == "07")
                        COMPROBANTE RETENCIÓN
                    @elseif ($f->codDoc == "02")
                        NOTA DE VENTA
                    @elseif ($f->codDoc == "00")
                        PROFORMA
                    @endif
                </td>
                <td>
                    @if ($f->ambiente == 2)
                        PRODUCCIÓN
                    @else
                        PRUEBAS
                    @endif
                    
                </td>
                <td>
                    {{ $f->razonSocial }}
                </td>
                <td>
                    {{ $f->nombreComercial }}
                </td>
                <td>
                    {{ $f->ruc }}
                </td>
                <td>
                    {{ $f->dirMatriz }}
                </td>
                <td>
                    {{ $f->subtotal_sin_impuestos }}
                </td>
                <td>
                    {{ $f->subtotal_cero }}
                </td>
                <td>
                    {{ $f->subtotal_iva }}
                </td>
                <td>
                    {{ $f->descuento }}
                </td>
                <td>
                    {{ $f->propina }}
                </td>
                <td>
                    {{ $f->total }}
                </td>
            </tr>
        @endforeach




    </tbody>
</table>
