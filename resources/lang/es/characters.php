<?php

return [
    'create'        => [
        'success'   => 'Se ha creado el personaje \':name\'.',
        'title'     => 'Crear nuevo personaje',
    ],
    'destroy'       => [
        'success'   => 'Personaje \':name\' borrado.',
    ],
    'edit'          => [
        'success'   => 'Personaje \':name\' actualizado.',
        'title'     => 'Editar el Personaje :name',
    ],
    'fields'        => [
        'age'                       => 'Años',
        'eye'                       => 'Color de ojos',
        'family'                    => 'Familia',
        'fears'                     => 'Miedos',
        'free'                      => 'Observaciones',
        'goals'                     => 'Objetivos',
        'hair'                      => 'Pelo',
        'height'                    => 'Altura',
        'history'                   => 'Biografía',
        'image'                     => 'Imagen',
        'is_personality_visible'    => 'Personalidad visible',
        'languages'                 => 'Idiomas',
        'location'                  => 'Procedencia',
        'mannerisms'                => 'Manias',
        'name'                      => 'Nombre',
        'physical'                  => 'Físico',
        'race'                      => 'Raza',
        'relation'                  => 'Vinculos',
        'sex'                       => 'Sexo',
        'skin'                      => 'Piel',
        'title'                     => 'Titulo',
        'traits'                    => 'Personalidad',
        'weight'                    => 'Peso',
    ],
    'hints'         => [
        'is_personality_visible'    => 'Puedes ocultar a los Invitados la sección de personalidad.',
    ],
    'index'         => [
        'actions'       => [
            'random'    => 'Nuevo personaje aleatorio',
        ],
        'add'           => 'Nuevo Personaje',
        'description'   => 'Modificar los personajes en :name.',
        'header'        => 'Personajes en :name',
        'title'         => 'Personajes',
    ],
    'organisations' => [
        'actions'       => [
            'add'   => 'Añadir organización',
        ],
        'create'        => [
            'description'   => 'Asociar una organización a un personaje',
            'success'       => 'Personaje añadido a la organización.',
            'title'         => 'Nueva Organizacion para :name',
        ],
        'destroy'       => [
            'success'   => 'Personaje borrado de la organización.',
        ],
        'edit'          => [
            'success'   => 'Personaje de la organización modificado.',
            'title'     => 'Actualizar Organización para :name',
        ],
        'fields'        => [
            'organisation'  => 'Organización',
            'role'          => 'Rol',
        ],
        'placeholders'  => [
            'organisation'  => 'Elegir una organización',
        ],
    ],
    'placeholders'  => [
        'age'       => 'Años',
        'eye'       => 'Color de ojos',
        'family'    => 'Por favor selecciona un personaje',
        'fears'     => 'Miedos',
        'free'      => 'Observaciones',
        'goals'     => 'Objetivos',
        'hair'      => 'Pelo',
        'height'    => 'Altura',
        'history'   => 'Biografía',
        'image'     => 'Imagen',
        'languages' => 'Idiomas',
        'location'  => 'Selecciona una procedencia',
        'mannerisms'=> 'Manias',
        'name'      => 'Nombre',
        'physical'  => 'Físico',
        'race'      => 'Raza',
        'sex'       => 'Sexo',
        'skin'      => 'Piel',
        'title'     => 'Titulo',
        'traits'    => 'Personalidad',
        'weight'    => 'Peso',
    ],
    'sections'      => [
        'appearance'    => 'Apariencia',
        'general'       => 'Información General',
        'history'       => 'Briografía',
        'personality'   => 'Personalidad',
    ],
    'show'          => [
        'description'   => 'Vista detallada del personaje',
        'tabs'          => [
            'attributes'    => 'Atributos',
            'free'          => 'Observaciones',
            'history'       => 'Biografía',
            'organisations' => 'Organizaciones',
            'personality'   => 'Personalidad',
            'relations'     => 'Vinculos',
        ],
        'title'         => 'Personaje :name',
    ],
];
