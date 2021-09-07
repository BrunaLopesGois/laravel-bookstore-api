<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Repositories\BookRepositoryEloquent;
use Illuminate\Http\Request;
use App\Mail\CheckoutMail;

class CheckoutController extends Controller
{
    public function checkout(int $id, Request $request)
    {
        $request->validate([
            'card_number' => 'required',
            'owner_name' => 'required|min:3|max:255',
            'expiration_date' => 'required',
            'cvv' => 'required|min:3|max:3'
        ]);

        $repository = new BookRepositoryEloquent();
        $book = $repository->findById($id);

        if (is_null($book)) {
            return response()->json('Livro não encontrado', 404);
        }

        if ($request->mailtrap_user) {
            $sendTo = $request->mailtrap_user;
            $mailContent = [
                'title' => 'Compra realizada com sucesso',
                'body' => "Você acaba de adquirir um exemplar do livro **$book->title**"
            ];

            SendMailJob::dispatch($sendTo, $mailContent);
        }

        return response()->json('', 202);
    }
}
