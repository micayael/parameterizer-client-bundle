Parameterizer Client Bundle
===========================

Instalación del bundle
----------------------

### Instalación
~~~
    composer require micayael/parameterizer-client-bundle:^1.0.0
~~~

### Activación del bundle en el AppKernel.php

~~~
    $bundles = [
        ...
        new Micayael\Parameterizer\ClientBundle\ParameterizerClientBundle(),
        ...
    ];
~~~

### Configuración del guzzle para consultar el servicio del authenticator

~~~
parameterizer_client:
    host: http://localhost:8000
    username: user
    password: pass
    aplicacion_id: aplicacion
~~~

### Para utilizarlo dentro de los controllers

Luego de realizar un bin/console cache:clear se puede obtener 
los parámetros con el siguiente servicio 

~~~
    $this->get('parameterizer_client.cache')->get('parametros')
~~~
