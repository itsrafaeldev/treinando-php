<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
class CarrinhoController extends Controller
{
    public function listaCarrinho()
    {
        $itens = \Cart::content();
        \Cart::Tax(0);
        $total = \Cart::total();
         return view('carrinho.lista', compact('itens', 'total'));
    }

    public function addCarrinho(Request $request)
    {
        $itens = \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'qty' => is_array($request->qnt) ? abs($request->qnt['value']) : abs($request->qnt),
            'weight' => $request->weight ?? 0,
            'options' => [
                'image' => $request->img
            ],

        ]);

        \Cart::setGlobalTax(0);



        return redirect('carrinho')->with('sucesso', 'Produto adicionado com sucesso!');
    }

    public function removeCarrinho(Request $request)
    {
        \Cart::remove($request->id);
        return redirect('carrinho')->with('sucesso', 'Produto removido com sucesso!');
    }

    public function atualizaCarrinho(Request $request)
    {
        \Cart::update($request->id, [
            'qty' => abs((int) $request->qty)
        ]);


        return redirect('carrinho')->with('sucesso', 'Produto atualizado com sucesso!');
    }

    public function limparCarrinho(Request $request)
    {

        \Cart::destroy();
        return redirect('carrinho')->with('aviso', 'Seu carrinho está vazio!');
    }

    public function salvar(Request $request)
    {
        try {
            $dados = $request->input('dados');
            foreach ($dados as $item) {

                Categoria::updateOrCreate(
                    ['id' => $item['id'] ?? null],
                    [
                        'nome' => $item['nome'] ?? '',
                        'descricao' => $item['descricao'] ?? ''
                    ]
                );
            }

            return response()->json(['status' => 'ok']);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
