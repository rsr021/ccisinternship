<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


	
?>
<html>
<head>
<style>
	.scroll-container {
		width: 100%;
		max-height: 600px;
		overflow-y: auto;
}

    .image-wrapper {
        display: flex;
        justify-content: center;  This centers the child horizontally in the container */
        align-items: center; 
    }
	
	a{
		text-decoration:none;
	}
	.main-timeline{ font-family: 'Libre Franklin', sans-serif; }
.main-timeline:after{
    content: '';
    display: block;
    clear: both;
}
.main-timeline .timeline{
    width: calc(50% + 60px);
    padding: 20px 0 0 60px;
    margin: 0 5px 15px 0;
    float: right;
}
.main-timeline .timeline-content{
    color: #fff;
    background: #f94419;
    text-align: center;
    padding: 20px 20px 20px 160px;
    display: block;
    position: relative;
}
.main-timeline .timeline-content:hover{ text-decoration: none; }
.main-timeline .timeline-content:before{
    content: "";
    background: linear-gradient(to top left, transparent 50%, #952000 52%);
    width: 60px;
    height: 20px;
    position: absolute;
    bottom: 0;
    left: 0;
}
.main-timeline .timeline-icon{
    font-size: 35px;
    line-height: 54px;
    width: 60px;
    height: 60px;
    border: 4px solid #fff;
    border-radius: 50%;
    transform: translateY(-50%);
    position: absolute;
    left: 80px;
    top: 50%;
}
.main-timeline .timeline-year{
    background: #ff6134;
    font-size: 35px;
    font-weight: 600;
    line-height: 110px;
    width: 120px;
    height: 100%;
    position: absolute;
    top: -20px;
    left: -60px;
}
.main-timeline .title{
    font-size: 25px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 0 0 7px 0;
}
.main-timeline .description{
    font-size: 15px;
    letter-spacing: 1px;
    margin: 0;
}
.main-timeline .timeline:nth-child(even){
    padding: 20px 60px 0 0;
    float: left;
}
.main-timeline .timeline:nth-child(even) .timeline-content{ padding: 20px 160px 20px 20px; }
.main-timeline .timeline:nth-child(even) .timeline-content:before{
    transform: rotateY(180deg);
    left: auto;
    right: 0;
}
.main-timeline .timeline:nth-child(even) .timeline-year{
    right: -60px;
    left: auto;
}
.main-timeline .timeline:nth-child(even) .timeline-icon{
    left: auto;
    right: 80px;
}
.main-timeline .timeline:nth-child(4n+2) .timeline-content{ background: #1862F7; }
.main-timeline .timeline:nth-child(4n+2) .timeline-content:before{
    background: linear-gradient(to top left, transparent 50%, #012E95 52%);
}
.main-timeline .timeline:nth-child(4n+2) .timeline-year{ background: #3473FF; }
.main-timeline .timeline:nth-child(4n+3) .timeline-content{ background: #22a009; }
.main-timeline .timeline:nth-child(4n+3) .timeline-content:before{
    background: linear-gradient(to top left, transparent 50%, #123a0a 52%);
}
.main-timeline .timeline:nth-child(4n+3) .timeline-year{ background: #28b50c; }
.main-timeline .timeline:nth-child(4n+4) .timeline-content{ background: #F61945; }
.main-timeline .timeline:nth-child(4n+4) .timeline-content:before{
    background: linear-gradient(to top left, transparent 50%, #95001D 52%);
}
.main-timeline .timeline:nth-child(4n+4) .timeline-year{ background: #FE3559; }
@media screen and (max-width:990px){
    .main-timeline .timeline{ width: calc(50% + 120px); }
}
@media screen and (max-width:767px){
    .main-timeline .timeline{ width: 100%; }
}
@media screen and (max-width:576px){
    .main-timeline .timeline,
    .main-timeline .timeline:nth-child(even){
        text-align: center;
        padding: 42px 20px 0 0;
        margin: 0 0 30px;
    }
    .main-timeline .timeline-content,
    .main-timeline .timeline:nth-child(even) .timeline-content{
        padding: 150px 20px 20px;
    }
    .main-timeline .timeline-content:before,
    .main-timeline .timeline:nth-child(even) .timeline-content:before{
        width: 60px;
        transform: rotate(90deg);
        bottom: auto;
        top: 20px;
        left: -20px;
    }
    .main-timeline .timeline-year,
    .main-timeline .timeline:nth-child(even) .timeline-year{
        line-height: 100px;
        width: 100%;
        height: 100px;
        left: auto;
        right: -20px;
        top: -42px;
    }
    .main-timeline .timeline-icon,
    .main-timeline .timeline:nth-child(even) .timeline-icon{
        transform: translateX(-50%) translateY(0);
        top: 75px;
        left: 50%;
        right: auto;
    }
    .main-timeline .title{ font-size: 20px; }
}
</style>
</head>


<div class="scroll-container">
<div class="image-wrapper">
    <img src="./images/Finfographics.png" height="1000" />
  </div>
</div>



               