<?php
  //structures to manage conversations and messages
  class Message{
    public $nameSender;
    public $nameReceiver;
    public $message;
    public $timestamp;

    public function __construct($nameSender, $nameReceiver, $message, $timestamp){
      $this->nameSender = $nameSender;
      $this->nameReceiver = $nameReceiver;
      $this->message = $message;
      $this->timestamp = $timestamp;
    }
  }

  class Conversation{
    public $personId;
    public $image;
    public $name;
    public $surname;
    public $messages;
    public $lastMessageDate;

    public function __construct($row, $message, $session_to_match){
      $this->messages = array();

      //if I am the sender my conversation is with the reciver and vice versa.
      if($row['sender'] == $session_to_match){
        $this->personId = $row['receiver'];
        $this->image = $row['imageReceiver'];
        $this->name = $row['nameReceiver'];
        $this->surname = $row['surnameReceiver'];
      }
      else{
        $this->personId = $row['sender'];
        $this->image = $row['imageSender'];
        $this->name = $row['nameSender'];
        $this->surname = $row['surnameSender'];
      }

      $this->addMessage($message);
    }

    public function addMessage($message){
      $this->lastMessageDate = $message->timestamp;
      array_push($this->messages, $message);
    }
  }

  class ConversationList{
    public $conversations;
    public $conversationIndex;

    public function __construct($conversation){
      $this->conversations = array($conversation);
    }

    public function add($conversation){
      array_push($this->conversations, $conversation);
    }

    public function addMessage($conversation, $message){
      $this->conversations[$this->conversationIndex]->addMessage($message);
    }

    public function isPresent($conversation, $sender, $reciever){
      foreach ($this->conversations as $index => $conversation) {
        //If I've already had a conversation with somebody, add the message to it without create another one
        if(($conversation->personId == $sender) || ($conversation->personId == $reciever)){
          $this->conversationIndex=$index;
          return true;
        }
      }
      return false;
    }

    public function sortByDate(){
      usort($this->conversations, function($a,$b){
        $a = new DateTime($a->lastMessageDate);
        $b = new DateTime($b->lastMessageDate);

        return $a->getTimestamp()-$b->getTimestamp();
      });
    }

    public function printConversations(){
      foreach ($this->conversations as $conversation) {
        echo "Conversation with: ".$conversation->personId. "<br>Messages:<br>";
        foreach ($conversation->messages as $message) {
          echo "Sender: ".(empty($message->nameSender)?'You':$message->nameSender)." Receiver: ".(empty($message->nameReceiver)?'You':$message->nameReceiver)." Message: $message->message<br>";
        }
        echo "<br>";
      }
    }
  }
?>
