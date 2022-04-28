<?php

require_once("models/Contact.php");
require_once("models/Message.php");

class ContactDAO implements ContactDAOInterface
{
    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {

        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
        
    }

    public function buildContact($data)
    {

        $contact = new Contact();

        $contact->id = $data["id"];
        $contact->name = $data["name"];
        $contact->email = $data["email"];
        $contact->phone = $data["phone"];
        $contact->observations = $data["observations"];
        $contact->users_id = $data["users_id"];

        return $contact;

    }

    public function create(Contact $contact)
    {

        $stmt = $this->conn->prepare("INSERT INTO contacts (name, email, phone, observations, users_id) VALUES (:name, :email, :phone, :observations, :users_id)");

        $stmt->bindParam(":name", $contact->name);
        $stmt->bindParam(":email", $contact->email);
        $stmt->bindParam(":phone", $contact->phone);
        $stmt->bindParam(":observations", $contact->observations);
        $stmt->bindParam(":users_id", $contact->users_id);

        $stmt->execute();

            // CONTACT CREATE MESSAGE
        $this->message->setMessage("Contact created succesfuly", "success");

    }

    public function update(Contact $contact)
    {

        $stmt = $this->conn->prepare("UPDATE contacts SET name = :name, email = :email, phone = :phone, observations = :observations, users_id = :users_id) WHERE id = :id");

        $stmt->bindParam(":id", $contact->id);
        $stmt->bindParam(":name", $contact->name);
        $stmt->bindParam(":email", $contact->email);
        $stmt->bindParam(":phone", $contact->phone);
        $stmt->bindParam(":observations", $contact->observations);
        $stmt->bindParam(":users_id", $contact->users_id);

        $stmt->execute();

            // CONTACT UPDATE MESSAGE
        $this->message->setMessage("Contact updated succesfuly", "success");

    }

    public function delete($id)
    {

        $stmt = $this->conn->prepare("DELETE FROM contacts WHERE id = :id");

        $stmt->bindParam(":id", $id);

        $stmt->execute();

            // CONTACT DELETE MESSAGE
        $this->message->setMessage("Contact deleted succesfuly", "success");
        
    }

    public function findAll()
    {

    }

    public function findByUserId($id)
    {

        $contacts = [];

        $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE users_id = :users_id ORDER BY name ASC");

        $stmt->bindParam(":users_id", $id);

        $stmt->execute();

        if($stmt->rowCount() > 0)
        {

            $contactsArray = $stmt->fetchAll();

            foreach($contactsArray as $contact)
            {

                $contacts[] = $this->buildContact($contact);

            }

        }

        return $contacts;

    }

    public function findById($id)
    {

        $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE id = :id");

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        if($stmt->rowCount() > 0)
        {

            $contactData = $stmt->fetch();

            $contact = $this->buildContact($contactData);

            return $contact;
            
        }

        return false;

    }

    public function findByName($name)
    {

        $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE name = :name");

        $stmt->bindParam(":name", $name);

        $stmt->execute();

        if($stmt->rowCount() > 0)
        {

            $contactData = $stmt->fetch();

            $contact = $this->buildContact($contactData);

            return $contact;
            
        }

        return false;

    }

    public function findByEmail($email)
    {

        $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE email = :email");

        $stmt->bindParam(":email", $email);

        $stmt->execute();

        if($stmt->rowCount() > 0)
        {

            $contactData = $stmt->fetch();

            $contact = $this->buildContact($contactData);

            return $contact;
            
        }

        return false;

    }

    public function findByPhone($phone)
    {

    }

    public function searchContact($search)
    {

        $contacts = [];

        $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE name LIKE :name OR email LIKE :name ORDER BY name ASC");

        $stmt->bindValue(":name", '%'.$search.'%'); // SERACH EVEN FOR PART OF NAME

        $stmt->execute();

        if($stmt->rowCount() > 0)
        {

            $contactsArray = $stmt->fetchAll();

            foreach($contactsArray as $contact)
            {

                $contacts[] = $this->buildContact($contact);

            }

        }

        return $contacts;

    }

}

?>