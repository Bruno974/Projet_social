<?php

namespace AppBundle\Services;

class ContactService
{
    protected $mailer;
    protected $templating;

    public function __construct(\Swift_Mailer $mailer, $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating; //Pour pouvoir utiliser le render
    }

    public function sendContactMail($form)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Demande d\'informations')
            ->setFrom($form->mail)
            ->setTo('gont.bruno@gmail.com')
            ->setContentType('text/html') //évite d'avoir du code html ds le mail

            ->setBody(
                $this->templating->render('Contact\mail.html.twig', array('formulaire' => $form))
            );

        $this->mailer->send($message);
    }
}
