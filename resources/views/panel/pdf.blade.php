<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Angelic</title>
    
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
		     font-size:15px;
        line-height:15px;
        color:#333;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
		font-size:15px;
        line-height:15px;
		text-align:center;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
      <div class="title"><center> ANGELIC <br>
                             <small> DIAMONDS </small>
                         </center> </div>
                              <div>
                              <center>Quote Form</center>
                              </div>
                              <br><br>
        <table cellpadding="0" cellspacing="0">            
            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>
                             Date:{{date('d-m-Y H:i',strtotime($quote->created_at))}}<br> <br>
                            {{$quote->customer->first_name}} {{$quote->customer->last_name}}<br>
                               {{@$quote->customer->currentbilling->address}} {{@$quote->customer->currentbilling->address1}}<br>
                               {{@$quote->customer->currentbilling->city}}<br>
                                {{@$quote->customer->currentbilling->postcode}}<br><br><br>
                                {{$quote->customer->phone}}
                            </td>
                            
                            <td>
                                {{$quote->quote_id}}<br>
                                {{$quote->customer->email}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
           
            <tr class="item">
                <td>
                   Code
                </td>
                <td>
                    Description
                </td>
                <td>
                    Price
                </td>
            </tr>
            @php $sum=[] @endphp
           @foreach($quote->quoteitems as $result)
            <tr class="item">
                <td>
                  {{$result->item_code}}
                </td>
               
                <td>
                 {{$result->description}}<br>
               Ring Size : @if($result->ring=='na') NA @else{{App\models\Ringsize::where('id',$result->ring)->value('ring_size_label')}} @endif<br>
                Metal : {{App\models\Metals::where('id',$result->metal)->value('metal_label')}}
                </td>
                <td>
                  {{$sum[]=$result->total}}
                </td>
            </tr>            
            @endforeach
            <tr class="total">
                <td> </td>
               <td> </td>
                <td>
                 Total(Including VAT) - {{array_sum($sum)}}
                </td>
            </tr>
            <tr class="item">
                <td>
                 <u>Additional Notes</u> {{@$result->customer_note}}<br><br><br><br>
                </td>
                <td> </td>
               <td> </td>
            </tr>
        </table>
            <table>  <tr class="item"><td>All Diamonds supplied by Angelic Diamonds</td></tr></table>

    </div>

</body>

</html>