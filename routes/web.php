<?php

\Illuminate\Support\Facades\Route::view("tenant/404", "siga::errors.tenant-404")->middleware(['not-tenant'])->name('tenant.404');
