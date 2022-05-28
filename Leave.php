<?php 
	
namespace Leave {

	class Leave {

		private $_id ;
		private $_user_id ;

	}

	class User {

		private $_name ;
	} 

	class Dispatcher {

		private $_services = [

			\Payment\EventBus::class , 
			\User\EventBus::class


		] ;


		public function dispatch(Event $event)
		{

			foreach ($this ->_services as $service) {
				(new $service) ->publish(serialize($event)) ;
			}
		}

		public function getServices()
		{
			return $this ->_services;
		}
		
	}

	class EventBus
	{

		private $_subscribers = [

			\User\UserRegistered::class => [
				ConfigureLeave::class 
			] , 

		] ;

		public function publish(string $event)
		{

			foreach ($this ->_subscribers [get_class(unserialize($event))] as $subscriber) {
				(new $subscriber) ->handle(unserialize($event)) ;
			}
		}
	}

	class Event {


	}


	class LeaveRequested extends Event {

		private $_leave ; 

		public function __construct(Leave 	$leave)
		{

			$this ->_leave = $leave ; 
		}

		public function getLeave()
		{

			return $this ->_leave ; 
		}

	}

	class Observer {


	}

	class ConfigureLeave extends Observer {

		public function handle($event)
		{

			echo 'Leave configured for ' . $event ->getuser() ->getname() .	'<br>' ; 
		}
	}

}

