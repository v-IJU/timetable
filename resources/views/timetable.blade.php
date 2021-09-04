@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
<table class="table">
  
  <thead>
    <tr>
    

     
      	<?php

      	$day=Session::get('workday');
    $days = array();
    for ($i = 0; $i < $day; $i++) {
        $days[$i] = jddayofweek($i,1);
    }
    //print_r($days);
?>

      @foreach($days as $day)
      <th scope="col">{{$day}}</th>
      @endforeach
    </tr>
  </thead>
  <tbody>
  	<?php
  	$sub=Session::get('subjects_per_day');
  	?>
  
  @for($i=0;$i<$sub;$i++)
  
  <tr>
    
    @foreach($data as $key=>$dat)
         
        
        <td>{{ $dat->name }}-{{$dat->hr}}</td>
       
        
         
     @endforeach
    
     
  </tr>
  
 @endfor

  </tbody>
</table>
<?php
session()->forget('subjects_per_day');
session()->forget('workday');?>
</div>
</div>
@endsection