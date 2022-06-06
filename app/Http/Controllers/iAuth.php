<?php


namespace App\Http\Controllers;


interface iAuth
{
    public function guard();

    public function resource();

    public function Model();

    public function registrationRules(): array;

    public function loginRules(): array;


}
