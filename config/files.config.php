<?php

namespace EnliteFiles;

return [
    'enlite_files' => [
        'response_builders' => [
            'factories' => [
                'view' => function() {
                        $builder = new ResponseBuilder\Http1v1CacheResponseBuilder();
                        $builder->setView(true);
                        return $builder;
                    },
                'viewPrivate' => function() {
                        $builder = new ResponseBuilder\Http1v1CacheResponseBuilder();
                        $builder->setView(true);
                        $builder->setTypeCache('private');
                        return $builder;
                    },
                'download' => function() {
                        $builder = new ResponseBuilder\Http1v1CacheResponseBuilder();
                        return $builder;
                    },
                'downloadNoStore' => function() {
                        $builder = new ResponseBuilder\Http1v1CacheResponseBuilder();
                        $builder->setEnableCache(false);
                        return $builder;
                    },
            ]
        ]
    ]
];