<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function index(){
        return view('clients.layouts.contact.contact');
    }

    public function send(Request $request)

    {
        // Validation des données
      $validated=  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:5000',
            'subject'=> 'required|string|max:2500'
        ]);

        $emailData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'messageContent' => $validated['message']
        ];

        // Envoi de l'email
        $name = $validated['name'];
        $email = $validated['email'];
        $subject = $validated['subject'];
        $messageContent = $validated['message'];

        // Envoi de l'email en format brut
        Mail::raw("
            Nouveau message de contact :
            
            Nom : $name
            Email : $email
            Sujet : $subject

            Message :
            $messageContent

            ---
            Cet email a été envoyé via le formulaire de contact de votre plateforme PAPE.Veuillez contacter l'interesser via son gmail pour le satisfaire.
        ", function ($mail) use ($validated) {
            $mail->to('serviceclient@cesiebenin.com') // Destination
            ->from('syrram@cesiebenin.com', 'Plateforme PAPE') // Adresse expéditeur authentifiée
            ->replyTo($validated['email'],$validated['name']) // Répondre à l'expéditeur réel
            ->subject($validated['subject']); // Sujet
        });

        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
       
}

}