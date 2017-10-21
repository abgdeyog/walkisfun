<?php

namespace App\Route;

use Illuminate\Database\Eloquent\Model;

class PlaceDescription extends Model
{
    private $description;
    private $smallDescription;
    private $title;

    protected $fillable = ['description', 'smallDescription', 'title'];

    public function __construct(string & $description, string & $smallDescription, string & $title)
    {
        $this->description = $description;
        $this->smallDescription = $smallDescription;
        $this->title = $title;
    }

    public function setDescription(string& $description)
    {
        $this->description = $description;
    }

    public function setSmallDescription(string& $smallDescription)
    {
        $this->smallDescription = $smallDescription;
    }

    public function setTitle(string& $title)
    {
        $this->title = $title;
    }

    public function place()
    {
        return $this->belongsTo('App\Route\Place');
    }
}