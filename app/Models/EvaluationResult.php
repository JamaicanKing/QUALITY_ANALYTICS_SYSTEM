<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'agent_evaluation_id',
        'attribute_id',
        'rating_id',
        'reason_id',
        'query_category_id',
        'comments',
        'score',
        'created_by',
        'updated_by',

    ];
}
