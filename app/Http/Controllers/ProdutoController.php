<?php

namespace App\Http\Controllers;

use App\Models\{Produto, Categoria};
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;


class ProdutoController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::paginate(5);
        $qtnProdutos = $produtos->count();
        $categorias = Categoria::all();
        return view('admin.produtos.lista', compact('produtos', 'qtnProdutos', 'categorias'));

    }

    public function details($slug)
    {
        $produto = Produto::where('slug', $slug)->first();
        // Gate::authorize('ver-produto', $produto);
        // $this->authorize('verProduto', $produto);

        if(Gate::denies('verProduto', $produto)){
            return view('produtos.lista');
        }

        if (Gate::allows('verProduto', $produto)) {
            return view('produtos.details', compact('produto'));
        }



        // return view('produtos.details', compact('produto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produto = $request->all();
        // dd($produto);
        if($request->imagem){
            $produto['imagem'] = $request->imagem->store('produtos');
        }

        $produto['slug'] = \Str::slug($request->nome);

        $produto = Produto::create($produto);
        return redirect()->route('admin.produtos')->with('sucesso', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('admin.produtos')->with('sucesso', 'Produto removido com sucesso!');
    }
}
