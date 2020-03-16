<style type="text/css" media="print">
    @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

    body
    {
        border: solid 1px blue ;
        margin: 4mm 130mm 40mm 4mm; /* margin you want for the content */
    }
    </style>
    <body>
<div id="printableArea">
<?php 
$result=$_GET['qr_code_no'];
echo QrCode::size(280)->generate("$result");
?>
<br>
<!-- <label style="margin-left: 6%;">In Time Delivery </label> -->
</div>
</body>
<input type="button" onclick="printDiv('printableArea')" value="print!" />
<script type="text/javascript">
	
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;
     window.print();

     document.body.innerHTML = originalContents;
     var curURL = window.location.href;
history.replaceState(history.state, '', '/');
window.print();
history.replaceState(history.state, '', curURL);
}
</script>