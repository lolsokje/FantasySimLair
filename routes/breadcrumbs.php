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

Breadcrumbs::for('admin.channels.create', function (Trail $trail) {
    $trail->parent('admin.channels')->push('Add channel', route('admin.channels.create'));
});

Breadcrumbs::for('admin.championships', function (Trail $trail) {
    $trail->parent('index')->push('Championships', route('admin.championships'));
});

Breadcrumbs::for('admin.championships.create', function (Trail $trail) {
    $trail->parent('admin.championships')->push('Add championship', route('admin.championships.create'));
});

Breadcrumbs::for('championships.index', function (Trail $trail) {
    $trail->parent('index')->push('My championships', route('championships.index'));
});

// @todo fix these breadcrumbs to include correct variables
Breadcrumbs::for('championships.show', function (Trail $trail) {
    $trail->parent('championships.index')->push('Championship seasons', route('championships.show', ['championship' => 'a']));
});

Breadcrumbs::for('seasons.create', function (Trail $trail) {
    $trail->parent('championships.show')->push('Add season', route('seasons.create', ['championship' => '1']));
});