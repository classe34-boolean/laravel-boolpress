<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [ "PHP", "Laravel", "HTML", "CSS", "JavaScript", "Vue.js" ];

        foreach ($tags as $tag) {
            // 1. creazione istanza
            $newTag = new Tag();
            // 2. valorizzazione proprietà
            $newTag->name = $tag;
            $newTag->slug = Str::slug($tag, '-');
            // 3. salvataggio a db
            $newTag->save();
        }
    }
}
