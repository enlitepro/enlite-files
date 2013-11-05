<?php
return [
    'service_manager' => array(
        'factories' => array(
            'EnliteFilesManager' => 'EnliteFiles\FileManagerFactory',
            'EnliteFilesManagerOptions' => 'EnliteFiles\FileManagerOptionsFactory',
            'EnliteFilesProcessorManager' => 'EnliteFiles\Process\ProcessorManagerFactory',
            'EnliteFilesProcessorManagerOptions' => 'EnliteFiles\Process\ProcessorManagerOptionsFactory',
            'EnliteFilesCommonOptions' => 'EnliteFiles\CommonOptionsFactory',
            'EnliteFilesResponseBuilderManager' => 'EnliteFiles\ResponseBuilder\ResponseBuilderManagerFactory',

            // upload default forms
            'EnliteFilesAjaxUploadForm' => 'EnliteFiles\Form\AjaxUploadFormFactory',

            // default storage
            'EnliteFilesFileStorage' => 'EnliteFiles\Storage\FileStorageFactory',
            'EnliteFilesFileStorageOptions' => 'EnliteFiles\Storage\FileStorageOptionsFactory',
        ),

        'invokables' => array(
            // default accesses
            'EnliteFilesVoidAccess'   => 'EnliteFiles\Access\VoidAccess',

            // default strategies for hydrators
            'EnliteFilesHydratorStrategyFactoryFile' => 'EnliteFiles\Hydrator\Strategy\FactoryFile',
        )
    ),

    'controllers' => array(
        'invokables' => array(
            'EnliteFilesFile' => 'EnliteFiles\Controller\FileController',
        )
    ),

    'filter_manager' => [
        'invokables' => [
            'EnliteFilesMoveStorage' => 'EnliteFiles\Filter\File\MoveStorage'
        ]
    ],
];