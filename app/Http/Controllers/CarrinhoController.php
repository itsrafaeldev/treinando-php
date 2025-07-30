<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Carbon;
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
            // $dados = $request->input('dados');
            // foreach ($dados as $item) {

            //     Categoria::updateOrCreate(
            //         ['id' => $item['id'] ?? null],
            //         [
            //             'nome' => $item['nome'] ?? '',
            //             'descricao' => $item['descricao'] ?? ''
            //         ]
            //     );
            // }

            $usuarios = $request->input('usuarios');

            if (isset($usuarios['email'])) {
                try {
                    // Converte para Y-m-d (formato aceito por "after_or_equal")
                    $usuarios['email'] = Carbon::createFromFormat('d/m/Y', $usuarios['email'])->format('Y-m-d');
                } catch (\Exception $e) {
                    return back()->withErrors(['data' => 'Formato de data inválido.'])->withInput();
                }
            }



            $dadosValidados = $request->validate([
                'usuarios' => 'required|array',
                'usuarios.*.nome' => 'required|string|max:255',
                // 'usuarios.*.email' => 'required|email',
                'usuarios.*.idade' => 'required|numeric|min:18',
                'usuarios.*.email' => [
                    'required',
                    function ($attribute, $value, $fail) use (&$request) {
                        try {
                            // Tenta converter para Y-m-d (formato que o Laravel entende)
                            $dataFormatada = Carbon::createFromFormat('d/m/Y', $value);

                            // Verifica se é hoje ou depois
                            if ($dataFormatada->lt(Carbon::today())) {
                                $fail('A data deve ser hoje ou uma data futura.');
                            }

                            // Substitui o valor convertido na própria request (opcional)
                            $request->merge([
                                $attribute => $dataFormatada->format('Y-m-d'),
                            ]);
                        } catch (\Exception $e) {
                            $fail('Formato de data inválido. Use dd/mm/YYYY.');
                        }
                    },
                ],
            ]);

            foreach ($dadosValidados['usuarios'] as $usuario) {
                echo "data: {$usuario['email']}";
            }


            return response()->json(['status' => 'ok']);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
