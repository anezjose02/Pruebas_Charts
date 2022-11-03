<?php

use App\Globales;
use App\Http\Controllers\Contantes;
use App\Models\Inventario\Precio;
use App\Models\Inventario\Unidades;
use App\Models\Super\Planes;
use App\Models\Super\Sistema;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $modulos = '';
        $premodulos = Contantes::modulos();
        $posmodulos = [];

        foreach ($premodulos as $prm) {
            # code...
            array_push($posmodulos,$prm['value']);
        }
        $modulos = json_encode($posmodulos);
        

        // $this->call(UserSeeder::class);
        $u = new User([
            'name'      => 'SuperAdmin',
            'email'     => 'cruzespejose@gmail.com',
            'password'  => bcrypt("cruzespejose"),
            'superuser' => 1,
            'modulos'   => $modulos,
        ]);
        $u->save();
        
        
        
        $u2 = new User([
            'name'      => 'Usuario de prueba',
            'email'     => 'test@test.com',
            'password'  => bcrypt("test@test.com"),
            'modulos'   => $modulos,
            'configuracion_sistema' => Contantes::configuracionSistema(),
        ]);
        $u2->save();
        $u2->admin_id = $u2->id;
        $u2->save();

        $p = new Planes([
            'nombre'    => 'Completo',
            'licencia'  => 'PERMANENTE',
            'modulos'   => $modulos,
            'limite_facturas'=> 1000000,
            'max_empresas'=> 1000000,
            'max_sucursales'=> 1000000,
            'max_usuarios'=> 1000000,
            'max_puntos'=> 1000000,
            'max_cajas'=> 1000000,
        ]);
        $p->save();

        $s = new Sistema();
        $s->fill(json_decode(json_encode($p),true));
        $s->plan = $p->nombre;
        $s->nombre = 'TEST';
        $s->user_id = $u2->id;
        $s->name = $u2->name;
        $s->email = $u2->email;
        $s->password = $u2->password;
        $s->save();

        $u2->sistema = $s->nombre;
        $u2->save();

        $u->admin_id = $u2->id;
        $u->sistema = $s->nombre;
        $u->save();

        ///UNIDADES DEFECTO
        $preunidades = Contantes::unidades();

        foreach ($preunidades as $pru) {
            # code...
            $unidad = new Unidades(json_decode(json_encode($pru),true));

            $unidad->user_id = $u2->id;
    
            $unidad->save();
        }

        ///PRECIOS
        $preprecios = Contantes::precios();

        foreach ($preprecios as $pru) {
            # code...
            $prc = new Precio(json_decode(json_encode($pru),true));

            $prc->user_id = $u2->id;
    
            $prc->save();
        }

        Globales::create([
            'slug'  =>'texto_logo',
            'valor' =>'Factusis',
            'nombre'=>'Texto de logo',
        ]);

        Globales::create([
            'slug'  =>'url_logo',
            'valor' =>'vendor/adminlte/dist/img/AdminLTELogo.png',
            'nombre'=>'Logo',
        ]);

        Globales::create([
            'slug'  =>'nombre_sistema',
            'valor' =>'Factusis',
            'nombre'=>'Nombre del sistema',
        ]);
    }
}
