<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;
use App\Http\Controllers\IsAdmin;

class Product extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = [
        'article',
        'name',
        'status',
        'data'
    ];

    public static function rules(): array
    {
        return [
            'name' => ['required', 'min:10'],
            'article' => ['required',  'unique:products,article', 'regex:/(^[A-Za-z0-9]+$)/i']
        ];
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }
}
