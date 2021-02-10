<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Books;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Books::factory()
            ->create([
                'genres_id' => 1,
                'title' => 'Pride and Prejudice',
                'image' => asset('storage/pride_prejudice.jpg'),
                'description' => 'Pride and Prejudice follows the turbulent relationship between Elizabeth Bennet, the daughter of a country gentleman, and Fitzwilliam Darcy, a rich aristocratic landowner. They must overcome the titular sins of pride and prejudice in order to fall in love and marry.',
                'isbn' => '9780141439518',
                'order' => 1,
                'author' => 'Jane Austen'
            ]);
        
        Books::factory()
            ->create([
                'genres_id' => 1,
                'title' => 'The Great Gatsby',
                'image' => asset('storage/great_gatsby.jpg'),
                'description' => 'The Great Gatsby, F. Scott Fitzgerald’s third book, stands as the supreme achievement of his career. First published in 1925, this quintessential novel of the Jazz Age has been acclaimed by generations of readers. The story of the mysteriously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan, of lavish parties on Long Island at a time when The New York Times noted “gin was the national drink and sex the national obsession,” it is an exquisitely crafted tale of America in the 1920s.',
                'isbn' => '9780743273565',
                'order' => 2,
                'author' => 'F. Scott Fitzgerald'
            ]);

        Books::factory()
            ->create([
                'genres_id' => 1,
                'title' => 'Wuthering Heights',
                'image' => asset('storage/wuthering_heights.jpg'),
                'description' => "Emily Brontë's only novel endures as a work of tremendous and far-reaching influence. The Penguin Classics edition is the definitive version of the text, edited with an introduction by Pauline Nestor. Lockwood, the new tenant of Thrushcross Grange, situated on the bleak Yorkshire moors, is forced to seek shelter one night at Wuthering Heights, the home of his landlord. There he discovers the history of the tempestuous events that took place years before. What unfolds is the tale of the intense love between the gypsy foundling Heathcliff and Catherine Earnshaw. Catherine, forced to choose between passionate, tortured Heathcliff and gentle, well-bred Edgar Linton, surrendered to the expectations of her class. As Heathcliff's bitterness and vengeance at his betrayal is visited upon the next generation, their innocent heirs must struggle to escape the legacy of the past. In this edition, a new preface by Lucasta Miller, author of The Brontë Myth, looks at the ways in which the novel has been interpreted, from Charlotte Brontë onwards. This complements Pauline Nestor's introduction, which discusses changing critical receptions of the novel, as well as Emily Brontë's influences and background.",
                'isbn' => '9780141439556',
                'order' => 3,
                'author' => 'Emily Brontë'
            ]);

        Books::factory()
            ->create([
                'genres_id' => 1,
                'title' => 'Moby Dick',
                'image' => asset('storage/moby_dick.jpg'),
                'description' => 'American writer Herman Melville wrote Moby Dick in 1851 but it took decades before it was finally regarded as a great American novel, and worthy of its place among the greatest texts of humankind. A tale of imagination and adventure, it recounts the obsessive quest of Ahab, captain of a whaling ship seeking vengeance on Moby Dick, the white whale that had bitten off his leg on a previous voyage.',
                'isbn' => '9781787557901',
                'order' => 4,
                'author' => 'Herman Melville'
            ]);
    }
}
