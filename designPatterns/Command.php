<?php
  /**
   * 为了封装和解藕
   */
  interface CommandInterface
  {
    public function execute();
  }

  /**
    * 具体命令
    */
  class HelloCommand implements CommandInterface
  {
    private $console;
    public function __construct(Receiver $console)
    {
      $this->console = $console;
    }

    public function execute()
    {
      $this->console->write('hello world');
      echo "output is :" . $this->console->getOutput()."\n";
    }
  }

  /**
   * 接收者
   */
  class Receiver
  {
    private $enableDate = false;

    private $output = [];

    public function write($str)
    {
        if ($this->enableDate) {
          $this->output[] = '['.date('Y-m-d').']';
        }

        $this->output[] = $str;
    }

    public function getOutput():string
    {
      return join('\n', $this->output);
    }

    public function enableDate()
    {
      $this->enableDate = true;
    }

    public function disableDate()
    {
      $this->enableDate = false;
    }
  }

  /**
   * 命令的调用者
   */
  class Invoker
  {
    private $command;

    public function setCommand(CommandInterface $cmd)
    {
      $this->command = $cmd;
    }

    public function run()
    {
      $this->command->execute();
    }
  }

  $invoker = new Invoker();
  $cmd = new HelloCommand(new Receiver());

  $invoker->setCommand($cmd);
  $invoker->run();

?>
