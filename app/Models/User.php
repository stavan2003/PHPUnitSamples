<?php
namespace App\Models;
/**
 * Created by PhpStorm.
 * User: stavan.shah
 * Date: 11/18/2017
 * Time: 5:20 PM
 */


class User
{
    protected $first_name;
    protected $last_name;
    protected $email;

    public function setFirstName($firstName){
        $this->first_name = trim($firstName);
    }

    public function getFirstName(){
        return $this->first_name;
    }

    public function setLastName($lastName){
        $this->last_name = trim($lastName);
    }

    public function getLastName(){
        return $this->last_name;
    }

    public function getFullName(){
        return $this->first_name.' '.$this->last_name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = trim($email);
    }

    public function getEmailVariables(){
        $email_var = ['name' => $this->getFullName(),
                      'email' => $this->getEmail()];
        return json_encode($email_var);
    }
}