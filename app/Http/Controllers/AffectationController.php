<?php

namespace App\Http\Controllers;

use App\Http\Resources\AffectationResource;
use App\Models\Affectation;
use Illuminate\Http\Request;

class AffectationController extends Controller
{
	public function index()
	{
		return AffectationResource::collection(Affectation::all());
	}

	public function store(Request $request)
	{
		$data = $request->validate([
			'user_id' => ['required', 'exists:users'],
			'lieu_affectation_id' => ['required', 'exists:lieu_affectations'],
		]);

		return new AffectationResource(Affectation::create($data));
	}

	public function show(Affectation $affectation)
	{
		return new AffectationResource($affectation);
	}

	public function update(Request $request, Affectation $affectation)
	{
		$data = $request->validate([
			'user_id' => ['required', 'exists:users'],
			'lieu_affectation_id' => ['required', 'exists:lieu_affectations'],
		]);

		$affectation->update($data);

		return new AffectationResource($affectation);
	}

	public function destroy(Affectation $affectation)
	{
		$affectation->delete();

		return response()->json();
	}
}
