<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentEvaluation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_id',
        'evaluation_date',
        'primary_function',
        'market_id',
        'skillset',
        'teamleader_id',
        'observation_type_id',
        'customer_query',
        'agent_response',
        'classification_id',
        'query_category_id',
        'created_by',
        'updated_by'
    ];
}
