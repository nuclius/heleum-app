<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    /**
     * Eloquent doesn't support compound primary keys, and per a contributor to
     * the package, [it never will](githubissue).  So, for now, since our
     * application is only ever doing *reads* for Rates, I think we're good to
     * go.
     *
     * !!!! But we will NEVER be able to do a save(). !!!!
     *
     * (githubissue): https://github.com/laravel/framework/issues/5517#issuecomment-170035596
     *
     * @var string
     */
    protected $primaryKey = 'N/A';

    public $timestamps = false;
}
