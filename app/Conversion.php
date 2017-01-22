<?php

namespace App;

use App\Contracts\ConversionStorage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Conversion extends Model implements ConversionStorage
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @param int $arabic
     * @param string $roman
     */
    public function persist(int $arabic, string $roman)
    {
        $this->arabic = $arabic;
        $this->roman  = $roman;

        $this->save();
    }

    /**
     * Lists the top 10 converted integers.
     *
     * @return \Illuminate\Support\Collection
     */
    public function top10()
    {
        return self::select('roman', DB::raw('count(id) AS top'))
            ->groupBy('roman')
            ->orderBy('top', 'desc')
            ->limit(10)
            ->get()
        ;
    }

    /**
     * Lists all of the recently converted integers.
     *
     * @param  $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function recently($perPage = 100)
    {
        return self::orderBy('created_at', 'desc')->paginate($perPage);
    }
}
