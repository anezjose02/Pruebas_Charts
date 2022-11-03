<template>
 
    
    <div class="title-ventas">
      <div class="content-title-ventas">
        <div class="row m-auto" style="width: 100%">
          <div class="col-sm-6 p-0">
            <h1 class="m-0">
              {{ title }}
            </h1>
          </div>
          <div class="col-sm-6 p-0">
            <b-breadcrumb class="float-right m-0 ml-">
              <b-breadcrumb-item href="/"> Inicio </b-breadcrumb-item>
              <b-breadcrumb-item active>{{ title }} </b-breadcrumb-item>
            </b-breadcrumb>
            <div class="dropdown float-right ml-1">
              <button
                class="btn btn-sm btn-success dropdown-toggle"
                type="button"
                id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fas fa-plus"></i> Nueva
              </button>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="dropdownMenuButton"
              >
                <a class="dropdown-item" href="/facturar">
                  <i class="fas fa-file-invoice"></i> Factura de venta</a
                >
                <a class="dropdown-item" href="/proforma">
                  <i class="text-info fas fa-file"></i>
                  Proforma </a
                >
                
                <a class="dropdown-item" href="/nota-credito">
                  <i class="text-success fas fa-file-invoice-dollar"></i>
                  Nota de crédito</a
                >
                 <a class="dropdown-item" href="/retencion">
                  <i class="text-secondary far fa-file-alt"></i>
                  
                 Retención</a
                >
              </div>
            </div>

            <slot></slot>
          </div>
        </div>
      </div>
    </div>
 
</template>

<script>
export default {
  props: ["title"],
};
</script>
