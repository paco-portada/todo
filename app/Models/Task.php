<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Task extends Model
{
    use HasFactory;
    use AsSource, Filterable, Attachable;
    
    protected $fillable = ['description'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
