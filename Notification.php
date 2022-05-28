<?php 

namespace Notification {

	class Notification {

	}

	class User {


	}

	class Dispatcher {

		private $_services = [


		] ;

		public function dispatch(Event $event)
		{

		}
	}

	class EventBus {

		private $_subscribers = [

			\User\UserRegistered::class => [
				SendWelcome::class
			]
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

	class SendWelcome extends Observer {

		public function handle($event)
		{

			echo 'Notification email sent to ' . $event ->getUser() ->getname() . '<br>' ;
		}

	}

	class Observer {

	}
}
