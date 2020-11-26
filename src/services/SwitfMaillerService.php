<?php



class Email{

    public function sendEmail($user, \Swift_Mailer $mailer)
    {
    $message = (new \Swift_Message('Sonatel Academy'))
    ->setFrom('send@example.com')
    ->setTo('recipient@example.com')
    ->setBody("Bonjour cher(e)" . $user->getPrenom() . " " .$user->getNom()."
              \nVous etse enregistrer dans la platforme ODC
              Vos informations pour vous connecter à votre promo.\n username:" . $user->getUsername() . 
             " mot de passe:" .$user->getPlainPassword() . ".\n A bientot.".
             "\nNB: Vous pouvez changer votre mot pass ici"
            );
    ;
    
    $mailer->send($message);
    return 0;
    }
  

}












