<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepositoryEloquent;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(int $id, Request $request)
    {
        $request->validate([
            'card_number' => 'required|numeric',
            'owner_name' => 'required|min:3|max:255',
            'expiration_date' => 'required',
            'cvv' => 'required|min:3|max:3'
        ]);

        $repository = new BookRepositoryEloquent();
        $book = $repository->findById($id);

        if (is_null($book)) {
            return response()->json('Livro não encontrado', 404);
        }

        $message = "Compra do livro $book->title realizada com sucesso";

        return response()->json($message, 202);
    }
}
