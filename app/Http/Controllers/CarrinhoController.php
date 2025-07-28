<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
class CarrinhoController extends Controller
{
    public function listaCarrinho()
    {
        $itens = \Cart::content();
        // dd($itens);
        return view('carrinho.lista',compact('itens'));
    }

     public function addCarrinho(Request $request)
    {
        $itens = \Cart::add([
            'id' => $request->id,
            'name'=> $request->name,
            'price'=> $request->price,
            'qty'=> is_array($request->qnt) ? $request->qnt['value'] : $request->qnt,
            'weight' => $request->weight ?? 0,
            'options'=> [
                'image'=> $request->img
            ]
        ]);



        return redirect('carrinho')->with('sucesso', 'Produto adicionado com sucesso!');
    }

    public function removeCarrinho(Request $request){
        \Cart::remove($request->id);
        return redirect('carrinho')->with('sucesso', 'Produto removido com sucesso!');
    }

     public function atualizaCarrinho(Request $request){
        // dd($request);
        \Cart::update($request->id, ['qty'=>$request->qty]);
        return redirect('carrinho')->with('sucesso', 'Produto atualizado com sucesso!');
    }

    // public function salvar(Request $request){
    //     try {
    //     $dados = $request->json()->get('dados');
    //     dd($dados);


    //         // foreach ($dados as $item) {
    //         //     Categoria::updateOrCreate(
    //         //         [
    //         //             'id' => $item['id']],
    //         //         [
    //         //         'nome' => $item['nome'],
    //         //         'descricao' => $item['descricao'],
    //         //         ]
    //         //     );
    //         // }
    //                     foreach ($dados as $item) {
    //             Categoria::updateOrCreate(
    //                 ['id' => $item['id'] ?? null],
    //                 [
    //                     'nome' => $item['nome'] ?? '',
    //                     'descricao' => $item['descricao'] ?? ''
    //                 ]
    //             );
    //         }

    //     } catch (\Throwable $e) {
    //         echo $e;

    //             }


    // }

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
