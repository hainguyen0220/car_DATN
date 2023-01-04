<?php

namespace App\Imports;

use App\Models\Author;
use App\Models\Car;
use App\Models\CategoryDetail;
use App\Models\Gara;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class CarImport implements ToCollection, WithHeadingRow
{
    const STATUS = 'con';

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $idGara = Gara::where('name', $row['nha_xuat_ban'])->first()->id ?? null;
            if (!$idGara) {
                Gara::create([
                    'name' => $row['nha_xuat_ban'],
                    'email' => $row['nha_xuat_ban'] . '@gmail.com',
                ]);
            }

            $idAuthor = Author::where('full_name', $row['tac_gia'])->first()->id ?? null;
            if (!$idAuthor) {
                Author::create([
                    'full_name' => $row['tac_gia'],
                ]);
            }

            $dataInsert = [
                'gara' => Gara::where('name', $row['nha_xuat_ban'])->first()->id,
                'author' => Author::where('full_name', $row['tac_gia'])->first()->id,
                'category_detail' => CategoryDetail::where('category_detail_name', $row['the_loai'])->first()->id,
                'publish_date' => $row['nam_xuat_ban'],
                'status' => $row['trang_thai'] ?? self::STATUS,
                'describle' => $row['mo_ta'],
            ];
            Car::create([
                'car_name' => $row['ten_sach'],
                'total_quantity' => $row['so_luong'],
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyrvDC_rR3376EnCjvy0PkESXGd4FTJsf0ew&usqp=CAU',
            ])->createCarDetail($dataInsert);
        }
    }

    public function batchSize(): int
    {
        return 500;
    }
}
