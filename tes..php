<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styletes.css">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <link rel="stylesheet" type="text/css" href="OwlCarousel2-2.3.4/dist/assets/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js" ></script>
    <title>Document</title>

    <style>

    .burger-container {
      margin: 0 auto;
    }
    
    .box-burger{
      width: 50px;
      height: 50px;
      border: 3px solid black;
  margin: auto;
 padding: 5px 0;
    }

    .line1, .line2, .line3 {
      width: 90%;
      border: 3px solid black;
      border-radius: 5px;
      margin: 4px auto;
      transition: 0.2s;
    }

    .box-burger:hover .line2 {

      transform: matrix(1,2,-1,1,5,4);

    }

    .box-burger:hover .line1 {
      transform: rotate(45deg);
     
    }

    .box-burger:hover .line3 {
      transform: rotate(-45deg);
      
    }
    </style>
   
</head>
<body>

<div id="owl-example" class="owl-carousel">
  <div class="owl-slide">
		<div class="owl--text">
		This is a full height Owl slider. There is nothing else interesting here!</div>
	</div>
  <div class="owl-slide">
		<div class="owl--text">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit!</div>
	</div>
  <div class="owl-slide">
		<div class="owl--text">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam excepturi voluptate eveniet consectetur numquam laboriosam.
		</div>
	</div>
</div>





  <div class="burger-container">
    <div class="box-burger">
      <div class="line1"></div>
      <div class="line2"></div>
      <div class="line3"></div>
    </div>
  
  </div>





<div class="sch-container">
        <div class="search-box">
            <input type="text" class="search-txt" name="" placeholder="Type To Search">
            <a href="#" class="search-btn"> <i class="fas fa-search"></i>   </a>
            
        </div>
        </div>

        <div class="wadidaw">
        <input type="text" name="" placeholder="Type To Search">     
        <a href="#" class="sch-waw"> <i class="fas fa-search"></i>   </a>
            
        </div>


    <div class="tes-container">
    
    <img src="img/karosel1.jpg" alt="">
    
    </div>

   
        </div>


        <div class="nyobaan">
                bismilah
        <div class="nyobaan2">
            <ul>
                <li>abc</li>
                <li>bcdiv</li>
                <li>asaffa</li>
                <li>abc</li>
                <li>bcdiv</li>
                <li>asaffa</li>
            </ul>
        </div>



        </div>
<br><br><br><br><br><br><br><br><br><br><br><br>

    <div class="satsat">
      <img src="img/sch4.jpg" alt="">


    </div>

    <div class="tes-flex">
        <div class="item-flex"> <h3 class="judul-info">THE DESPERATE PROJECT</h3><br>
                <a class="cobain" href="#"><p>About Us</p> </a>
                <a class="cobain" href="#"><p>Contact</p> </a>
                <a class="cobain" href="#"><p>Store Locations</p> </a></div>
        <div class="item-flex"> <h3 class="judul-info">THE DESPERATE PROJECT</h3><br>
                <a class="cobain" href="#"><p>About Us</p> </a>
                <a class="cobain" href="#"><p>Contact</p> </a>
                <a class="cobain" href="#"><p>Store Locations</p> </a></div>
        <div class="item-flex"> <h3 class="judul-info">THE DESPERATE PROJECT</h3><br>
                <a class="cobain" href="#"><p>About Us</p> </a>
                <a class="cobain" href="#"><p>Contact</p> </a>
                <a class="cobain" href="#"><p>Store Locations</p> </a></div>
        <div class="item-flex"> <h3 class="judul-info">THE DESPERATE PROJECT</h3><br>
                <a class="cobain" href="#"><p>About Us</p> </a>
                <a class="cobain" href="#"><p>Contact</p> </a>
                <a class="cobain" href="#"><p>Store Locations</p> </a></div>
    </div>


    <ul class="flex-container nowrap">
  <li class="flex-item">1</li>
  <li class="flex-item">2</li>
  <li class="flex-item">3</li>
  <li class="flex-item">4</li>
  <li class="flex-item">5</li>
  <li class="flex-item">6</li>
  <li class="flex-item">7</li>
  <li class="flex-item">8</li>
</ul>

<ul class="flex-container wrap">
  <li class="flex-item">sat</li>
  <li class="flex-item">2</li>
  <li class="flex-item">3</li>
  <li class="flex-item">4</li>
  <li class="flex-item">5</li>
  <li class="flex-item">6</li>
  <li class="flex-item">7</li>
  <li class="flex-item">8</li>
</ul>

<ul class="flex-container wrap-reverse">
  <li class="flex-item">1</li>
  <li class="flex-item">2</li>
  <li class="flex-item">3</li>
  <li class="flex-item">4</li>
  <li class="flex-item">5</li>
  <li class="flex-item">6</li>
  <li class="flex-item">7</li>
  <li class="flex-item">8</li>
</ul>


<script src="OwlCarousel2-2.3.4/docs/assets/vendors/jquery.min.js" type="text/javascript"></script>
    <script src="OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript"></script>
<script>
  $(document).ready(function() {
 
 $("#owl-example").owlCarousel({
   navigation : true, 
     slideSpeed : 300,
     paginationSpeed : 400,
     singleItem: true,
     pagination: false,
     rewindSpeed: 500
 });

});
</script>


</body>
</html>