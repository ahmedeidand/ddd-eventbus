<?php 

namespace User {

	class User {

		private $_name ; 

		public function __construct(string $name)
		{

			$this 	->_name = $name ; 
		}

		public function getName()
		{

			return $this ->_name;  
		}
	}

	class Dispatcher {

		private $_services = [

			\User\EventBus::class ,
			\Payment\EventBus::class , 
			\Leave\EventBus::class , 
			\Notification\EventBus::class
		] ;

		public function dispatch(Event $event)
		{

			foreach ($this ->_services as $service) {
				(new $service) ->publish(serialize($event)) ;
			}
		}

	}

	class EventBus
	{
		private $_subscibers = [

			\Leave\LeaveRequested::class => [

			]
		] ;

		public function publish(string $event)
		{


		}

	}

	class SendEmail extends Observer
	{

		public function handle(Event $event)
		{

		}
	}

	class Observer
	{

	}

	class Event {


	}

	class UserRegistered extends Event {

		private $_user ;

		public function __construct(User $user)
		{
			$this ->_user = $user ;
		}

		public function getUser()
		{
			return $this 	->_user ; 
		}
	}


}