**LARANGU** presents

# DIRECTIVE-NG

### The ultimate laravel's bundel for Angular 2 Directives. 

**Instalation**

Tn the `config/app.php` file in the providers array add:
 
     \Larangu\FormNg\DirectiveNgServiceProvider::class,
     
and if you want to use you can register `DirectiveNg` alias into the alias's array:

    'DirectiveNg' => \Larangu\FormNg\Facades\DirectiveNgFacade::class,