Parameterizer Client Bundle
===========================

Instalación del bundle
----------------------

### Instalación
~~~
    composer require micayael/parameterizer-client-bundle:1.0.*
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
    host: http://localhost:8000 # host de la aplicación parameterizer
    username: user # usuario de acceso
    password: pass # clave de acceso
    agrupado: true # true|false (opcional, default: true)
~~~

La opción "agrupado" indica al servicio que retornar los parámetros agrupados por dominio o no

### Para utilizarlo dentro de los controllers

Luego de realizar un bin/console cache:clear se puede obtener 
los parámetros con el siguiente servicio 

~~~
    # Para obtener todos los parámetros de la aplicación como un array
    $this->get('parameterizer_client.cache')->getAll()

    # Para obtener todos los parámetros de un dominio específico como un array
    $this->get('parameterizer_client.cache')->get($dominio);

    # Para obtener un parámetro específico
    $this->get('parameterizer_client.cache')->get($dominio, $codigo);
~~~

### Para utilizarlo dentro de los twig

~~~
    # Para obtener todos los parámetros de la aplicación como un array
    {% dump(get_params()) %}

    # Para obtener todos los parámetros de un dominio específico como un array
    {% dump(get_params(dominio)) %}

    # Para obtener un parámetro específico
    {% dump(get_param(dominio, codigo)) %}
~~~

### Para utilizarlo dentro de los forms

Se pueden pasar los parámetros como options del formulario desde los controllers

~~~
$form = $this->createForm('AppBundle\Form\BuscadorType', null, ['parametros' => $this->get('parameterizer_client.cache')->getAll()]);
~~~

Se debe configurar el formulario para poder recibir esta nueva opción

~~~
public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setRequired('parametros');
}
~~~

Dentro del método buildForm se reciben las opciones como argumento

~~~
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('estado', ChoiceType::class, [
            'placeholder' => 'Seleccione una opción',
            'empty_data' => null,
            'choices' => array_flip($options['parametros'][$dominio]),
        ])
}
~~~
