<?php


arch('php preset')
    ->preset()
    ->php();

arch('security preset')
    ->preset()
    ->security();

arch('app controllers')
    ->expect('App\Http\Controllers')
    ->toHaveSuffix('Controller');

arch('app models')
    ->expect('App\Models')
    ->toBeClasses()
    ->toExtend('App\Models\BaseModel')
    ->ignoring([
        'App\Models\Permission',
        'App\Models\Role', 
        'App\Models\User'
    ]);

