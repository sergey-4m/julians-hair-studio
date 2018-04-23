<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        factory(App\Stylist::class, 50)->create();
        //factory(App\Client::class, 50)->create();
        foreach (App\Stylist::all() as $stylist) {
            //foreach (App\Client::all() as $client) {
            factory(App\Client::class, 50)->create()->each(function($client) use($faker, $stylist) {
                $service = new Service;
                $service->date_at = $faker->dateTimeBetween('+0 days', '+1 month');
                $service->brand = $faker->randomElement([
                    'Wella',
                    'Affinage',
                    'Graphics',
                ]);
                $service->bleach = $faker->numberBetween(1, 20).'/'.$faker->randomDigitNotNull.' Bit of bleach '.$faker->randomDigitNotNull.'%';
                $service->tint = $faker->numberBetween(1, 20).'g / '.$faker->numberBetween(1, 20).'ox '.
                    $faker->numberBetween(1, 40).'g/'.$faker->randomFloat.' '.
                    $faker->numberBetween(1, 40).'g/'.$faker->randomFloat;
                $service->peroxide_volume = $faker->numberBetween(1, 40).'g '.$faker->numberBetween(1, 10).'%';
                $service->service = $faker->randomElement([
                    'Full Head & Foils',
                    '1/2 Head Foils',
                    'Tint',
                    'Roots Only',
                    'T-Section',
                    'Perm',
                ]);
                $service->perm = $faker->sentence(5);
                $service->charge = $faker->randomFloat(2, 10, 1000);
                $service->client_id = $client->id;
                $service->stylist_id = $stylist->id;
                $service->save();
                /*$stylist->services()->save($service);
                $stylist->save();
                $client->services()->save($service);
                $client->save();*/
            });
        };
    }
}
