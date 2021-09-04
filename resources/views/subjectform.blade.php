@extends('layouts.app')

@section('content')
<style>
.head{
  text-align: center;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Subject Form') }}</div>

                <div class="card-body">
                     @if($message = Session::get('success'))
                   <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"></button>
                           <strong>{{ $message }}</strong>
                   </div>
                   @endif
                   @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                   <div class="form-group row head">
                      <div class="col-md-6">
                    <h4>subject</h4>
                  </div>
                   <div class="col-md-6">
                    <h4>Hours</h4>
                  </div>
                   </div>
                    <form method="post" action="{{route('generate')}}">
                        @csrf
                        <?php
                           $subject=Session::get('totalsub');
                           ?>
                           @if($subject)
                           <?php
                           for($i=1;$i<=$subject;$i++)
                           {
                           ?>
                        <div class="form-group row">

                           <div class="col-md-6">
                                <input id="subject" type="text" class="form-control @error('workdays') is-invalid @enderror" name="subjectname[]" value="" autocomplete="email" autofocus placeholder="Subject {{$i}}">

                                @error('workdays')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input id="subhr" type="text" class="form-control @error('subhr') is-invalid @enderror" name="subhr[]" value="" required autocomplete="subhr" autofocus >

                                @error('workdays')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <?php
                      }?>

                      <div class="form-group row">
                      <div class="col-md-6">
                         
                           <label for="workdays" class="">{{ __('Total Week Hrs') }}</label>
                        
                         
                      </div>
                     <div class="col-md-6">
                      <?php
                          $total=Session::get('total');
                          ?>
                          <input id="total" type="text" class="form-control @error('subhr') is-invalid @enderror" name="total" value="{{$total}}" required autocomplete="subhr" autofocus readonly="">
                          <input type="hidden" name="id" value="{{$id}}">
                     </div>
                     </div>
                        @endif
                       
                      
                       
                         
                        

                        

                       

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-10">
                                <button type="submit" class="btn btn-primary" id="generate">
                                    {{ __('Generate') }}
                                </button>
                                 
                                

                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

 <script>
        


        $(function () {

         

        $("#perdaysub,#totsub,#hrworkdays,#workdays").keypress(function (e) {
            var keyCode = e.keyCode || e.which;
 
            $("#lblError").html("");
 
            //Regex for Valid Characters i.e. Alphabets and Numbers.
            var regex = /^[0-9\.]+$/;
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                
            }
 
            return isValid;
        });




    });

    </script>

   <!--  <script>

        $(document).ready(function(){
          var tasks= new Array();
               $('#subhr').change(function () {

                
              
              tasks.push($(this).val());
              
                
              console.log(tasks);

              

      });
        });
    </script> -->


 <!-- <script>
  function submit(){


  }
 </script> -->

    @endsection
