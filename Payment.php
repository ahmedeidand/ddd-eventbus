<?php 

namespace Payment {


	class Payment {


	}

	class User {


	}

	class Dispatcher {

		private $_services = [

			\User\EventBus::class , 
			\Leave\EventBus::class

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
				FixPayment::class ,
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

	class PaymentGenerated extends Event {

		private $_payment ; 

		public function __construct(Payment $payment)
		{

			$this 	->_payment = $payment ; 
		}

		public function getPayment()
		{

			return $this ->_payment  ;
		}
	}


	class FixPayment extends Observer {

		public function handle($event)
		{
			echo 'Payment of ' . $event ->getuser() ->getname() . '<br>' ;
		}
	}

	class Observer {


	} 

}