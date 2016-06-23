<?php

Class ControllerService {


public function check_input () {
	$fails= false;
	$rules = array(
        'driver_id'  => 'required',                       
        'service_id' => 'required'       
    );

	$data_in = array( 
		'service_id'  =>  Input::get('service_id'),
		'driver_id'   =>  Input::get('driver_id')    
		);

    $validator = Validator::make($data_in, $rules);

    if ($validator->fails()) {
    	$fails = true;
    }

    return $fails;
}

public function post_confirm () {

	if ($this->check_input) {
		return Response::json(array('error' => '4')); 
	}

	$service_id = Input::get('service_id');
	$driver_id  = Input::get('driver_id');
	$service = Service::find($id);      
	$driver = Driver::find($driver_id);				


	if ($service == NULL) 
		return Response::json(array('error' => '3'));
		
	if ($service->status_id == '6') 
		return Response::json(array('error' => '2'));

	if ($service->driver_id != NULL && $service->status_id != '1') //Si el servicio ya tiene conductor asignado
		return Response::json(array('error' => '1'));

	if ($service->user->uuid == '') 
		return Response::json(array('error' => '6'));
	/* Busy driver*/
	if ($driver->available != 0) 
		return Response::json(array('error' => '5'));

	Service::update( $service_id, array( 
		'driver_id' => $driver_id,
		'status_id' => '2',
		'car_id'    => $driver->car_id
	);
			
	Driver::update( $driver_id , array( "available" => '0') );

	$pushMessage = 'Tu servicio ha sido confirmado!';
	$push = Push::make();

	if ($service->user->type == '1') {
			$result = $push->ios($servicio->user->uuid, $pushMessage, 1, 'default', 'open', array('servicioId' => $service->id));
	}else{
		$result = $push->android2($servicio->user->uuid, $pushMessage, 1, 'default', 'open', array('servicioId' => $service->id));
	}
	return Response::json(array('error' => '0'));
}


?>