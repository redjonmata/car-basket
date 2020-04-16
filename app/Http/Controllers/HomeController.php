<?php

namespace App\Http\Controllers;

use App\Car;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $carTags = [];

        $cars = Car::where('visible',1)->get();

        foreach ($cars as $car) {
            $carTags[] = [
                'car' => $car,
                'tags' => $car->tags()->get()
            ];
        }

        return view('home')->with(compact('cars','carTags'));
    }

    public function showCars()
    {
        $user = Auth::user();
        $cars = $user->cars()->get();
        $ids = implode(',', $user->cars()->pluck('id')->toArray());

        return view('cars')->with(compact('ids','cars'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->input();
        $car = Car::find($id);

        if (empty($car)) {
            abort('404');
        }

        $car->update([
            'make' => $input['hidden_make-'.$id],
            'model' => $input['hidden_model-'.$id],
            'year' => $input['hidden_year-'.$id],
            'registration' => $input['hidden_registration-'.$id],
            'engine' => $input['hidden_engine-'.$id],
            'price' => $input['hidden_price-'.$id],
        ]);

        return redirect('/my-cars');
    }

    public function delete($id)
    {
        $car = Car::find($id);

        if (!empty($car)) {
            $car->delete();
        }

        return redirect(url('/my-cars'));
    }
}
