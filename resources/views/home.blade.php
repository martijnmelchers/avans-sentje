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

                    {{ __('home.welcome_message') }}
                    <br>

                    <h2>{{__('home.my_planned_payments')}}</h2>

                    <form method="POST" action="/gepland/opslaan">
                    @csrf

                    <input style="display: none;" type="text" id="gepland">
                    <br>


                    <h3>{{__('home.planned_payments')}}</h3>
                    <div id="dateList"></div>

                    <button type="submit" class="btn btn-primary">{{__('home.save')}}</a>

                    </form>                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function(){
    
        var defaultDates = [];
        var selectedDates = [];
        var messages = [];

        var firstDay = 1;
        var recurringDates = [];


        
        $.ajax({
            url: '/gepland',
            method: 'get',
            success:function(data){
                var dates = JSON.parse(data);

                console.log(dates);
                for(var i = 0; i < dates.length; i ++){

                    if(dates[i].recurring == "1"){
                        for(var j = 1; j < 13; j++){
                            var plannedDate = new Date(dates[i].planned);
                            plannedDate.setDate(plannedDate.getDate() + (j * 30));
                            defaultDates.push(plannedDate);

                            if(j > 0){
                                recurringDates.push(plannedDate.toISOString().split('T')[0]);
                            }
                        }
                    }
                 
                    defaultDates.push(dates[i].planned);
                    messages[dates[i].planned] = dates[i];
                }

            flatpickr("#gepland", {
                mode: "multiple",
                dateFormat: "Y-m-d",
                inline: true,
                minDate: "today",
                defaultDate: defaultDates,
                locale: {
                    firstDayOfWeek: firstDay,
                },
                onChange: function(selectedDates, dateStr, instance){
                    showMessagePrompt(selectedDates, dateStr);
                },
                onReady: function(selectedDates,dateStr, instance){
                    showMessagePrompt(selectedDates, dateStr);
                    console.log(selectedDates);
                }
            });
            },
        })

        

       function showMessagePrompt(selectedDates, dateStr){
            dateStr = dateStr.replace(/ /g, "");
            readable = dateStr.split(',');

            $("#dateList").html("");

            console.log(messages);
            for(var i = 0; i < readable.length; i ++){
                var date = selectedDates[i];
            
                if(typeof messages[readable[i]] !== 'undefined'){
                    var checked = "";
                    
                    if( messages[readable[i]].recurring == "1"){
                        checked = "checked";
                    }

                    $("#dateList").append(`
                    <div class='row'> 
                        <div class='col-md-4'>
                            <label>` +readable[i] + `</label>
                            <input required class='form-control' value='`+ messages[readable[i]].message +`' name='messages[` + readable[i] + `][message]' type='text'></input>
                        </div>
                        <div class='col-md-4'>
                            <label>{{__('home.planned_amount')}}</label>
                            <input class='form-control' required name='messages[` + readable[i] + `][amount]' type="number" min="1" value='`+ messages[readable[i]].amount +`' step="any">
                        </div>
                        <div class='col-md-4'><label>{{__('home.recurring_payments')}}</label>
                            <input ` + checked + ` name='messages[` + readable[i] + `][recurring]' value="1" class ='form-control'type='checkbox'></div>
                        </div>`
                    );
                }

                else{
                    

                    if(recurringDates.indexOf(readable[i]) !== -1){
                        continue;
                    }

                    $("#dateList").append(`
                    <div class='row'> 
                        <div class='col-md-4'>
                            <label>` +readable[i] + `</label>
                            <input required class='form-control' name='messages[` + readable[i] + `][message]' type='text'></input>
                        </div>
                        <div class='col-md-4'>
                            <label>Amount</label>
                            <input required name='messages[` + readable[i] + `][amount]' class ='form-control' type="number" min="1" step="any">
                        </div>
                        <div class='col-md-4'><label>Recurring</label>
                            <input  name='messages[` + readable[i] + `][recurring]' value="1"  class ='form-control'type='checkbox'></div>
                        </div>`
                    );
                }
            }
       }

       
       function create_recurring(){

       }
    });
</script>
@stop