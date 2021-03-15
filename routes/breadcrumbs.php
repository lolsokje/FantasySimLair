<?php

use Tabuna\Breadcrumbs\Breadcrumbs;
use Tabuna\Breadcrumbs\Trail;

Breadcrumbs::for('index', function (Trail $trail) {
    $trail->push('Index', route('index'));
});

Breadcrumbs::for('admin.users', function (Trail $trail) {
    $trail->parent('index')->push('Users', route('admin.users'));
});

Breadcrumbs::for('admin.users.create', function (Trail $trail) {
    $trail->parent('admin.users')->push('Add user', route('admin.users.create'));
});

Breadcrumbs::for('admin.channels', function (Trail $trail) {
    $trail->parent('index')->push('Channels', route('admin.channels'));
});

Breadcrumbs::for('admin.championships', function (Trail $trail) {
    $trail->parent('index')->push('Championships', route('admin.championships'));
});