<?php

namespace App\Http\Controllers;

use App\Car;
use App\Cars\CarsRepository;
use App\Tag;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function show()
    {
        return view('add_car');
    }

    public function create(Request $request)
    {
        $input = $request->input();
        $car = new Car;

        $car->make = $input['make'];
        $car->model = $input['model'];
        $car->year = $input['year'];
        $car->registration = $input['registration'];
        $car->engine = $input['engine'];
        $car->price = $input['price'];

        if(Auth::user()) {
            $user = Auth::user();
            $car->user_id = $user->id;
            $car->user_email = $user->email;
        } else {
            $user = User::where('email',$input['email'])->first();

            if ($user) {
                $car->user_id = $user->id;
                $car->user_email = $input['email'];
            } else {
                $car->user_id = 0;
                $car->user_email = $input['email'];
            }
        }

        if ($car->save()) {
            $tags = array_map('trim',explode(",",$input['tags']));

            if (count($tags) > 1) {
                foreach ($tags as $tag) {
                    $dbTag = Tag::where('slug', $tag)->first();

                    if (!empty($dbTag)) {
                        DB::table('car_tag')->insert([
                            'car_id' => $car->id,
                            'tag_id' => $dbTag->id
                        ]);
                    } else {
                        $success = Tag::create([
                            'slug' => $tag
                        ]);

                        if ($success) {
                            $addedTag = Tag::where('slug', $tag)->first();

                            DB::table('car_tag')->insert([
                                'car_id' => $car->id,
                                'tag_id' => $addedTag->id
                            ]);
                        }
                    }
                }
            }
            session()->flash('add-success','Success! Please wait for the moderators to review your submission.');
        }

        return redirect(url('/'));
    }

    public function draft()
    {
        $cars = Car::all();

        return view('draft')->with('cars', $cars);
    }

    public function getTags()
    {
        $tags = Tag::all()->pluck('slug')->toArray();

        return $tags;
    }

    public function getCars($name)
    {
        $tag = Tag::where('slug',$name)->first();

        return view('tags')->with(compact('name','tag'));
    }

    public function update($id)
    {
        $car = Car::find($id);

        if ($car->visible == 0) {
            $car->update(['visible' => '1']);
        } else {
            $car->update(['visible' => '0']);
        }

        return redirect(url('/draft'));
    }

    public function delete($id)
    {
        $car = Car::find($id);

        if (!empty($car)) {
            $car->delete();
        }

        return redirect(url('/draft'));
    }

    public function search(CarsRepository $repository)
    {
        $carTags = [];
        $cars = $repository->search((string) request('q'));

        foreach ($cars as $car) {
            $carTags[] = [
                'car' => $car,
                'tags' => $car->tags()->get()
            ];
        }

        return view('home')->with(compact('cars','carTags'));
    }
}
