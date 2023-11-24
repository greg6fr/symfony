<?php

namespace App\Services;

use App\Entity\Contact;

class FormattedContact
{
    public function __construct()
    {

    }
public function transform(Contact $contact) :Contact{
        $contact->setSubject(strtolower($contact->getSubject()));
        $contact->setEmail(strtolower($contact->getEmail()));
        $contact->setMessage(strtolower($contact->getMessage()));
        return $contact;

}
}