<?php

//保存一个对象的某个状态，以便在适当的时候恢复对象
//使用场景： 1、需要保存/恢复数据的相关状态场景。 2、提供一个可回滚的操作。
    class Memento
    {
        private $state;

        public function __construct(string $state)
        {
            $this->state = $state;
        }

        public function getState()
        {
            return $this->state;
        }
    }

    class Originator
    {
        private $state;

        public function setState(string $state)
        {
            $this->state = $state;
        }

        public function getState()
        {
            echo $this->state."\n";
        }

        public function saveStateToMemento()
        {
            return new Memento($this->state);
        }

        public function restoreFromMemento(Memento $memento)
        {
            return $memento->getState();
        }
    }

    class CareTaker
    {
        private $list = [];

        public function add(Memento $memento)
        {
            $this->list[] = $memento;
        }

        public function get($index)
        {
            return $this->list[$index];
        }
    }

    $origin = new Originator();
    $caretaker = new CareTaker();

    $origin->setState('hello origig #1');
    $origin->setState('hello origin #2');
    $origin->getState();
    $memento1 = $origin->saveStateToMemento();
    $caretaker->add($memento1);
    $origin->setState('hello origin #3');
    $memento2 = $origin->saveStateToMemento();
    $caretaker->add($memento2);
    $origin->getState();
    $memento4 = $caretaker->get(1);
    $origin->restoreFromMemento($memento4);
    $origin->getState();
?>