<?php
$path=realpath(__DIR__);
$filepath=$path."/denyaccesstocceandsubadmin.php";
require_once $filepath;

?>

<ul class="nav navbar-nav">
       <!-- <li class="dropdown mega-dropdown">
          <a href="<?php echo $urlofwp; ?>destinations" class="dropdown-toggle" data-toggle="dropdown">DESTINATIONS<i class="fa fa-sort-desc sukh" aria-hidden="true"></i></a>

          <ul class="dropdown-menu mega-dropdown-menu row">
           
		    Destinations Begin 
            <li class="col-sm-2">
              <ul>
                <li class="dropdown-header"><a href="<?php echo $urlofwp; ?>continent-europe" >Europe</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-amsterdam">Amsterdam</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-berlin">Berlin</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-hallstatt/">Hallstatt</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-lille/">Lille,France</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-london">London</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-sicily">Sicily,Italy</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-cinque-terre">Cinque Terre,Italy</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-rome">Rome</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-greek-island">The Greek Islands</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-budapest">Budapest</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-prague">Prague</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-cartagena">Cartagena</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-italy">Italy</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-noumea">Noumea</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-athens">Athens</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-barcelona">Barcelona</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-burges">Burges</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-copenhagen">Copenhagen</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-dublin">Dublin</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-edinburgh">Edinburgh</a></li>
			    <li><a href="<?php echo $urlofwp; ?>destination-florence">Florence</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-helsinki">Helsinki</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-madrid">Madrid</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-moscow">Moscow</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-munich">Munich</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-newcastle">New Castle</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-paris">Paris</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-reykjavik">Reykjavik</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-saint-petersburg">Saint Petersburg</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-seville">Seville</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-stockholm">Stockholm</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-venice">Venice</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-vienna">Vienna</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-zurich">Zurich</a></li>
			  </ul>
            </li>
            <li class="col-sm-2">
              <ul>
                <li class="dropdown-header"><a href="<?php echo $urlofwp; ?>continent-africa">Africa</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-port-elizabeth">Port Elizabeth</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-livingstone-island">Livingstone Islands</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-pyramids-of-giza">Pyramids of Giza</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-mombasa">Monbasa</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-casablanca">Casablanca</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-alexandria">Alexandria</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-okavango-delta">Okavango Delta</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-capetown">Cape Town</a></li>

              </ul>
            </li>
            <li class="col-sm-2">
              <ul>
                <li class="dropdown-header"><a href="<?php echo $urlofwp; ?>continent-asia">Asia</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-andaman-islands">Andaman Islands</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-mie-prefecture-2">Mie Prefecture</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-taipei-taiwan">Taipei Taiwan</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-hangzhou">Hangzhou,China</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-dubai">Dubai</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-tokyo">Tokoyo</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-hongkong">Hong Kong</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-shanghai">Shanghai</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-beijing">Beijing </a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-seoul">Seoul</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-kuala-lumpur">Kuala Lumpur</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-siberia">Siberia </a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-new-delhi">New Delhi</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-bangkok">Bangkok</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-bengaluru">Bengaluru</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-chennai">Chennai</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-chengdu">Chengdu</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-hanoi">Hanoi</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-ho-chi-minh-city">Ho Chi Minh City</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-istanbul">Instanbul</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-jakarta">Jakarta</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-kathmandu">Kathmandu</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-kuala-lumpur">Kuala Lumpur</a></li>

			  
			  </ul>
            </li>
       <li class="col-sm-2">
              <ul>
                <li class="dropdown-header"><a href="<?php echo $urlofwp; ?>continent-south-america">South America</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-chiloe">Chiloe,Chile</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-santiago">Santiago,Chile</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-rio-de-janeiro">Rio De Janeiro </a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-mar-del-plata">Mar Del Plata</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-lake-titicaca">Lake Titicaca</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-peru">Peru</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-venezuela">Venezuela</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-argentina">Argentina</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-belo-horizonte">Belo Horizonte</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-bogota">Bogota</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-buenos-aires">Buenos Aires</a></li>
			    <li><a href="<?php echo $urlofwp; ?>destination-cali">Cali</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-caracas">Caracas</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-cusco">Cusco</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-florianopolis">Florianopolis</a></li>
				
				
				
			  </ul>
            </li>
       <li class="col-sm-2">
              <ul>
                <li class="dropdown-header"><a href="<?php echo $urlofwp; ?>continent-north-america">North America</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-san-antonio">San Antonio</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-alcatraz">Alcatraz</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-volcan-paricutin">Volcan Paricutin</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-aspen">Aspen</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-fork-valley">Fork Valley</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-los-angeles">Los Angeles</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-florida">Florida </a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-newyork">New York</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-hearst-san-simeon">Hearst San Simeon</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-cuba">Cuba </a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-bishop-museum">Bishop Museum</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-dallas">Dallas</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-philadelphia">Philadelphia</a></li>
			    <li><a href="<?php echo $urlofwp; ?>destination-mexico-city">Mexico City</a></li>
			  </ul>
            </li>
       <li class="col-sm-2">
              <ul>
                <li class="dropdown-header"><a href="<?php echo $urlofwp; ?>continent-oceania">Oceania</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-tasmania">Tasmania</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-kangaroo-islands">Kangaroo Islands</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-fraser-island">Fraser Islands </a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-fiji">Fiji</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-adelaide">Adelaide,Australia</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-sydney">Sydney,Australia </a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-perth">Perth,Australia</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-brisbane">Brisbane,Australia</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-melbourne">Melbourne,Australia </a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-darwin">Darwin,Australia</a></li>
                <li><a href="<?php echo $urlofwp; ?>destination-polynesia">Polynesia</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-canberra">Canberra,Australia</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-auckland">Auckland</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-cairns">Cairns</a></li>
			    <li><a href="<?php echo $urlofwp; ?>destination-christchurch">Christ Church</a></li>
			    <li><a href="<?php echo $urlofwp; ?>destination-dunedin">Dunedin</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-gold-coast">Gold Coast</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-hobart">Hobart,Australia</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-nadi">Nadi</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-nuku-alofa">Nuku Alofa</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-port-moresby">Port Moresby</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-port-villa">Port Villa</a></li>
			    <li><a href="<?php echo $urlofwp; ?>destination-queenstown">Queens Town</a></li>
			    <li><a href="<?php echo $urlofwp; ?>destination-suva">Suva</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-tauranga">Tauranga</a></li>
				<li><a href="<?php echo $urlofwp; ?>destination-toowoomba">Toowoomba</a></li>
			    <li><a href="<?php echo $urlofwp; ?>destination-townsville">Townsville</a></li>
			  
			  
			  </ul>
            </li>
      </ul>
    </li>-->
	<!-- Destinations End -->
                                
                                <li ><a href="<?php echo $urlofwp; ?>">FLIGHTS</a> </li>
                                <li><a href="<?php echo $urlofwp; ?>">HOTELS</a> </li>
                                <!--<li><a href="<?php echo $urlofwp; ?>insurance/">INSURANCE</a></li>-->
                                <li><a href="<?php echo $urlofwp; ?>">CARS</a></li>
                                <!-- diff menu start -->
                                <li class="dropdown mega-dropdown">
                                  <a href="<?php echo $urlofwp; ?>destinations" class="dropdown-toggle" data-toggle="dropdown">TRAVEL INFO<i class="fa fa-sort-desc sukh" aria-hidden="true"></i></a>
                                    <ul class="dropdown-menu mega-dropdown-menu row">
                                        <li><a href="<?php echo $urlofwp; ?>">CHECK BOOKING INFO</a></li>
                                        <li><a href="<?php echo $urlofwp; ?>onlinecheckin/">ONLINE CHECK-IN</a></li>
                                        <li><a href="<?php echo $urlofwp; ?>popularroutes">POPULAR ROUTES</a></li>
                                    </ul>
                                </li>     
                                <!--diff menu ends -->
                               
                                <li><a href="<?php echo $urlofwp; ?>aboutus/">ABOUT US</a> </li>
                                
                                <li><a href="<?php echo $urlofwp; ?>contacts/">CONTACT US</a></li>
    
    </ul>


