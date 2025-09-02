<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'name',
        'email',
        'subject',
        'message',
    ];

    /**
     * Get the user that owns the contact message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
