<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Produto, User, Categoria};
use DB;
class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $usuariosCount = User::all()->count();

        //Grafico 1
        $usersData = User::select([
            // DB::raw('YEAR(created_at) as ano'),
            DB::raw("strftime('%Y', created_at) as ano"),
            DB::raw('COUNT(*) as total')
        ])
            ->groupBy('ano')
            ->orderBy('ano', 'asc')
            ->get();

        //preparar Arrays
        foreach ($usersData as $user) {
            $ano[] = $user->ano;
            $total[] = $user->total;

        }
        // formatar para chartJS
        $userLabel = "'Comparativo de cadastros de usuários'";
        $userAno = implode(',', $ano);
        $userTotal = implode(',', $total);


        // Grafico 2
        $categoriaData = Categoria::with('produtos')->get();

        // Preparar Array
        foreach ($categoriaData as $categoria) {
            $categoriaNome[] = "'".$categoria->nome."'";
            $categoriaTotalProdutos[] = $categoria->produtos->count();

        }
        // dd($categoriaNome);
        //formatar para ChartJS
        $catLabel = implode(',', $categoriaNome);
        $catTotal = implode(',', $categoriaTotalProdutos);


        return view('admin.dashboard', compact(
            'usuariosCount', 'userLabel', 'userAno', 'userTotal', 'catLabel', 'catTotal'));
    }
}
