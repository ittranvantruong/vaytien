<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loanperiod extends Model
{
    use HasFactory;
    protected $table = 'loan_period';

    protected $fillable = ['name', 'interest_rate', 'sort'];
}
