<?php

namespace App\Http\Controllers\API;

use App\Events\PersonRegistered;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = People::orderBy('name')
            ->get()
            ->toArray();

        return $people;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $person = new People([
            'name' => $request->name,
            'surname' => $request->surname,
            'mobile_number' => $request->mobile_number,
            'sa_id' => $request->sa_id,
            'email' => $request->email,
            'birthdate' => $request->birthyear.'-'.$request->birthmonth.'-'.$request->birthday,
            'language' => $request->language
        ]);
        $person->save();
        $person->interests()->attach($request->interests);

            PersonRegistered::dispatch($person->id);

        return response()->json('Person added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = People::find($id)->toArray();

        $person['interests'] = Arr::pluck( People::find($id)->interests()->get(['id'])->toArray(),'id');

        return response()->json($person);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $person=People::find($id);
        $person->update($request->all());
        $person->interests()->sync($request->interests);

        return response()->json('Person updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person=People::find($id);
        $person->delete();

        return response()->json('Person data deleted!');       //
    }
}
