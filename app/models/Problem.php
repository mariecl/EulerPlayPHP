<?php
class Problem extends Eloquent {
	protected $table = 'problemDescriptors';
	public $timestamps = false;
	public $primaryKey = "problemId";

	public function parameters()
    {
        return $this->hasMany('Parameter', 'linkedProblemId', 'problemId');
    }
}