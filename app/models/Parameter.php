<?php
class Parameter extends Eloquent {
	protected $table = 'problemParameters';
	public $timestamps = false;

	public function problem()
    {
        return $this->belongsTo('Problem', 'linkedProblemId');
    }
}