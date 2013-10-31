<?php
return [
    'service_manager' => array(
        'factories' => array(
            'EnliteFilesManager' => 'EnliteFiles\FileManagerFactory',
            'EnliteFilesManagerOptions' => 'EnliteFiles\FileManagerOptionsFactory',
            'EnliteFilesProcessorManager' => 'EnliteFiles\Process\ProcessorManagerFactory',
            'EnliteFilesProcessorManagerOptions' => 'EnliteFiles\Process\ProcessorManagerOptionsFactory',
            'EnliteFilesDefaultUploadForm' => 'EnliteFiles\Form\DefaultUploadFormFactory',
            'EnliteFilesCommonOptions' => 'EnliteFiles\CommonOptionsFactory',
            'EnliteFilesResponseBuilderManager' => 'EnliteFiles\ResponseBuilder\ResponseBuilderManagerFactory',
        ),

        'invokables' => array(
            'EnliteFilesVoidAccess'   => 'EnliteFiles\Access\VoidAccess',
        )
    ),

    'controllers' => array(
        'invokables' => array(
            'EnliteFilesFile' => 'EnliteFiles\Controller\FileController',
        )
    ),
];