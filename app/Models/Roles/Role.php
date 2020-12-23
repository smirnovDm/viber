<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Role extends Model
{
    use HasFactory;
    use Sushi;

    public $timestamps   = false;
    public $incrementing = false;
    protected $keyType   = 'string';

    public const ADMIN    = 'admin';
    public const PM       = 'pm';
    public const SV       = 'supervisor';
    public const OPERATOR = 'operator';

    /**
     * @var array
     */
    protected $rows = [
        ['id' => self::ADMIN,    'name' => 'админ'],
        ['id' => self::OPERATOR, 'name' => 'оператор'],
    ];
}
