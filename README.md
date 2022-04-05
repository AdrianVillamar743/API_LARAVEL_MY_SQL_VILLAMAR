# API_LARAVEL_MY_SQL_VILLAMAR
 Api Rest creada utilizando Laravel y MySQL
API REST - LARAVEL 8 Villamar

En  esta ocasión utilizaremos Laravel 8 para crear una api. Las herramientas a utilizarse serían en mi caso Xampp, Visual Studio y el navegador de tu preferencia.
1.- En este caso en nuestra aplicación de Xampp iremos a la ruta de C:\xampp\htdocs
2.- Escribiremos el comando 
     composer create-project laravel/laravel apivillamar

      Cabe destacar que apivillamar es el nombre que yo le puse.

3.- Probamos accediendo al proyecto por medio de la terminal.
4.- Una vez probado ello nos dirigiremos al archivo AppServiceProvider.php ubicado en la 
ruta de app\Providers\AppServiceProvider.php. Y luego colocamos 

use Illuminate\Support\Facades\Schema; 

Y modificamos la función boot con 

    public function boot()
    {
        Schema::defaultStringLength(255);
    }

5.- Ahora modificaremos el archivo .env ubicado en la siguiente ruta C:\xampp\htdocs\proyectos\apivillamar\.env

6.- Para la configuración crearemos una bd nueva llamada crud_villamar

7.- Ahora modificaremos el archivo .env para conectarnos a nuestra bd con el nombre de la db

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crud_villamar
DB_USERNAME=root
DB_PASSWORD=

8.- Una vez hecho ello procederemos a utilizar el comando php artisan migrate para subirlo a la base de datos.

9.- En laravel como tal no interactuaremos la base de datos ya creada, sino que crearemos versiones a partir del codigo de php es decir migraciones.
Los modelos van en singular
Crearemos un nuevo modelo a partir del comando 

php artisan make:model Tarea -m

Donde el parametro -m es para crear la migración al modelo también

10.- Luego de haber creado el modelo y la migracion pocederemos a modificarlo de acuerdo a las necesidades de la tabla que deseemos quedando la migracion en la funcion up de la siguiente manera

    public function up()
    {
    Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });    }

11.-Usando el paso  9 y 10 crearemos otra tabla llamada categoria

En dicho caso quedaría de la siguiente manera su función up

    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
    }

12.- Ahora debemos enlazarlas por medio de una clave foránea, por lo que crearemos una
nueva migración con el comando 

php artisan make:migration add_categoria_id_to_tarea_table --table=tareas

Donde el parametro table establece donde se crea el campo referenciado de la otra tabla.

Una vez creada la migración de la clave foránea modifcaremos su función up por esta

    public function up()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->bigInteger('id_categoria')->unsigned();
            $table
                    ->foreign('id_categoria')
                    ->references('id')
                    ->on('categorias')
                    ->after('nombre')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

13.- Dentro de los modelos protegeremos los datos con protected fillable en el caso de categoría 

 use HasFactory;
    protected $fillable = ['id','nombre'];

14.- En el caso de Tarea

    use HasFactory;
    protected $fillable = ['id','nombre','id_categoria'];

15.- Crearemos los controladores para categoria y tarea con los comandos

php artisan make:controller CategoriasController  --resource

php artisan make:controller TareasController  --resource


16.- Colocamos las rutas nuevas no en el archivo routes.php sino en el archivo api.php

Route::get('/tareas','App\Http\Controllers\TareasController@index');
Route::post('/tareas','App\Http\Controllers\TareasController@store');
Route::put('/tareas','App\Http\Controllers\TareasController@update');
Route::delete('/tareas','App\Http\Controllers\TareasController@destroy');

Route::get('/categoria','App\Http\Controllers\CategoriasController@index');
Route::post('/categoria','App\Http\Controllers\CategoriasController@store');
Route::put('/categoria','App\Http\Controllers\CategoriasController@update');
Route::delete('/categoria','App\Http\Controllers\CategoriasController@destroy');

17.- Los metodos se encuentran en los archivos

18.- Probamos con el solicitor favorito.
Ejemplo 
http://localhost:8000/api/tareas/
con metodo get
