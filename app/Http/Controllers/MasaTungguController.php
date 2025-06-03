<?php
namespace App\Http\Controllers;

use App\Models\LulusanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class MasaTungguController extends Controller
{
    public function index(Request $request)
    {
        $query = LulusanModel::with(['kuisionerlulusan', 'prodi'])
            ->whereHas('kuisionerlulusan', function ($q) {
                $q->whereNotNull('tanggal_pertama_berkerja');
            });

        // Apply name filter if provided
        if ($request->has('name') && !empty($request->input('name'))) {
            $query->where('nama_lulusan', 'like', '%' . $request->input('name') . '%');
        }

        // Paginate the results (10 items per page)
        $perPage = 10;
        $page = $request->input('page', 1);
        $total = $query->count();
        $lulusanQuery = $query->get();
        
        // Transform the collection with map to add masa_tunggu
        $transformedItems = $lulusanQuery->map(function ($item) {
            $tanggalLulus = Carbon::parse($item['tanggal_lulus']);
            $tanggalKerja = Carbon::parse($item['kuisionerlulusan']['tanggal_pertama_berkerja']);
            $waitingTime = $tanggalLulus->diffInMonths($tanggalKerja);
            $item['masa_tunggu'] = $waitingTime . ' bulan'; // Add masa_tunggu as a dynamic property
            return (object) $item; // Convert array to object for consistency
        });

        // Manually create a paginator
        $lulusan = new LengthAwarePaginator(
            $transformedItems->forPage($page, $perPage),
            $total,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Debugging: Log the data to check if anything is returned
        Log::info('Lulusan Data:', ['count' => $lulusan->count(), 'data' => $lulusan->toArray()]);

        return view('masatunggu.index', [
            'lulusan' => $lulusan,
            'activePage' => 'masa-tunggu',
        ]);
    }
}