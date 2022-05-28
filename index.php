<?php 

// 
require('./Notification.php') ;
require('./User.php') ;
require('./Payment.php') ;
require('./Leave.php') ;

use User\User;
use User\Dispatcher ;
use User\UserRegistered ;

$u = (new User('Jack'))  ;

(new Dispatcher) ->dispatch(new UserRegistered($u)) ;

