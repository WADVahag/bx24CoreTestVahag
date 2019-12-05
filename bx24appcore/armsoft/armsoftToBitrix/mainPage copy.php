<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MainPage</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<style>
.loader{
    width:100%;
    height:100%;
    display:none;
    transition:0.4s;
}

.lds-roller {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
  left:47vw;
  top:15vw;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 40px 40px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
 background-color: #25af36;
  margin: -4px 0 0 -4px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s;
}
.lds-roller div:nth-child(1):after {
  top: 63px;
  left: 63px;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 68px;
  left: 56px;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 71px;
  left: 48px;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 72px;
  left: 40px;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 71px;
  left: 32px;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 68px;
  left: 24px;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 63px;
  left: 17px;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 56px;
  left: 12px;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
.loading{
    color: #25af36;
    position:relative;
   
    top:13vw;
    text-align: center;
}

.btnContainer{
    margin:15vw auto;
    width: 50vw;
  
    
}
.btn{
  
  display: inline-block;
  text-align: center;
  cursor: pointer;
  user-select: none;
  background-color: #25af36;
  border: 1px solid transparent;
  box-shadow: 0 4px 10px rgba(37, 175, 54, .25);
  color: #fff;
  padding: .641rem 1rem;
  font-size: 1.063rem;
  line-height: 1.5;
  border-radius: .375rem;
  outline: none;
  margin-left: 5vw;
}

.btn:hover{
  box-shadow: none;
}
</style>
<body>

<div class="btnContainer"> 
    <button type="button" class="btn" id='syncProducts' onclick="sync.syncProducts()">Սինխրոնիզացնել Ապրանքները</button>
    <button type="button" class="btn" id='syncPartners' onclick="sync.syncPartners()">Սինխրոնիզացնել Գործնկերներին</button><br>
</div>
<div class="loader"> 
<h1 class='loading'> Սինխրոնիզացում</h1>
<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>
<script>
var sync = {

    syncPartners: function() {

        // $('#syncPartners').html('<div class="loaders">Loading...</div>');
        $('.btnContainer').toggle(225);
        $('.loader').toggle(400);
        // $('#syncPartners').prop('disabled', true);
        $.ajax({
            url: 'syncPartners.php',
            type: "POST",
            processData: false,
            contentType: false,
            success: function(result) {
                if(result){
                $('.loader').toggle(225);
                $('.btnContainer').toggle(400);
                // $('#syncPartners').prop('disabled', false);
              
                console.log(result);
              }else{
              alert('noAnswer')
            }
            },
            error: function(result){
                $('.loading').html('ERROR');
                $('.loader').toggle(225);
                $('.btnContainer').toggle(400);
                // $('#syncPartners').prop('disabled', true);
            }
        });
    },

    syncProducts: function() {

    // $('#syncPartners').html('<div class="loaders">Loading...</div>');
    $('.btnContainer').toggle(225);
    $('.loader').toggle(400);
    // $('#syncProducts').prop('disabled', true);
    $.ajax({
        url: 'syncProducts.php',
        type: "POST",
        processData: false,
        contentType: false,
        success: function(result) {
            if(result){
            $('.loader').toggle(225);
            $('.btnContainer').toggle(400);
            // $('#syncProducts').prop('disabled', false);
            console.log(result);
            }else{
              alert('noAnswer')
            }
        },
        error: function(result){
            $('.loading').html('ERROR');
            $('.loader').toggle(225);
            $('.btnContainer').toggle(400);
            // $('#syncProducts').prop('disabled', true);
        }
    });
    }

}
</script>
</body>
</html>