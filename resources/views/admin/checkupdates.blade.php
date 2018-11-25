@extends('layouts.admin')

@section('content')
    <form id='content' method='post' name="updates">
        @csrf
        <div class="se-pre-con"></div>
    </form>
@endsection

@section('scripts')
    <script src="//cdn.steemjs.com/lib/latest/steem.min.js"></script>

    <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js">
    	define(['require'], function (require) {
		    var steem = require('steem');
		});
    </script>

    <script type="text/javascript">
        var user = 'capybaraexchange';
        var limit = 100;

        steem.api.getAccountHistory(user, -1, limit, (err, result) => {
            let transfers = result.filter(tx => tx[1].op[0] === 'transfer');
            
            var j = 1;
            for (var i = transfers.length - 1; i >= 0; i--) {
                var curr = transfers[i][1];
                var op = curr['op'][1];
                var timestamp = curr['timestamp'];

                if (op['from'] != user)
                    insert(op, j++, timestamp);
            }
            if (err)
                console.log("ERROR");
            else {
                // $(".se-pre-con").fadeOut("slow");;
                document.updates.submit();
            }
        });
        
        function insert(op, i, timestamp) {
            var toinsert = 
                "<div class='data'>" +
                    "<label>" + i + "</label>" +
                    "<div class='user-data row'>" +
                        "<div class='col-md-3'>" +
                            "<input type='text' class='form-control' name='from[]' value='" + op['from'] + "'>" +
                        "</div>" +
                        "<div class='col-md-3'>" +
                            "<input type='text' class='form-control' name='to[]' value='" + op['to'] + "'>" +
                        "</div>" +
                        "<div class='col-md-2'>" +
                            "<input type='text' class='form-control' name='amount[]' value='" + op['amount'] + "'>" +
                        "</div>" +
                        "<div class='col-md-2'>" +
                            "<input type='text' class='form-control' name='memo[]' value='" + op['memo'] + "'>" +
                        "</div>" +
                        "<div class='col-md-2'>" +
                            "<input type='text' class='form-control' name='timestamp[]' value='" + timestamp + "'>" +
                        "</div>" +
                    "</div>" +
                "</div>";
            $("#content").append(toinsert);
        }
    </script>
@endsection