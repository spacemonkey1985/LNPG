<?php

	session_start();
	
	include('connect/db_connection.php');		
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<title>Landlords National Property Group</title>
<link type="text/css" href="stylesheets/common.css" rel="stylesheet" />

</head>

<body>

	<!-- Logo and Login -->
    
    <div class="header">
    	<div class="header-content">
        
        	<a href="#"><img src="images/logo.png" alt="LNPG Logo" class="logo" /></a>
            
            <?php include('includes/login-form.php'); ?>
            
            <p class="logo-tag-line">The UK's largest discount club for landlords</p>
                
        </div>
    </div>
    
    <!-- End Logo and Login -->
    
    <!-- Menu -->
    
    <div class="menu-bar">
    	<div class="menu-bar-bg"></div>
    	<div class="menu-bar-content">
        
        	<div class="menu">
            	<?php include('includes/menu.php'); ?>
            </div>
                
        </div>
    </div>
    
    <!-- End Menu -->
    
    <!-- Title banner -->
    
    <div class="title-banner">
    	<div class="title-banner-content">

			<img src="images/about-title.png" alt="About us" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
        	
        	<div style="position: relative; float: left; width: 500px; margin-top: 20px;">
            
            	<img src="images/about-us-tag-line.png" alt="The Landlords National Property Group (LNPG Limited) brings a unique and brand new concept to the property investment industry" />
            
            <p style="font-size: 12px;">
                Landlords and property investors spend a great deal of time and effort sourcing and negotiating the best BMV deals on investment properties for rental. 
                <br /><br />
                Many of these very same investors also spend a great deal of time, effort and money researching and buying supplies when refurbishing investment properties. To date this has been acceptable practice – but this now no longer needs to be the case. 
                <br /><br />
                Property investors will be excited to discover that LNPG has solved the refurbishment problem by offering massively discounted products, materials and supplies to member landlords through selected, nationally recognised organisations. 
                <br /><br />
                In addition to the discounts scheme, LNPG provides opportunities for residential property investment, a property lettings service and over the coming months, training and education programmes. 
                <br /><br />
                LNPG is currently formulating a Charitable Trust that will oversee a mentoring programme for young unemployed people. It will be created for landlords who can offer trade apprenticeships within the property refurbishment environment. 
                <br /><br />
                We are constantly looking to augment our group with reputable organisations who share a similar philosophy to ours.
			</p>
            
            <br />
            <br />
            
            	<div style="background-color: #1b2e3d; height: 550px;">
                	<img src="images/wade-lyn-2.png" alt="LNPG achieves its massive buying power by working together as a group, rather than individuals." style="margin-top: -65px;" />
                    <p style="font-size: 14px; color: #ffffff; padding-left: 20px; padding-right: 20px; padding-bottom: 20px; padding-top: 10px;">
                    	Collectively LNPG has the strength to improve the way landlords purchase and therefore upgrade poor living accommodation and have a positive impact on local communities. I encourage all residential landlords to become members of LNPG.
                    </p>
                    
                   	<iframe width="480" height="274" src="https://www.youtube.com/embed/LgxxrrH3oJk" frameborder="0" allowfullscreen style="margin-left: 10px;"></iframe>
                    
                </div>

            </div>
            
            <div style="position: relative; float: right; width: 440px; margin-top: 20px; margin-left: 20px;">
            	
                <div style="position: relative; float: left; width: 215px; margin-top: 20px;">
                	<img src="images/nick_avatar.png" alt="Avatar" style="margin-bottom: 15px;" />
                    
                    <div style="font-size: 16px; color: #1b75bc;">Nick Watchorn</div>

                    <p style="font-size: 12px;">For 21 of the 28 years Nick has worked in the financial services he ran his own financial services company with David Arundale. The business was responsible for millions of pounds of investors' money. This gave Nick a solid foundation on which to start his property investment journey.
                    <br /><br />
                    Nick has grown his portfolio to 46 properties. He refurbishes these properties with his own team, giving him a unique insight to the needs of the landlord in the quality refurbishment of properties.
                    <br /><br />
                    The notion that, when individuals work together towards a common goal, things can be achieved much faster with greater benefit to all became ever clearer. 
                    <br /><br />
                    The Landlords National Property Group is the culmination of this philosophy where, as a growing, commited group of landlords, we can drive change by reducing costs, improving accommodation and help to grow and unite communities.<p>

                </div>
                
                <div style="position: relative; float: right; width: 215px; margin-top: 20px; margin-left: 10px;">
                	<img src="images/peter_avatar.png" alt="Avatar" style="margin-bottom: 15px;" />
                    
                    <div style="font-size: 16px; color: #1b75bc;">Peter Francis</div>

                    <p style="font-size: 12px;">Peter is an author and international public speaker. His background in design and marketing is a perfect fit for the requirements of LNPG. Since 1990, Peter has spoken on conference platforms around the world and has developed and delivered training programmes to 1000s of attendees.
                    <br /><br /> 
                    Having owned and refurbished many properties over the years, he started investing with Nick in the East Midlands. Peter found many common values aligned with Nick's goals for the future of local communities and his philosophy for property investment.
                    <br /><br />
                    Peter leads the monthly LNPG property meetings in the East Midlands and is looking for opportunities to spread the word on LNPG around the country.
					</p>
                </div>
                
                <div style="position: relative; float: left; width: 215px; margin-top: 20px; clear: left;">
                	<img src="images/david_avatar.png" alt="Avatar" style="margin-bottom: 15px;" />
                    
                    <div style="font-size: 16px; color: #1b75bc;">David William Arundale, FCMA</div>

                    <p style="font-size: 12px;">David was the finance director and one of four founder members of a management team, which successfully completed an MBO back in the early 1980s. The team guided the new company to significant profitable turnover before successfully selling out in 1987. Due to his knowledge and financial acumen David was asked to stay in the role for a further two years in the role of consultant.
 					<br /><br />
Since 1990 David has acted on behalf of a number of high profile businesses as a financial consultant. He has been a "dragon's den" activist in the form of a 'personal venture capitalist' and been hands-on, leading and inspiring a variety of financial teams for many diverse businesses.
					</p>
                </div>
                
                <div style="position: relative; float: right; width: 215px; margin-top: 20px; margin-left: 10px;">
                	<img src="images/wade-avatar.png" alt="Avatar" style="margin-bottom: 15px;" />
                    
                    <div style="font-size: 16px; color: #1b75bc;">Wade Lyn, Ambassador for HRH Prince Charles</div>
                    
                    <p style="font-size: 12px;">Wades's achievements, through his organisation Cleone Foods Ltd, were recognised in 2009 with a BITC Small company of the year award, also being recognised as a national "example of excellence". This award was re-accredited in 2010 and 2011, when Wade also received personal recognition by being named as HRH Prince Charles' Special Ambassador for the West Midlands.
                    <br /><br /> 
                    His company has been recognised for its growth and achievements by several important bodies, gaining awards from: Inner City 100, Investors in People, Afro-Caribbean Business Association and National Westminster Bank.
                    <br /><br />
                    These have in turn led to wider recognition and progression for Wade Lyn. His vision and enthusiasm for generating success is now being widely recognised and utilised by other companies and organisations, including invitations to take up board level positions with other local businesses, including the Birmingham Assay Office, Greets Green Partnership and Heart of England Radio Charitable Trust. He was voted as one of the Top 100 most influential Businessmen in the West Midlands in 2009.
                    <br /><br />
                    He has been invited to advise House of Commons committees on the issues faced by SMEs and ethnic businesses. He has also participated as a speaker or in an advisory capacity for Bank of England, Advantage West Midlands, Business in the Community, The Prince's May Day Network on Climate Change, Birmingham City Council, Birmingham Chamber of Commerce and many others.
					</p>
                </div>
                
            </div>
            
        </div>
    </div>
    
    <!-- End Content -->

	<!-- Footer -->
    
    <div class="footer">
    	<div class="footer-content">
        
        </div>
    </div>
    
    <!-- End Footer -->
        
</body>
</html>