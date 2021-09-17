<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Repositories\BookRepositoryEloquent;
use Illuminate\Http\Request;
use App\Mail\CheckoutMail;
use Illuminate\Support\Facades\Mail;

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

        // TODO: As filas não estão funcionando no Heroku.
        if ($request->mail) {
            $sendTo = $request->mail;
            $mailContent = [
                'title' => 'Compra realizada com sucesso',
                'body' => "Você acaba de adquirir um exemplar do livro **$book->title**"
            ];

            $email = new CheckoutMail($mailContent);
            Mail::to($sendTo)->send($email);

            // SendMailJob::dispatch($sendTo, $mailContent);
        }

        return response()->json('', 202);
    }
}
