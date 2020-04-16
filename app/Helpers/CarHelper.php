<?php


namespace App\Helpers;


use App\Car;

class CarHelper
{
    /**
     * Static function to associate already added cars to a new user
     * if he has added cars with his email in the basket before.
     * @param int $id
     * @param string $email
     */
    public static function associateCarsToUser(int $id, string $email)
    {
        $cars = Car::where('user_email',$email)->get();

        if (!empty($cars)) {
            foreach ($cars as $car) {
                Car::find($car->id)->update(['user_id' => $id]);
            }
        }
    }
}
