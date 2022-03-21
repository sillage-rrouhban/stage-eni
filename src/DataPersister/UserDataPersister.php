<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;


class UserDataPersister implements ContextAwareDataPersisterInterface
{
    private $passwordHasher;
    private $entityManager;
    private $emailHelper;
    private $mailer;

    public function __construct(UserPasswordHasherInterface $passwordHasher,EntityManagerInterface $entityManager, VerifyEmailHelperInterface $emailHelper, MailerInterface $mailer)
    {
        $this->passwordHasher= $passwordHasher;
        $this->entityManager = $entityManager;
        $this->emailHelper = $emailHelper;
        $this->mailer = $mailer;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function persist($data, array $context = [])
    {
        if($data->getPlainPassword()){
            $password = $this->passwordHasher->hashPassword($data, $data->getPlainPassword());
            $data->setPassword($password);

            $data->eraseCredentials();
        }

        $this->entityManager->persist($data);
        $this->sendConfirmationEmail($data);
        $this->entityManager->flush();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendConfirmationEmail(User $user){
        $signatureComponents = $this->emailHelper->generateSignature(
            'registration_confirmation',
            $user->getId(),
            $user->getEmail(),
        );
        $email= new TemplatedEmail();
        $email->from('sophie@chooseyourtraining.com');
        $email->to($user->getEmail());
        $email->htmlTemplate('email/confirmation_email.htm.twig');
        $email->context(['signedUrl'=>$signatureComponents->getSignedUrl()]);
        $this->mailer->send($email);

    }

    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }

}
