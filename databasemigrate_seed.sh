#!/usr/bin/env bash
#migrate
php artisan migrate
#seed
php artisan db:seed --class=TypeDescription
php artisan db:seed --class=MachineList
php artisan db:seed --class=MachineCalander
php artisan db:seed --class=TeamMembersSeeder