@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <!-- flash message     -->
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} 
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
                @endforeach
            </div> 
            <!-- end .flash-message -->

                    <!-- <button type="button" class="btn btn-primary">withdraw</button>
                    <button type="button" class="btn btn-primary">Balance</button>
                    <button type="button" class="btn btn-primary">Deposit</button> -->

    <!-- Button trigger Balance modal -->

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#checkBalance" data-whatever="@balance">Check Balance</button>

    <!-- Start Balance Modal -->

    <div class="modal fade" id="checkBalance" tabindex="-1" role="dialog" aria-labelledby="checkBalanceLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkBalanceLabel">Your Balance is</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                
                <table class="table table-striped" class="table-responsive" class="table table-sm" border = 2 style="margin: 0px auto;">
         <tr style="text-align:center">
         <thead class="thead-dark">

            <td>Balance</td>
         </tr>
         <tr>
            <td>{{ $deposits}}</td>
         </tr>
      </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
            </div>
        </div>
        </div>

        <!-- End Balance Modal -->

     <!-- Button trigger withdraw modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#withdraw" data-whatever="@withdraw">Withdraw</button>
    <!-- Start Withdraw Modal -->

    <div class="modal fade" id="withdraw" tabindex="-1" role="dialog" aria-labelledby="withdrawLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="withdrawLabel">Withdraw Cash</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body"> -->
                <!-- <form>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Enter Amount:</label>
                    <input type="text" class="form-control" name="recipient-name">
                </div>
                
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Ok</button>
            </div> -->

            <div class= "jumbotron custom-form-width-wrapper">
            {!! Form::open(['url' => 'home/withdraw']) !!}
            <div class="form-group {{ $errors->has('deposit') ? 'has-error' : '' }}">
            {{Form::label('Withdraw', 'Withdraw')}}<br>
            <span class="text-danger">{{ $errors->first('withdraw') }}</span>
            {{Form::number('withdraw', '', ['class' => 'form-control', 'placeholder' => 'Enter Amount','required'])}}
            
            </div>
            <div style = "float:right; clearfix: both;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            {{Form::submit('Ok', ['class' => 'btn btn-primary'])}}
            
        </div>
        {!! Form::close() !!}

        </div>
            


            </div>
        </div>
        </div>

        
    <!-- End Withdraw Modal -->

     <!-- Button trigger deposit modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deposit"  data-whatever="@deposit">Deposit</button>

        <!-- Start deposit Modal -->

        <div class="modal fade" id="deposit" tabindex="-1" role="dialog" aria-labelledby="depositLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="depositLabel">Deposit Cash</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <form  method="POST"> -->

                <!-- {{csrf_field() }}   -->
                <!-- security token -->
                <!-- <div class="form-group">
                    <label >Enter Amount:</label>
                    <input type="number" class="form-control" name="deposit" placeholder="Enter Amount to Deposit:">
                </div> -->

                <!-- collective form -->

            <div class= "jumbotron custom-form-width-wrapper">
            {!! Form::open(['url' => 'home/submit']) !!}
            <div class="form-group {{ $errors->has('deposit') ? 'has-error' : '' }}">
            {{Form::label('Deposit', 'Deposit')}}<br>
            <span class="text-danger">{{ $errors->first('deposit') }}</span>
            {{Form::number('deposit', '', ['class' => 'form-control', 'placeholder' => 'Enter Amount','required'])}}
            
            </div>
            <div style = "float:right; clearfix: both;">
            {{Form::submit('Send', ['class' => 'btn btn-primary'])}}
            
        </div>
        {!! Form::close() !!}

        </div>
                
                
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Send</button>
            </div> -->
            <!-- </form> -->
            </div>
        </div>
        </div>
        <!-- End deposit Modal -->

         <!-- Button trigger Send Money modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cash" data-whatever="@cash">Transfer Money</button>
    <!-- Start Send Money Modal -->

    <div class="modal fade" id="cash" tabindex="-1" role="dialog" aria-labelledby="cashLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cashLabel">Transfer Money</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class= "jumbotron custom-form-width-wrapper">
            {!! Form::open(['url' => 'home/cash']) !!}
            <div class="form-group {{ $errors->has('deposit') ? 'has-error' : '' }}">
            {{Form::label('Phone Number', 'Phone Number')}}<br>
            <span class="text-danger">{{ $errors->first('pNumber') }}</span>
            {{Form::number('pNumber', '', ['class' => 'form-control', 'placeholder' => 'Enter Phone Number','required'])}}
            </div>

            <div class="form-group {{ $errors->has('deposit') ? 'has-error' : '' }}">
            {{Form::label('Amount', 'Amount')}}<br>
            <span class="text-danger">{{ $errors->first('amount') }}</span>
            {{Form::number('amount', '', ['class' => 'form-control', 'placeholder' => 'Enter Amount','required'])}}
            </div>
            
            <div style = "float:right; clearfix: both;">
            {{Form::submit('Send', ['class' => 'btn btn-primary'])}}
            
        </div>
        {!! Form::close() !!}

        </div>




            </div>
        </div>
        </div>
        <!-- End Send Money Modal -->
        

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
