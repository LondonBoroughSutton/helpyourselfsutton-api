<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\File;
use App\Models\Page;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'content' => json_encode(['introduction' => ['copy' => $this->faker->realText()]]),
        'enabled' => Page::ENABLED,
        'page_type' => Page::PAGE_TYPE_INFORMATION,
    ];
});

$factory->state(Page::class, 'withImage', [
    'image_file_id' => function () {
        return factory(File::class)->create([
            'filename' => Str::random() . '.png',
            'mime_type' => 'image/png',
        ]);
    },
]);

$factory->state(Page::class, 'disabled', [
    'enabled' => Page::DISABLED,
]);

$factory->state(Page::class, 'landingPage', [
    'page_type' => Page::PAGE_TYPE_LANDING,
]);

$factory->afterCreatingState(Page::class, 'withParent', function (Page $page, Faker $faker) {
    factory(Page::class)->create()->appendNode($page);
});

$factory->afterCreatingState(Page::class, 'withChildren', function (Page $page, Faker $faker) {
    factory(Page::class, 3)->create()->each(function (Page $child) use ($page) {
        $page->appendNode($child);
    });
});
