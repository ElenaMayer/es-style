<?php

class UserForMail extends CApplicationComponent {
    private $_model=null;
    public $id;
    public $email;
    public $hash;

    public function setUser($user) {
        $this->_model=$user;
        $this->id = $user->id;
        $this->email = $user->email;
        $this->hash = crypt($this->_model->id, $this->_model->name);
    }

    public function setUserByUsername($username) {
        $user = User::model()->findByAttributes(['username' => $username]);
        $this->setUser($user);
    }
}