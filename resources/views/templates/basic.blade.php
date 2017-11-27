<?php
    $total = 0;
?>
<style>
    * { margin: 0; padding: 0; }
    body {
        font-family:  sans-serif;
        font-size: 14px;
    }
    #page-wrap { width: 800px; margin: 0 auto; }

    table { border-collapse: collapse; }
    table td, table th { border: 1px solid black; padding: 5px; }

    #header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif;  letter-spacing: 20px; padding: 8px 0px; }

    #address { width: 250px; height: 150px; float: left;
        line-height: 1.2; }
    #customer { overflow: hidden; }

    #logo { text-align: right; float: right; position: relative; margin-top: 25px; width: 340px; height: 100px; overflow: hidden; }
    #logo img {
        height: 100px;
    }

    #customer-title { font-size: 20px; font-weight: bold; float: left; }

    table#meta td, table#meta th {
        border: 0; }
    #meta { margin-top: 1px; width: 300px; float: right; }
    #meta td { text-align: right;  }
    #meta td.meta-head { text-align: left; background: #eee; }

    #items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
    #items th { background: #eee; }
    #items tr.item-row td { border: 0;
        border-bottom: 1px solid #ccc; vertical-align: top;
        padding: 20px 10px; }
    #items tr.item-row:last-child td {
        border-bottom-color: #000;}
    #items td.description { width: 300px; }

    #totals {
        background: #000;
        color: #fff;
        float: right;
        margin: 20px 0;
    }
    #totals .total-row {
        clear: both;
        display: block;
        padding: 10px 20px;
    }
    #totals .total-col {
        display: inline-block;
        vertical-align: middle;
    }

    #terms { text-align: center; margin: 20px 0 0 0; }
    #terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
</style>

<div id="page-wrap">

    <h1 id="header">INVOICE</h1>

    <div id="identity">
        <div id="address">
            <p>{{ $user_info['name'] }}</p>
            <p>{{ $user_info['address'] }}</p>
            <p>{{ $user_info['city'] }}, {{ $user_info['state'] }}, {{ $user_info['zip'] }}</p>
            <p>Phone: {{ $user_info['number'] }}</p>
        </div>

        <div id="logo">
            <img id="image" src="{{ $user_info['logo'] }}" alt="logo" />
        </div>
    </div>

    <div style="clear:both"></div>

    <div id="customer">
        <div id="customer-title">{{ $company_info['name'] }}</div>

        <table id="meta">
            <tr>
                <td class="meta-head">Invoice #</td>
                <td>{{ $invoice }}</td>
            </tr>
            <tr>

                <td class="meta-head">Date</td>
                <td>{{ $date }}</td>
            </tr>
            <tr>
                <td class="meta-head">Subject</td>
                <td><div class="due">{{ $invoice_subject }}</div></td>
            </tr>

        </table>
        <div style="clear:both"></div>
    </div>

    <table id="items">

        <tr>
            <th>Description</th>
            <th>Unit Cost</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>

        @foreach($invoice_details as $details)
            <?php
                $price = $details['unit_cost'] * $details['quantity'];
                $total = $total + $price;
            ?>
            <tr class="item-row">
                <td class="description">{{ $details['description'] }}</td>
                <td>${{ $details['unit_cost'] }}</td>
                <td>{{ $details['quantity'] }}</td>
                <td>${{ number_format($price,2) }}</td>
            </tr>
        @endforeach
    </table>

    <div id="totals">
        <div class="total-row">
            <div class="total-col">Total Due:</div>
            <div class="total-col"><strong>${{ number_format($total,2) }}</strong></div>
        </div>
    </div>

    <div style="clear:both"></div>

    <div id="terms">
        <h5>Terms</h5>
        <p>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</p>
    </div>

</div>