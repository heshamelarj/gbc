<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/9/19
 * Time: 10:47 AM
 */

namespace App\Service;


use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserSecurity
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder  =   $passwordEncoder;

    }

    public function  encodeUserPassword(User $user, $password)
    {

        return $this->passwordEncoder->encodePassword($user, $password);
    }



}