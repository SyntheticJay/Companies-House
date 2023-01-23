<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Models\Company\SicCode\SicCode;

class SicCodeSeeder extends Seeder
{
    public $path;
    public $csv;

    /**
     * Construct the seeder
     *
     * @return void
     */
    public function __construct()
    {
        $this->path = storage_path('app\seeder\sic_codes.csv');
        $this->csv  = Reader::createFromPath($this->path, 'r');
        $this->csv->setHeaderOffset(0);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->csv->getRecords() as $record) {
            SicCode::create([
                'sic_code'    => $record['sicCode'],
                'description' => $record['refDescription']
            ]);
        }
    }
}
