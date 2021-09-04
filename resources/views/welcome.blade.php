@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form') }}</div>

                <div class="card-body">
                     @if($message = Session::get('success'))
                   <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong>{{ $message }}</strong>
                   </div>
                   @endif
                    <form method="POST" action="{{ route('submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="workdays" class="col-md-4 col-form-label text-md-right">{{ __('No of Working days') }}</label>

                            <div class="col-md-6">
                                <input id="workdays" type="text" class="form-control @error('workdays') is-invalid @enderror" name="workdays" value="{{ old('workdays') }}" required autocomplete="email" autofocus>

                                @error('workdays')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hrworkdays" class="col-md-4 col-form-label text-md-right">{{ __('No of working hours per day') }}</label>

                            <div class="col-md-6">
                                <input id="hrworkdays" type="text" class="form-control @error('hrworkdays') is-invalid @enderror" name="hrworkdays" value="{{ old('hrworkdays') }}" required autocomplete="hrworkdays" autofocus maxlength="10">

                                @error('hrworkdays')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totsub" class="col-md-4 col-form-label text-md-right">{{ __('Total Subjects:') }}</label>

                            <div class="col-md-6">
                                <input id="totsub" type="text" class="form-control @error('totsub') is-invalid @enderror" name="totsub" value="{{ old('totsub') }}" required autocomplete="totsub" autofocus>

                                @error('totsub')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                         <div class="form-group row">
                            <label for="perdaysub" class="col-md-4 col-form-label text-md-right">{{ __(' No of subjects per day') }}</label>

                            <div class="col-md-6">
                                <input id="perdaysub" type="text" class="form-control @error('perdaysub') is-invalid @enderror" name="perdaysub" value="{{ old('perdaysub') }}" required autocomplete="perdaysub" autofocus>

                                @error('perdaysub')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             
                        </div>
                         <div class="form-group row">
                            <label for="perdaysub" class="col-md-4 col-form-label text-md-right">{{ __('Total hours for week') }}</label>

                            <div class="col-md-6">
                                <input id="total" type="text" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ old('total') }}" readonly="">

                               
                            </div>
                             
                        </div>

                        

                       

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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

    <script>

        $(document).ready(function(){
               $('#workdays,#hrworkdays').change(function () {

              var str1=$('#workdays').val();
              if(str1.length==0)
                  str1="0";
              var str2=$('#hrworkdays').val();
              if(str2.length==0)
                  str2="0";

              var res1 = str1;
              var res2 = str2;

              var res3="0";

              res3=res1*res2;

              if(Number.isNaN(res3)==true)
                  res3=$('#workdays').val();

              $('#total').val(res3);


              

      });
        });
    </script>
    @endsection
