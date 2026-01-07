<?php

namespace App\Models;

class MenuItem extends BaseModel
{
    protected $fillable = [
        'label',
        'url', // or route name
        'parent_id',
        'order',
        'is_active',
        'target', // _self, _blank
    ];

    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }
}
