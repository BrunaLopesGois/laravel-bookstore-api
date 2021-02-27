<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(int $id, Request $request)
    {
        $request->validate([
            'numero_do_cartao' => 'required|numeric',
            'nome_do_titular' => 'required|min:3|max:255',
            'data_de_expiracao' => 'required',
            'cvv' => 'required|min:3|max:3'
        ]);

        $book = Book::find($id);

        $message = "Compra do livro $book->title realizada com sucesso";

        return $message;
    }
}
