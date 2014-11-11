<?php

class ProblemsController extends Controller {
	
	protected function addProblem () {
		
		// Deals with data
		// Fetch the Request instance
		$request = Request::instance();
		// Get the content from the Request instance
		$content = $request->getContent();
		Log::info("Content: ".$content);
		parse_str($content, $data);
		Log::info($data);

		// Generate a new problem entry
		$newProblem = new Problem;
		// Populate fields of problem entry with data submitted by the user
		$newProblem->problemName = $data["problemName"];
		$newProblem->problemQuestion = $data["problemQuestion"];
		$newProblem->save();

		// Loop to generate all necessary parameters for the new problem
		// Each request holds 2 fields for the problem info, and 3 fields for each submitted parameter
        $parametersNb = (count($data) - 2) / 3;
        // Loops over each submitted set of parameters
        for ($i = 1; $i < $parametersNb + 1; $i++) {
			// Generate a new Parameter
			$newParameter = new Parameter;
			// Populate new parameter with data submitted by the user
			$newParameter->parameterName = $data["parameterName_".$i];
			$newParameter->parameterProperName = $data["parameterProperName_".$i];
			$newParameter->parameterDefaultValue = $data["parameterDefaultValue_".$i];
			// Retrieves id of the new problem to pass it to the parameter as "LinkedProblemId"
			$newParameter->problem()->associate($newProblem);
			$newParameter->save();
		};

		// Prepares response
		$result = json_encode("Problem successfully added to the database.");
		$response = Response::make($result, 200);
		$response->header('Content-Type', 'application/javascript');
		Log::info($response."\n");

		return $response;
	}

	protected function deleteProblem () {
		// Deals with data
		// Fetch the Request instance
		$request = Request::instance();
		// Get the content from the Request instance
		$content = $request->getContent();
		Log::info("Content: ".$content);
		parse_str($content, $data);
		Log::info($data);

		$nbProblemsToDelete = count($data);

		foreach ($data as $key => $value){
			Problem::destroy($key);
		}

		// Prepares response
        $text;
        // Displays a different text depending on the number of problems the user wants to delete
        if ($nbProblemsToDelete === 0) {
            $text = "No problem were removed because you didn't select any.";
        } else if ($nbProblemsToDelete === 1) {
            $text = "Problem successfully removed from database.";
        } else {
            $text = "Problems successfully removed from database.";
        }

		$result = json_encode($text);
		$response = Response::make($result, 200);
		$response->header('Content-Type', 'application/javascript');
		Log::info($response."\n");

		return $response;
	}
}